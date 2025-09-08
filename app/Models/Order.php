<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'orders';

    public function items()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderShippingAddress()
    {
        return $this->hasOne(OrderShippingAddress::class, 'order_id');
    }
    public function orderBillingAddress()
    {
        return $this->hasOne(OrderBillingAddress::class, 'order_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('invoice_no', 'like', '%' . $search . '%');
        });
        $query->when($filters['filter_payment'] ?? false, function ($query, $filterPayment) {
            $query->where('payment_method', 'like', '%' . $filterPayment . '%');
        });
    }
}
