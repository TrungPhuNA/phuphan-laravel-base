<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface ProductVariantRepositoryInterface extends BaseRepositoryInterface
{
    public function updateOrCreate($conditions, $data);
}