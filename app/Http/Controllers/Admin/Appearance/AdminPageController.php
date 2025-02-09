<?php

namespace App\Http\Controllers\Admin\Appearance;

use App\Http\Controllers\Controller;
use App\Service\SettingPageService;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    protected SettingPageService $settingPageService;
    public function __construct(
        SettingPageService $settingPageService
    ) {
        $this->settingPageService = $settingPageService;
    }

    public function index(Request $request)
    {
        $pages = $this->settingPageService->paginate($request->all());
        $viewData = [
            "pages" => $pages
        ];

        return view('admin.appearance.page.index', $viewData);
    }

    public function create()
    {
        return view('admin.appearance.page.create');
    }

    public function store(Request $request)
    {
        $modelDto = $request->except("_token");
        $tag = $this->settingPageService->create($modelDto);
        if ($tag) {
            return redirect()->route("admin.appearance.pages.index")->with("success", "Tạo mới thành công");
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $page = $this->settingPageService->findById($id);
        $viewData = [
            "page"        => $page
        ];

        return view('admin.appearance.page.update', $viewData);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $update = $this->settingPageService->update($id, $data);
        if ($update) {
            return redirect()->route("admin.appearance.pages.index")->with("success", "Cập nhật thành công");
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }

    public function delete(Request $request, $id)
    {
        $tag = $this->settingPageService->findById($id);
        if (empty($tag)) {
            return redirect()->back()->with("danger", "Không tồn tại từ khoá");
        }

        $this->settingPageService->delete($id);
        return redirect()->back()->with("success", "Cập nhật dữ liệu thành công");
    }
}
