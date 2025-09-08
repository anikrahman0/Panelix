<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookTag extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='book_tags';
	protected $primaryKey = 'id';
}
