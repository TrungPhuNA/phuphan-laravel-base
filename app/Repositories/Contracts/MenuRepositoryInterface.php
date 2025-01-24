<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface MenuRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll($params = []);
}