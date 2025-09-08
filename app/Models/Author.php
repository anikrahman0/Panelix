<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='authors';

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('en_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    public function scopePublished()
    {
        return $this->where('status', 1);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_authors', 'author_id', 'book_id')
            ->where('books.status', 1);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories', 'cat_id', 'book_id')
            ->where('categories.status', 1);
    }
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id')->where('status', 1);
    }
}
