<?php

namespace App\Http\Controllers\Admin\Appearance;

use App\Http\Controllers\Controller;
use App\Service\ResponseService;
use App\Service\SettingMenuService;
use AtCore\CoreRepo\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    protected SettingMenuService $settingMenuService;

    public function __construct(SettingMenuService $settingMenuService)
    {
        $this->settingMenuService = $settingMenuService;
    }

    public function index()
    {
        return view("admin.appearance.menu.index");
    }

    public function getListsMenus(Request $request)
    {
        $menu = $this->settingMenuService->findOne([
            "location" => 1
        ]);
        return ResponseService::success([
            'menu' => $menu,
        ]);
    }

    public function storeApi(Request $request)
    {
        $data = $request->all();
        $data["location"] = 1;
        $data["name"] = "Main menu";
        $data["sub_menus"] = $request->all();
        $menu = $this->settingMenuService->updateOrCreate([
            "location" => 1
        ], $data);

        return ResponseService::success([
            'data' => $request->all(),
            'menu' => $menu
        ]);
    }
}
