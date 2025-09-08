<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookStockHistory extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='book_stock_histories';
	protected $primaryKey = 'id';
}
