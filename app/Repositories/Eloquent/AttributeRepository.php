<?php

namespace App\Repositories\Eloquent;

use App\Models\Ecommerce\Attribute;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\AttributeRepositoryInterface;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    public function __construct(Attribute $model)
    {
        parent::__construct($model);
    }

    public function getAll($params = [])
    {
        return Attribute::with("attributeValues")->get();
    }

    public function getByIds($ids = [])
    {
        return Attribute::whereIn("id", $ids)->get();
    }
}