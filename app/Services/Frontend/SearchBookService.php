<?php

namespace App\Services\Frontend;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Constants\CacheLifetime;
use Illuminate\Container\Attributes\Cache;

class SearchBookService {

    public function getBooksBySearch($paginate = 12, $filters = [])
    {
        $query = Book::with(['authors:id,name,en_name','categories:slug','inWishlist', 'firstImage:book_id,img_path,img_sm_path,img_thumb_path'])->published();

        // Global search by book title or author name
        if (!empty($filters['q'])) {
            $searchTerm = $filters['q'];
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhereHas('authors', function ($authorQuery) use ($searchTerm) {
                        $authorQuery->where('name', 'like', "%{$searchTerm}%")->orWhere('en_name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        // Filter by category (many-to-many)
        if (!empty($filters['category'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('categories.id', $filters['category']);
            });
        }

        // Filter by author (many-to-many)
        if (!empty($filters['author'])) {
            $query->whereHas('authors', function ($q) use ($filters) {
                $q->where('authors.id', $filters['author']);
            });
        }

        // Filter by publisher (one-to-many)
        if (!empty($filters['publisher'])) {
            $query->where('publisher_id', $filters['publisher']);
        }

        // Sort options
        switch ($filters['sort'] ?? null) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;

            case 'best_selling':
                $query->withSum('orderDetails', 'quantity')
                    ->orderBy('order_details_sum_quantity', 'desc');
                break;

            case 'low_to_high':
                $query->orderBy('sale_price', 'asc');
                break;

            case 'high_to_low':
                $query->orderBy('sale_price', 'desc');
                break;

            case 'best_rating':
                $query->withAvg('bookReviews', 'user_rating')
                    ->orderBy('book_reviews_avg_user_rating', 'desc');
                break;

            default:
                $query->latest();
        }

        // Fetch filter options to use in Blade
        $categories = cache()->remember('search_result_categories', CacheLifetime::ONE_DAY, function () {
            return Category::published()->latest()->get();
        });
        $authors = cache()->remember('search_result_authors', CacheLifetime::ONE_DAY, function () {
            return Author::published()->latest()->get();
        });
        $publishers = cache()->remember('search_result_publishers', CacheLifetime::ONE_DAY, function () {
            return Publisher::published()->latest()->get();
        });
        $books = $query->paginate($paginate)->appends($filters); // keep filters in pagination

        return [
            'books' => $books,
            'categories' => $categories,
            'authors' => $authors,
            'publishers' => $publishers,
            'total' => $books->total()
        ];
    }

}