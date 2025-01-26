<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ecommerce\RequestCreateBrand;
use App\Service\BrandService;
use Illuminate\Http\Request;

class AdmEcommerceBrandController extends Controller
{
    protected BrandService $brandService;
    public function __construct(
        BrandService $brandService
    ) {
        $this->brandService = $brandService;
    }

    public function index(Request $request)
    {
        $brands = $this->brandService->paginate($request->all());
        $viewData = [
            "brands" => $brands
        ];

        return view('admin.ecommerce.brand.index', $viewData);
    }

    public function create()
    {
        return view('admin.ecommerce.brand.create');
    }

    public function store(RequestCreateBrand $requestCreateBrand)
    {
        $brandDto = $requestCreateBrand->except("_token");
        $brand = $this->brandService->create($brandDto);
        if ($brand) {
            return redirect()->route("admin.ecommerce.brand.index")->with("success", "Tạo mới thành công");
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $brand = $this->brandService->findById($id);
        $viewData = [
            "brand"        => $brand
        ];

        return view('admin.ecommerce.brand.update', $viewData);
    }

    public function update(RequestCreateBrand $request, $id)
    {
        $data = $request->all();
        $update = $this->brandService->update($id, $data);
        if ($update) {
            return redirect()->route("admin.ecommerce.brand.index")->with("success", "Cập nhật thành công");
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }

    public function delete(Request $request, $id)
    {
        $brand = $this->brandService->findById($id);
        if (empty($brand)) {
            return redirect()->back()->with("danger", "Không tồn tại thương hiệu");
        }

        $this->brandService->delete($id);
        return redirect()->back()->with("success", "Cập nhật dữ liệu thành công");
    }
}
