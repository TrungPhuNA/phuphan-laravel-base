<?php

namespace App\Repositories\Eloquent;

use App\Models\Ecommerce\Brand;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\BrandRepositoryInterface;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    public function getAll($params = [])
    {
        return Brand::all();
    }
}