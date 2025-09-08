<?php

namespace App\Services;

use App\Models\Book;
use App\Constants\CacheLifetime;
use App\Models\RecentlyViewedBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BookService {

    const SESSION_KEY = 'recently_viewed_books';
    const MAX_ITEMS = 6;

    public  function newlyPublishedBooks()
    {
        return cache()->remember('newly_published_books', CacheLifetime::ONE_DAY, function () {
            return Book::with('firstImage:book_id,img_path,img_sm_path,img_thumb_path', 'firstCategory:slug', 'authors:id,name,en_name', 'inWishlist')
            ->whereNot('pre_order', 1)
            ->published()
            ->latest()
            ->limit(12)
            ->get();
        });
    }

    public function preOrderedBooks()
    {
        // Cache pre-ordered books for 24 hours
        return cache()->remember('pre_ordered_books', CacheLifetime::ONE_DAY, function () {
            return Book::with('firstImage:book_id,img_path,img_sm_path,img_thumb_path', 'firstCategory:slug', 'authors:id,name,en_name', 'inWishlist')
            ->where('pre_order', 1)
            ->published()
            ->latest()
            ->limit(12)
            ->get();
        });
    }

    public function seeMoreBooks($id)
    {
        return Cache::remember("see_more_books_{$id}", CacheLifetime::ONE_DAY, function () use ($id) {
            $book = Book::with('categories')->findOrFail($id);
            $categoryIds = $book->categories->pluck('id')->toArray();

            return Book::with('firstImage:book_id,img_path,img_sm_path,img_thumb_path', 'authors:id,name,en_name', 'categories:slug')
                ->where('id', '!=', $id)
                ->whereHas('categories', function ($query) use ($categoryIds) {
                    $query->whereIn('categories.id', $categoryIds);
                })
                ->published()
                ->latest()
                ->limit(10)
                ->get();
        });
    }

    public function getBookBySlug($slug) {
        return Book::with('authors:id,name,en_name', 'categories:title,slug', 'firstImage:book_id,img_path,img_sm_path,img_thumb_path', 'pdf_images:book_id,pdf_image_path', 'bookReviews.user')->where('slug', $slug)->published()->first();
    }


    public function trackRecentlyViewedBooks(Book $book): void
    {
        // Get & update session
        $recent = session(self::SESSION_KEY, []);

        if (!in_array($book->id, $recent)) {
            array_unshift($recent, $book->id);
        } else {
            // Move existing to front without duplication
            $recent = array_values(array_diff($recent, [$book->id]));
            array_unshift($recent, $book->id);
        }

        // Limit length
        $recent = array_slice($recent, 0, self::MAX_ITEMS);
        session([self::SESSION_KEY => $recent]);

        // Queue database sync for logged-in user
        if (Auth::check()) {
            $this->syncRecentlyViewedToDatabase($recent);
        }
    }

    protected function syncRecentlyViewedToDatabase(array $bookIds): void
    {
        $userId = Auth::id();
        if (!$userId || empty($bookIds)) return;

        $now = now();
        $records = [];

        foreach ($bookIds as $index => $bookId) {
            $records[] = [
                'user_id'    => $userId,
                'book_id'    => $bookId,
                'viewed_at'  => $now->copy()->subSeconds($index),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        RecentlyViewedBook::upsert(
            $records,
            ['user_id', 'book_id'],  
            ['viewed_at', 'updated_at']
        );
    }



    public function getRecentlyViewedBooks()
    {
        $bookIds = session(self::SESSION_KEY, []);

        if (empty($bookIds)) {
            return collect();
        }

        $books = Book::whereIn('id', $bookIds)
            ->with('firstImage:book_id,img_path,img_sm_path,img_thumb_path', 'authors:id,name,en_name') // optional eager load
            ->get()
            ->keyBy('id');

        return collect($bookIds)->map(fn($id) => $books[$id] ?? null)->filter();
    }

    public function bookStockCheck($cart, $requestedQuantities)
    {
        $outOfStockItems = [];

        // Get all book IDs
        $bookIds = $cart->pluck('attributes.book_id')->unique();
        $books = Book::whereIn('id', $bookIds)->get()->keyBy('id');

        foreach ($cart as $item) {
            $bookId = $item->attributes->book_id;
            $book = $books[$bookId] ?? null;

            if (!$book) continue;

            $rowId = $item->id;
            $requestedQty = $requestedQuantities[$rowId] ?? $item->quantity;

            if ($book->quantity === 0) {
                $outOfStockItems[] = [
                    'rowId' => $rowId,
                    'message' => "book '{$book->name}' is out of stock.",
                ];
            } elseif ($requestedQty > $book->quantity) {
                $outOfStockItems[] = [
                    'rowId' => $rowId,
                    'message' => "Only {$book->quantity} units of '{$book->name}' available.",
                ];
            }
        }

        return $outOfStockItems;
    }
}