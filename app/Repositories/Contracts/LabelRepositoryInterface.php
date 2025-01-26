<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface LabelRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll($params = []);
}