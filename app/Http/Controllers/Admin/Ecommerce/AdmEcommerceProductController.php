<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\RequestCreateArticle;
use App\Http\Requests\Admin\Ecommerce\RequestCreateProduct;
use App\Service\BrandService;
use App\Service\CategoryService;
use App\Service\LabelService;
use App\Service\ProductService;
use Illuminate\Http\Request;

class AdmEcommerceProductController extends Controller
{
    protected LabelService $labelService;
    protected CategoryService $categoryService;
    protected BrandService $brandService;
    protected ProductService $productService;

    public function __construct(
        LabelService $labelService,
        CategoryService $categoryService,
        BrandService $brandService,
        ProductService $productService,
    ) {
        $this->labelService = $labelService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
        $this->productService = $productService;
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
            "labelsActive" => []
        ];

        return view('admin.ecommerce.product.create', $viewData);
    }

    public function store(RequestCreateProduct $requestCreateProduct)
    {
        $modelDto = $requestCreateProduct->except("_token");
        $product = $this->productService->create($modelDto);
        if ($product) {
            if (!empty($requestCreateProduct->labels)) {
                $this->productService->syncLabels($requestCreateProduct->labels, $product->id);
            }

            return redirect()->route("admin.ecommerce.product.index")->with("success", "Tạo mới thành công");
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $viewData = [
            "categories"   => $this->categoryService->getAll(),
            "brands"       => $this->brandService->getAll(),
            "product"      => $this->productService->findById($id),
            "labels"       => $this->labelService->getAll(),
            "labelsActive" => $this->productService->getLabelsIdByProduct($id)
        ];

        return view('admin.ecommerce.product.update', $viewData);
    }

    public function update(RequestCreateProduct $request, $id)
    {
        $data = $request->all();
        $update = $this->productService->update($id, $data);
        if ($update) {
            if (!empty($request->labels)) {
                $this->productService->syncLabels($request->labels, $id);
            }
            return redirect()->route("admin.ecommerce.product.index")->with("success", "Cập nhật thành công");
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }

    public function delete(Request $request, $id)
    {
        $product = $this->productService->findById($id);
        if (empty($product)) {
            return redirect()->back()->with("danger", "Không tồn tại bài viết");
        }

        $this->productService->delete($id);
        return redirect()->back()->with("success", "Cập nhật dữ liệu thành công");
    }
}
