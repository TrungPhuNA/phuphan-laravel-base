<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'ec_products';
    protected $guarded = [''];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
