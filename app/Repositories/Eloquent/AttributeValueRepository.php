<?php

namespace App\Repositories\Eloquent;

use App\Models\Ecommerce\AttributeValue;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\AttributeValueRepositoryInterface;

class AttributeValueRepository extends BaseRepository implements AttributeValueRepositoryInterface
{
    public function __construct(AttributeValue $model)
    {
        parent::__construct($model);
    }

    public function insert($modelDto)
    {
        return AttributeValue::insert($modelDto);
    }

    public function getListsByAttributeId($attributeID)
    {
        return AttributeValue::where("attribute_id", $attributeID)->orderBy("id","asc")->get();
    }

    public function checkExistsAttributeValue($params)
    {
        return AttributeValue::where($params)->first();
    }

    public function updateAttributeValue($params, $modelDto)
    {
        return AttributeValue::where($params)->update($modelDto);
    }
}