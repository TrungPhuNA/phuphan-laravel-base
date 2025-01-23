<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface PermissionRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
}