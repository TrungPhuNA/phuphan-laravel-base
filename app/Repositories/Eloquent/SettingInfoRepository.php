<?php

namespace App\Repositories\Eloquent;

use App\Models\SettingInfomation;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\SettingInfoRepositoryInterface;

class SettingInfoRepository extends BaseRepository implements SettingInfoRepositoryInterface
{
    public function __construct(SettingInfomation $model)
    {
        parent::__construct($model);
    }

    /**
     * @return mixed
     */
    public function findOne()
    {
        return SettingInfomation::first();
    }
}