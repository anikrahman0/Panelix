<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='categories';
	protected $primaryKey = 'id';

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('status',1);
    }
    public function warranties()
    {
        return $this->belongsToMany(Warranty::class, 'category_warranties', 'cat_id', 'warranty_id');
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search_cat'] ?? false, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')->orWhere('slug', 'like', '%' . $search . '%');
        });
        $query->when($filters['filter_category'] ?? false, function ($query, $filterCategory) {
            $query->where('id', $filterCategory);
        });
        $query->when($filters['filter_parent_category'] ?? false, function ($query, $filterParentCategory) {
            $query->where('parent_id', $filterParentCategory);
        });
    }
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function booksByCategory()
    {
        return $this->belongsToMany(Book::class, 'book_categories', 'cat_id', 'book_id')
            ->where('books.status', 1)
            ->limit(5);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_categories', 'cat_id', 'book_id')
            ->where('books.status', 1);
    }
}
