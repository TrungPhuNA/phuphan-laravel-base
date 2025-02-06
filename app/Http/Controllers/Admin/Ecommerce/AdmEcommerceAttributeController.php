<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ecommerce\RequestCreateAttribute;
use App\Service\AttributeService;
use App\Service\AttributeValueService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdmEcommerceAttributeController extends Controller
{
    protected AttributeService $attributeService;
    protected AttributeValueService $attributeValueService;

    public function __construct(
        AttributeService $attributeService,
        AttributeValueService $attributeValueService,
    ) {
        $this->attributeService = $attributeService;
        $this->attributeValueService = $attributeValueService;
    }

    public function index(Request $request)
    {
        $attributes = $this->attributeService->getAll($request->all());
        $viewData = [
            "attributes" => $attributes
        ];

        return view('admin.ecommerce.attribute.index', $viewData);
    }

    public function create()
    {
        return view('admin.ecommerce.attribute.create');
    }

    public function store(RequestCreateAttribute $requestCreateAttribute)
    {
        $modelDto = $requestCreateAttribute->except("_token");
        $attribute = $this->attributeService->create($modelDto);
        if ($attribute) {
            $attributeValues = $request->values ?? [];
            if (!empty($attributeValues)) {
                $values = [];
                foreach ($attributeValues["title"] as $i => $item) {
                    $values[] = [
                        "color"        => $attributeValues["color"][$i],
                        "title"        => $item,
                        "slug"         => Str::slug($item),
                        "attribute_id" => $attribute->id,
                    ];
                }

                $this->attributeValueService->create($values);
            }

            return redirect()->route("admin.ecommerce.attribute.index")->with("success", "Tạo mới thành công");
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $attribute = $this->attributeService->findById($id);
        $attributeValues = $this->attributeValueService->getListsByAttributeId($id);
        $viewData = [
            "attribute"       => $attribute,
            "attributeValues" => $attributeValues,
        ];

        return view('admin.ecommerce.attribute.update', $viewData);
    }

    public function update(RequestCreateAttribute $request, $id)
    {
        $data = $request->all();
        $update = $this->attributeService->update($id, $data);

        $attributeValues = $request->values ?? [];
        if (!empty($attributeValues)) {
            $values = [];
            foreach ($attributeValues["title"] as $i => $item) {
                $check = $this->attributeValueService->checkExistsAttributeValue([
                    "slug"         => Str::slug($item),
                    "attribute_id" => $id,
                ]);
                if(empty($check)) {
                    $values[] = [
                        "color"        => $attributeValues["color"][$i],
                        "title"        => $item,
                        "slug"         => Str::slug($item),
                        "attribute_id" => $id,
                    ];
                }else {
                    $this->attributeValueService->updateAttributeValue([
                        "slug"         => Str::slug($item),
                        "attribute_id" => $id,
                    ], [
                        "color"        => $attributeValues["color"][$i],
                        "title"        => $item,
                        "slug"         => Str::slug($item),
                        "attribute_id" => $id,
                    ]);
                }
            }

            if(!empty($values)) $this->attributeValueService->insert($values);
        }

        if ($update) {
            return redirect()->route("admin.ecommerce.attribute.index")->with("success", "Cập nhật thành công");
        }


        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }

    public function delete(Request $request, $id)
    {
        $attribute = $this->attributeService->findById($id);
        if (empty($attribute)) {
            return redirect()->back()->with("danger", "Không tồn tại thương hiệu");
        }

        $this->attributeService->delete($id);
        return redirect()->back()->with("success", "Cập nhật dữ liệu thành công");
    }

    public function getListsValues($id)
    {
        $attributeValue = $this->attributeValueService->getListsByAttributeId($id);
        return response()->json($attributeValue);
    }
}
