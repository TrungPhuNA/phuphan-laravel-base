<?php

namespace App\Repositories\Eloquent;

use App\Models\Appearance\SettingMenu;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\SettingMenuRepositoryInterface;

class SettingMenuRepository extends BaseRepository implements SettingMenuRepositoryInterface
{
    public function __construct(SettingMenu $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $conditions
     * @param $data
     * @return mixed
     */
    public function updateOrCreate($conditions, $data)
    {
        return $this->model->updateOrCreate($conditions, $data);
    }

    public function findOne($conditions)
    {
        return $this->model->where($conditions)->first();
    }
}