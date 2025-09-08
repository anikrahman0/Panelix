<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponCat extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='coupon_cats';
    protected $primaryKey = 'id';
    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }
}
