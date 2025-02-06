<?php

namespace App\Repositories\Eloquent;

use App\Models\Ecommerce\VariantAttribute;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\VariantAttributeRepositoryInterface;

class VariantAttributeRepository extends BaseRepository implements VariantAttributeRepositoryInterface
{
    public function __construct(VariantAttribute $model)
    {
        parent::__construct($model);
    }

    public function checkExistsAttributeValue($conditions)
    {
        return $this->model->where($conditions)->first();
    }

    public function updateAttributeValue($conditions, $updateDto)
    {
        return $this->model->where($conditions)->update($updateDto);
    }
}