<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\RequestCreateOrUpdateSetting;
use App\Service\SettingAdsService;

class AdminSettingAdsController extends Controller
{
    protected SettingAdsService $settingAdsService;
    public function __construct(SettingAdsService $settingAdsService)
    {
        $this->settingAdsService = $settingAdsService;
    }

    public function index()
    {
        $setting = $this->settingAdsService->findBySetting();
        $viewData = [
            "setting" => $setting
        ];

        return view('admin.setting.setting_ads', $viewData);
    }

    public function store(RequestCreateOrUpdateSetting $requestCreateOrUpdateSetting)
    {
        $dataModel = $requestCreateOrUpdateSetting->all();
        if ($requestCreateOrUpdateSetting->hasFile('adsense_ads_file')) {
            $file = $requestCreateOrUpdateSetting->file('adsense_ads_file');
            $filename = 'ads.txt';
            $destinationPath = public_path();
            $file->move($destinationPath, $filename);
            $dataModel["adsense_ads_file"] = $filename;
        }

        $this->settingAdsService->insertOrUpdate($dataModel);
        return redirect()->back()->with("success", "Lưu cấu hình thành công");
    }
}
