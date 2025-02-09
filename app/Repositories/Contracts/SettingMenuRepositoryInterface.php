<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface SettingMenuRepositoryInterface extends BaseRepositoryInterface
{
    public function updateOrCreate($conditions, $data);
    public function findOne($conditions);
}