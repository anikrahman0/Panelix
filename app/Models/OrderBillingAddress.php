<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBillingAddress extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='order_billing_addresses';

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state(){
        return $this->belongsTo(State::class, 'state_id');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }
}
