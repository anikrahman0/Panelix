<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Author;

class AuthorService
{

    public function getAuthors($limit)
    {
        return Author::published()->orderBy('position', 'asc')->limit($limit)->get();
    }

    public function getAuthorsByPaginate($paginate, $search = null)
    {
        return Author::published()
            ->filter(['search' => $search])
            ->orderBy('position', 'asc')
            ->paginate($paginate);
    }

    public function getAuthorBooksByFilter($id, $paginate, $filters = [])
    {
        $author = Author::findOrFail($id);
        $query = Book::with(['authors:id,name,en_name','categories:slug', 'inWishlist','firstImage:book_id,img_path,img_sm_path,img_thumb_path'])
            ->published() 
            ->whereHas('authors', function ($q) use ($id) {
                $q->where('authors.id', $id);
            });

        if (!empty($filters['category'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('categories.id', $filters['category']);
            });
        }

        if (!empty($filters['publisher'])) {
            $query->where('publisher_id', $filters['publisher']);
        }

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
            'author' => $author,
            'books' => $query->paginate($paginate),
        ];
    }

}
