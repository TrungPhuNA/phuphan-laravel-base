<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/27/25
 */

namespace App\Service;

use App\Models\Setting\SettingAds;

class SettingAdsService
{
    /**
     * @return mixed
     */
    public function findBySetting()
    {
        return SettingAds::first();
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function insertOrUpdate($modelDto)
    {
        $setting = $this->findBySetting();
        if ($setting) {
            return $setting->update($modelDto);
        }
        return SettingAds::create($modelDto);
    }
}