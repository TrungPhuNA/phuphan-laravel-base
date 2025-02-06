<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'ec_product_variants';
    protected $guarded = [''];

    public function attributes()
    {
        return $this->hasMany(VariantAttribute::class, 'product_variant_id');
    }
}
