<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ecommerce\RequestCreateLabel;
use App\Service\LabelService;
use Illuminate\Http\Request;

class AdmEcommerceLabelController extends Controller
{
    protected LabelService $labelService;
    public function __construct(
        LabelService $labelService
    ) {
        $this->labelService = $labelService;
    }

    public function index(Request $request)
    {
        $labels = $this->labelService->paginate($request->all());
        $viewData = [
            "labels" => $labels
        ];

        return view('admin.ecommerce.label.index', $viewData);
    }

    public function create()
    {
        return view('admin.ecommerce.label.create');
    }

    public function store(RequestCreateLabel $requestCreateLabel)
    {
        $brandDto = $requestCreateLabel->except("_token");
        $brand = $this->labelService->create($brandDto);
        if ($brand) {
            return redirect()->route("admin.ecommerce.label.index")->with("success", "Tạo mới thành công");
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $label = $this->labelService->findById($id);
        $viewData = [
            "label"        => $label
        ];

        return view('admin.ecommerce.label.update', $viewData);
    }

    public function update(RequestCreateLabel $request, $id)
    {
        $data = $request->all();
        $update = $this->labelService->update($id, $data);
        if ($update) {
            return redirect()->route("admin.ecommerce.label.index")->with("success", "Cập nhật thành công");
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }

    public function delete(Request $request, $id)
    {
        $label = $this->labelService->findById($id);
        if (empty($label)) {
            return redirect()->back()->with("danger", "Không tồn tại thương hiệu");
        }

        $this->labelService->delete($id);
        return redirect()->back()->with("success", "Cập nhật dữ liệu thành công");
    }
}
