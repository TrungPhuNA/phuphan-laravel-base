<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}