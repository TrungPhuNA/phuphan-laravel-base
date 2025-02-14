<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class ProductLabels extends Model
{
    protected $table = 'ec_product_labels';
    protected $guarded = [''];

    public function attributes()
    {
        return $this->hasMany(VariantAttribute::class, 'product_variant_id');
    }
}
