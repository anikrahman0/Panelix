<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponProduct extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='coupon_products';
    protected $primaryKey = 'id';
    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
