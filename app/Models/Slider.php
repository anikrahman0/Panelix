<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='sliders';
    public function images()
    {
        return $this->hasMany(SliderImage::class, 'slider_id')->where('status', 1)->orderBy('position', 'asc');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
