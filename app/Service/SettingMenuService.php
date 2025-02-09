<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 2/9/25
 */

namespace App\Service;

use App\Repositories\Contracts\SettingMenuRepositoryInterface;

class SettingMenuService
{
    protected SettingMenuRepositoryInterface $settingMenuRepository;
    public function __construct(SettingMenuRepositoryInterface $settingMenuRepository)
    {
        $this->settingMenuRepository = $settingMenuRepository;
    }

    public function paginate($filters)
    {
        return $this->settingMenuRepository->paginate($filters);
    }

    public function findOne($conditions)
    {
        return $this->settingMenuRepository->findOne($conditions);
    }

    /**
     * @param $id
     * @param $modelDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $modelDto)
    {
        return $this->settingMenuRepository->update($id, $modelDto);
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function create($modelDto)
    {
        return $this->settingMenuRepository->create($modelDto);
    }

    public function updateOrCreate($conditions, $modelDto)
    {
        return $this->settingMenuRepository->updateOrCreate($conditions, $modelDto);
    }
}