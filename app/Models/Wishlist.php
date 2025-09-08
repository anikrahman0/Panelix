<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='wishlists';

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
