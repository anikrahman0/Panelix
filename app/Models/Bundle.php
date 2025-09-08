<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bundle extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='bundles';
    protected $primaryKey = 'id';

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_bundles', 'bundle_id', 'book_id')->where('books.status', 1);
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
