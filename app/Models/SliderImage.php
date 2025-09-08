<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='slider_images';
	protected $primaryKey = 'id';
    public function slider()
    {
        return $this->belongsTo(Slider::class, 'slider_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
