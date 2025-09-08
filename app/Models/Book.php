<?php

namespace App\Models;

use App\Models\BookGallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'books';

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'book_tags', 'book_id', 'tag_id')->where('tags.status', 1);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories', 'book_id', 'cat_id')
            ->where('categories.status', 1);
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id')->where('status', 1);
    }
    
    public function gallery()
    {
        return $this->hasMany(BookGallery::class)->where('status', 1);
    }

    public function inWishlist()
    {
        return $this->hasOne(Wishlist::class)
            ->where('user_id', Auth::id());
    }

    public function pdf_images()
    {
        return $this->hasMany(BookPdfImage::class)->where('status', 1);
    }

    public function firstImage()
    {
        return $this->hasOne(BookGallery::class)
            ->where('status', 1)
            ->orderBy('id');
    }

    public function firstAuthor()
    {
        return $this->hasOne(BookAuthor::class)
            ->where('status', 1)
            ->orderBy('id');
    }

    public function bookReviews()
    {
        return $this->hasMany(BookRatingReview::class, 'book_id')->latest()->where('book_rating_reviews.approval', 2);
    }


    public function firstCategory(){
        return $this->hasOne(Category::class, 'id', 'cat_id')->where('status', 1);
    }


    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors', 'book_id', 'author_id')->where('authors.status', 1);
    }

    public function bundles()
    {
        return $this->belongsToMany(Bundle::class, 'book_bundles', 'book_id', 'bundle_id');
    }
  
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function getAverageRatingAttribute()
    {
        $average = $this->bookReviews->avg('user_rating'); // Using the loaded relationship
        return round($average, 2) ?? 0;
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'book_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        });
        $query->when($filters['filter_book'] ?? false, function ($query, $filterBook) {
            $query->where('id', $filterBook);
        });
        if (!empty($filters['filter_category'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('categories.id', $filters['filter_category']);
            });
        }
    }
}
