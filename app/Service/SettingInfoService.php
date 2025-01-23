<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

namespace App\Service;

use App\Repositories\Contracts\SettingInfoRepositoryInterface;

class SettingInfoService
{
    protected $settingInfoRepository;
    public function __construct(SettingInfoRepositoryInterface $settingInfoRepository)
    {
        $this->settingInfoRepository = $settingInfoRepository;
    }

    /**
     * @return mixed
     */
    public function findOne()
    {
        return $this->settingInfoRepository->findOne();
    }

    /**
     * @param $id
     * @param $settingDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $settingDto)
    {
        return $this->settingInfoRepository->update($id, $settingDto);
    }

    /**
     * @param $settingDto
     * @return mixed
     */
    public function create($settingDto)
    {
        return $this->settingInfoRepository->create($settingDto);
    }
}