<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface TagRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll($params = []);
}