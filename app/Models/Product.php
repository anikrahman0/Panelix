<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'products';

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id')->where('status', 1);
    }

    public function gallery()
    {
        return $this->hasMany(BookGallery::class, 'product_id')->where('status', 1);
    }

    public function meta()
    {
        return $this->hasMany(ProductMeta::class, 'product_id')->where('status', 1);
    }

    public function variant()
    {
        return $this->belongsToMany(Variant::class, 'product_variants', 'product_id', 'var_id')->where('product_variants.status', 1)->where('variants.status', 1);
    }

    public function variant_option()
    {
        return $this->belongsToMany(VariantOption::class, 'product_variants', 'product_id', 'var_option_id')->where('product_variants.status', 1)->where('variant_options.status', 1);
    }

    public function variant_option_ids()
    {
        return $this->hasMany(ProductVariant::class, 'product_id')->where('status', 1);
    }

    public function product_variant_relations()
    {
        return $this->hasMany(ProductVariantRelation::class, 'product_id')->where('status', 1);
    }

    public function product_variant_prices()
    {
        return $this->hasMany(ProductVariantPrice::class, 'product_id')->where('status', 1);
    }

    public function shipping_info()
    {
        return $this->hasOne(ProductShipping::class, 'product_id');
    }
    public function product_warranty()
    {
        return $this->hasOne(ProductWarranty::class, 'product_id');
    }
    public function product_price()
    {
        return $this->hasMany(ProductVariantPrice::class, 'product_id');
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        });
        $query->when($filters['filter_book'] ?? false, function ($query, $filterBook) {
            $query->where('id', $filterBook);
        });
        $query->when($filters['filter_category'] ?? false, function ($query, $filterCategory) {
            $query->where('cat_id', $filterCategory);
        });
    }
}
