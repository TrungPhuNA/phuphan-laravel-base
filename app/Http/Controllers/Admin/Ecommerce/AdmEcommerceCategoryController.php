<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ecommerce\RequestCreateBrand;
use App\Http\Requests\Admin\Ecommerce\RequestCreateCategory;
use App\Service\BrandService;
use App\Service\CategoryService;
use Illuminate\Http\Request;

class AdmEcommerceCategoryController extends Controller
{
    protected CategoryService $categoryService;
    public function __construct(
        CategoryService $categoryService
    ) {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->paginate($request->all());
        $viewData = [
            "categories" => $categories
        ];

        return view('admin.ecommerce.category.index', $viewData);
    }

    public function create()
    {
        return view('admin.ecommerce.category.create');
    }

    public function store(RequestCreateCategory $requestCreateCategory)
    {
        $categoryDto = $requestCreateCategory->except("_token");
        $category = $this->categoryService->create($categoryDto);
        if ($category) {
            return redirect()->route("admin.ecommerce.category.index")->with("success", "Tạo mới thành công");
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $category = $this->categoryService->findById($id);
        $viewData = [
            "category"        => $category
        ];

        return view('admin.ecommerce.category.update', $viewData);
    }

    public function update(RequestCreateCategory $request, $id)
    {
        $data = $request->all();
        $update = $this->categoryService->update($id, $data);
        if ($update) {
            return redirect()->route("admin.ecommerce.category.index")->with("success", "Cập nhật thành công");
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }

    public function delete(Request $request, $id)
    {
        $category = $this->categoryService->findById($id);
        if (empty($category)) {
            return redirect()->back()->with("danger", "Không tồn tại thương hiệu");
        }

        $this->categoryService->delete($id);
        return redirect()->back()->with("success", "Cập nhật dữ liệu thành công");
    }
}
