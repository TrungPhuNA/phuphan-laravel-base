<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface AttributeRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll($params = []);
}