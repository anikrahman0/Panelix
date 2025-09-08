<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='coupons';

    protected $casts = [
        'start_date' => 'datetime',
        'expire_date' => 'datetime',
    ];

    public function categories()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_cats', 'coupon_id', 'cat_id');
    }
    public function products()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_products', 'coupon_id', 'product_id');
    }
    public function customers()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_users', 'coupon_id', 'user_id');
    }
}
