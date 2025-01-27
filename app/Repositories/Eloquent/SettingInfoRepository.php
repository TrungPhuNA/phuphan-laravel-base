<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting\SettingInfomation;
use App\Repositories\Contracts\SettingInfoRepositoryInterface;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;

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