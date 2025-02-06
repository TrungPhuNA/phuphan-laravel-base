<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ecommerce\RequestCreateProduct;
use App\Service\AttributeService;
use App\Service\BrandService;
use App\Service\CategoryService;
use App\Service\LabelService;
use App\Service\ProductService;
use App\Service\ProductVariantService;
use App\Service\VariantAttributeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmEcommerceProductController extends Controller
{
    protected LabelService $labelService;
    protected CategoryService $categoryService;
    protected BrandService $brandService;
    protected AttributeService $attributeService;
    protected ProductService $productService;
    protected ProductVariantService $productVariantService;
    protected VariantAttributeService $variantAttributeService;

    public function __construct(
        LabelService $labelService,
        CategoryService $categoryService,
        BrandService $brandService,
        AttributeService $attributeService,
        ProductService $productService,
        ProductVariantService $productVariantService,
        VariantAttributeService $variantAttributeService,
    ) {
        $this->labelService = $labelService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
        $this->attributeService = $attributeService;
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
        $this->variantAttributeService = $variantAttributeService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->getListsProducts($request->all());
        $viewData = [
            "products" => $products
        ];

        return view('admin.ecommerce.product.index', $viewData);
    }

    public function create()
    {
        $viewData = [
            "categories"   => $this->categoryService->getAll(),
            "brands"       => $this->brandService->getAll(),
            "labels"       => $this->labelService->getAll(),
            "attributes"   => $this->attributeService->getAll(),
            "labelsActive" => [],
            "variants"     => []
        ];

        return view('admin.ecommerce.product.create', $viewData);
    }

    public function store(RequestCreateProduct $requestCreateProduct)
    {
        try {
            DB::beginTransaction();
            $modelDto = $requestCreateProduct->except("_token");
            $product = $this->productService->create($modelDto);
            if ($product) {
                if (!empty($requestCreateProduct->labels)) {
                    $this->productService->syncLabels($requestCreateProduct->labels, $product->id);
                }

                $variants = $requestCreateProduct->input("variants", []);
                foreach ($variants as $variantData) {
                    $variantItem = $this->productVariantService->create([
                        'product_id' => $product->id,
                        'price'      => $variantData['price'],
                        'stock'      => $variantData['stock'],
                        'image'      => $variantData['image'] ?? null,
                        'is_default' => isset($variantData['is_default']) ? 1 : 0
                    ]);

                    // Lưu thuộc tính cho biến thể
                    if (!empty($variantData["attributes"])) {
                        foreach ($variantData["attributes"] as $attributeId => $attributeValueId) {
                            $this->variantAttributeService->create([
                                "product_variant_id" => $variantItem->id,
                                "attribute_id"       => $attributeId,
                                "attribute_value_id" => $attributeValueId
                            ]);
                        }
                    }
                }
                DB::commit();
                return redirect()->route("admin.ecommerce.product.index")->with("success", "Tạo mới thành công");
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            \Log::error("=======[AdmEcommerceProductController.php] File: "
                .$exception->getFile()
                ." Line: ".$exception->getLine()
                ." Message: ".$exception->getMessage());
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $attributes = $this->attributeService->getAll();
        $product = $this->productService->findById($id);

        $attributesIds = [];
        $variants = $product->variants->map(function ($variant) use (&$attributesIds){
            $variant->attribute_values = $variant->attributes->mapWithKeys(function ($attr) use (&$attributesIds) {
                $attributesIds[] = $attr->attribute->id;
                return [$attr->attribute->id => $attr->attributeValue->id];
            });
            return $variant;
        });

        $attributesIds = array_unique($attributesIds);
        $selectedAttributes = !empty($attributesIds)
            ? $this->attributeService->getByIds($attributesIds)
            : ($request->input('selected_attributes')
                ? $this->attributeService->getByIds(explode(",", $request->input('selected_attributes')))
                : []);


        $viewData = [
            "categories"         => $this->categoryService->getAll(),
            "brands"             => $this->brandService->getAll(),
            "product"            => $product,
            "labels"             => $this->labelService->getAll(),
            "labelsActive"       => $this->productService->getLabelsIdByProduct($id),
            "attributes"         => $attributes,
            "selectedAttributes" => $selectedAttributes,
            "variants"           => $variants
        ];

        return view('admin.ecommerce.product.update', $viewData);
    }

    public function update(RequestCreateProduct $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $update = $this->productService->update($id, $data);
            if ($update) {
                if (!empty($request->labels)) {
                    $this->productService->syncLabels($request->labels, $id);
                }

                $variants = $request->input("variants", []);
                foreach ($variants as $variantData) {
                    $variantItem = $this->productVariantService->updateOrCreate(
                        ['id' => $variantData["id"] ?? null],
                        [
                            'product_id' => $id,
                            'price'      => $variantData['price'],
                            'stock'      => $variantData['stock'],
                            'image'      => $variantData['image'] ?? null,
                            'is_default' => isset($variantData['is_default']) ? 1 : 0
                        ]
                    );

                    foreach ($variantData["attributes"] as $attributeId => $attributeValueId) {
                        // Kiểm tra xem attribute có tồn tại chưa
                        $existingAttribute = $this->variantAttributeService->checkExistsAttributeValue([
                            "product_variant_id" => $variantItem->id,
                            "attribute_id"       => $attributeId
                        ]);

                        if ($existingAttribute) {
                            // Nếu đã có thì update giá trị mới
                            $this->variantAttributeService->updateAttributeValue(
                                ["product_variant_id" => $variantItem->id, "attribute_id" => $attributeId],
                                ["attribute_value_id" => $attributeValueId]
                            );
                        } else {
                            // Nếu chưa có thì tạo mới
                            $this->variantAttributeService->create([
                                "product_variant_id" => $variantItem->id,
                                "attribute_id"       => $attributeId,
                                "attribute_value_id" => $attributeValueId
                            ]);
                        }
                    }
                }

                DB::commit();
                return redirect()->route("admin.ecommerce.product.index")->with("success", "Cập nhật thành công");
            }
        } catch (\Exception $exception) {
            \Log::error("=======[AdmEcommerceProductController.php] File: "
                .$exception->getFile()
                ." Line: ".$exception->getLine()
                ." Message: ".$exception->getMessage());
            DB::rollBack();
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }

    public function delete(Request $request, $id)
    {
        $product = $this->productService->findById($id);
        if (empty($product)) {
            return redirect()->back()->with("danger", "Không tồn tại sản phẩm");
        }

        $this->productService->delete($id);
        return redirect()->back()->with("success", "Cập nhật dữ liệu thành công");
    }

    public function deleteVariants(Request $request, $variantID)
    {
        try {
            DB::beginTransaction();
//            $this->variantAttributeService->
            DB::commit();
            return redirect()->back()->with("success", "Cập nhật dữ liệu thành công");
        } catch (\Exception $exception) {
            DB::rollBack();
            \Log::error("=======[AdmEcommerceProductController.php] File: "
                .$exception->getFile()
                ." Line: ".$exception->getLine()
                ." Message: ".$exception->getMessage());
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }
}
