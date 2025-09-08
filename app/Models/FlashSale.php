<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='flash_sales';
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_flash_sales', 'sale_id', 'book_id')->where('books.status', 1);
    }
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        });
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
