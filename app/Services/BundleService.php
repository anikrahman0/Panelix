<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Author;
use App\Models\Bundle;
use App\Models\Category;
use App\Models\Publisher;
use App\Constants\CacheLifetime;

class BundleService
{

    public  function getBundles()
    {
        return Bundle::published()->latest()->limit(10)->get();
    }

    public function getBundleByBookId($id, $paginate = 12, $filters = [])
    {
        $bundle = Bundle::findOrFail($id);

        // Query books that belong to this bundle
        $query = Book::with(['authors:id,name,en_name', 'categories:slug', 'inWishlist', 'firstImage:book_id,img_path,img_sm_path,img_thumb_path'])
            ->published()
            ->whereHas('bundles', function ($q) use ($id) {
                $q->where('bundles.id', $id);
            });

        // Filter by category
        if (!empty($filters['category'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('categories.id', $filters['category']);
            });
        }

        // Filter by author
        if (!empty($filters['author'])) {
            $query->whereHas('authors', function ($q) use ($filters) {
                $q->where('authors.id', $filters['author']);
            });
        }

        // Filter by publisher
        if (!empty($filters['publisher'])) {
            $query->where('publisher_id', $filters['publisher']);
        }

        // Sorting logic
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

        // Supporting data
        // Fetch filter options to use in Blade
        $categories = cache()->remember('bundle_details_categories', CacheLifetime::ONE_DAY, function () {
            return Category::published()->latest()->get();
        });
        $authors = cache()->remember('bundle_details_authors', CacheLifetime::ONE_DAY, function () {
            return Author::published()->latest()->get();
        });
        $publishers = cache()->remember('bundle_details_publishers', CacheLifetime::ONE_DAY, function () {
            return Publisher::published()->latest()->get();
        });
        $books = $query->paginate($paginate)->appends($filters);

        return [
            'bundle' => $bundle,
            'books' => $books,
            'categories' => $categories,
            'authors' => $authors,
            'publishers' => $publishers,
        ];
    }
}