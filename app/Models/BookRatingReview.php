<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookRatingReview extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='book_rating_reviews';

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
