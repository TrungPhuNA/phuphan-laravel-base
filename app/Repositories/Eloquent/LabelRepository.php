<?php

namespace App\Repositories\Eloquent;

use App\Models\Ecommerce\ProductLabels;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\LabelRepositoryInterface;

class LabelRepository extends BaseRepository implements LabelRepositoryInterface
{
    public function __construct(ProductLabels $model)
    {
        parent::__construct($model);
    }

    public function getAll($params = [])
    {
        return ProductLabels::all();
    }
}