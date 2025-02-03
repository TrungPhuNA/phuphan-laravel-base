<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Service\SettingInfoService;
use Illuminate\Http\Request;

class AdminSettingInfoController extends Controller
{
    protected SettingInfoService $settingInfoService;
    public function __construct(SettingInfoService $settingInfoService)
    {
        $this->settingInfoService = $settingInfoService;
    }

    public function index()
    {
        return view('admin.setting.index');
    }

    public function showUpdateInfo()
    {
        $settingInfo = $this->settingInfoService->findOne();
        $viewData = [
            'settingInfo' => $settingInfo
        ];
        return view('admin.setting.update_info', $viewData);
    }

    public function updateSetting(Request $request)
    {
        $data = $request->all();
        $settingInfo = $this->settingInfoService->findOne();
        if($settingInfo) {
            $this->settingInfoService->update($settingInfo->id, $data);
        }else {
            $this->settingInfoService->create($data);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Settings updated successfully!',
        ]);
    }
}
