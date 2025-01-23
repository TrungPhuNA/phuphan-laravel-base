<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\RequestCreateTag;
use App\Service\MenuService;
use Illuminate\Http\Request;

class AdmBlogMenuController extends Controller
{
    protected MenuService $menuService;
    public function __construct(
        MenuService $menuService
    ) {
        $this->menuService = $menuService;
    }

    public function index(Request $request)
    {
        $menus = $this->menuService->paginate($request->all());
        $viewData = [
            "menus" => $menus
        ];

        return view('admin.blog.menu.index', $viewData);
    }

    public function create()
    {
        return view('admin.blog.menu.create');
    }

    public function store(RequestCreateTag $requestCreateTag)
    {
        $menuDto = $requestCreateTag->except("_token");
        $menu = $this->menuService->create($menuDto);
        if ($menu) {
            return redirect()->route("admin.blog.menu.index")->with("success", "Tạo mới thành công");
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $menu = $this->menuService->findById($id);
        $viewData = [
            "menu"        => $menu
        ];

        return view('admin.blog.menu.update', $viewData);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $update = $this->menuService->update($id, $data);
        if ($update) {
            return redirect()->route("admin.blog.menu.index")->with("success", "Cập nhật thành công");
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }

    public function delete(Request $request, $id)
    {
        $menu = $this->menuService->findById($id);
        if (empty($menu)) {
            return redirect()->back()->with("danger", "Không tồn tại từ khoá");
        }

        $this->menuService->delete($id);
        return redirect()->back()->with("success", "Cập nhật dữ liệu thành công");
    }

}
