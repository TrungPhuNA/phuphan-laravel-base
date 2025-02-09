<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'ec_products';
    protected $guarded = [''];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->sku = self::generateSKU($product->name);
        });
    }

    public static function generateSKU($name)
    {
        return 'PROD-' . strtoupper(Str::random(4)).'-'.strtoupper(Str::random(4));
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}
