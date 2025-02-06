<?php

namespace App\Repositories\Eloquent;

use App\Models\Ecommerce\ProductVariant;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\ProductVariantRepositoryInterface;

class ProductVariantRepository extends BaseRepository implements ProductVariantRepositoryInterface
{
    public function __construct(ProductVariant $model)
    {
        parent::__construct($model);
    }

    public function updateOrCreate($conditions, $data)
    {
        return $this->model->updateOrCreate($conditions, $data);
    }
}