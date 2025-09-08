<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Blade;


class CategoryService {
    public  function latestCategories($limit)
    {
        return Category::published()->latest()->limit($limit)->get();
    }
    public function getCategoryBooks()
    {
        return Category::with('booksByCategory')
        ->whereHas('books')
        ->where('parent_id', 0)
        ->published()
        ->latest()
        ->first();
    }

    public function getCategoriesByPaginate($paginate, $search = null)
    {
        return Category::published()
            ->filter(['search_cat' => $search])
            ->where('parent_id', 0)
            ->latest()
            ->paginate($paginate);
    } 

    public function getCategoriesBySlug($paginate, $search = null, $slug)
    {
        return Category::published()
            ->filter(['search_cat' => $search])
            ->where('parent_id', 0)
            ->latest()
            ->paginate($paginate);
    } 
    /**
     * Fetch categories for infinite scroll with books, skipping a given category ID.
     *
     * @param string|null $cursor
     * @param int|null $skipId
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\CursorPaginator
     */
    public function scrollCategories(?string $cursor = null, ?int $skipId = null, int $perPage = 1)
    {
        $query = Category::with(['books' => fn($q) => $q->where('books.status', 1)->limit(5)])
            ->whereHas('books')
            ->published()
            ->latest();

        if ($skipId) {
            $query->where('id', '!=', $skipId);
        }

        return $query->cursorPaginate($perPage, ['*'], 'cursor', $cursor);
    }

    /**
     * Render the Blade component for a category with its books.
     *
     * @param Category|null $category
     * @return string
     */
    public function renderCategoryComponent($category): string
    {
        if (!$category) {
            return '';
        }

        // Pass only category, books accessed inside the component
        return Blade::render('<x-frontend.home.category.category-with-books :category="$category" />', [
            'category' => $category,
        ]);
    }
    public function getCategoryBooksByFilter($slug, $paginate, $filters = [])
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $query = Book::with(['authors:id,name,en_name', 'categories:slug', 'inWishlist', 'firstImage:book_id,img_path,img_sm_path,img_thumb_path'])
            ->published()
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category->id);
            });
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

        // Sorting
        switch ($filters['sort'] ?? null) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'best_selling':
                $query->withSum('orderDetails', 'quantity')->orderBy('order_details_sum_quantity', 'desc');
                break;
            case 'low_to_high':
                // Use sale_price if available, else regular_price
                $query->orderBy('sale_price', 'ASC');
                break;

            case 'high_to_low':
                $query->orderBy('sale_price', 'DESC');
                break;
            case 'best_rating':
                $query->withAvg('bookReviews', 'user_rating')
                    ->orderBy('book_reviews_avg_user_rating', 'desc');
                break;
            default:
                $query->latest();
        }

        return [
            'category' => $category,
            'books' => $query->paginate($paginate),
        ];
    }
}