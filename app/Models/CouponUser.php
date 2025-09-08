<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='coupon_users';
    protected $primaryKey = 'id';
    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
