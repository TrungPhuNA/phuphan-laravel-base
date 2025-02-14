<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'ec_attributes';
    protected $guarded = [''];

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class,"attribute_id");
    }
}
