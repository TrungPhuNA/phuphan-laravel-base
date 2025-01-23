<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface SettingInfoRepositoryInterface extends BaseRepositoryInterface
{
    public function findOne();
}