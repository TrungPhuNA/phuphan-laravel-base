<?php

namespace App\Http\Controllers\Fe\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Attribute;
use App\Models\Ecommerce\Product;
use App\Service\ProductService;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request, $slug)
    {
        $productDetail = $this->productService->findBySlug($slug);
        $id = $productDetail->id;
        $product = Product::with([
            'variants.attributes.attribute', 'variants.attributes.attributeValue'
        ])->findOrFail($id);

        // Lấy danh sách thuộc tính có biến thể
        $attributes = Attribute::with('attributeValues')->whereIn('id', function ($query) use ($id) {
            $query->select('attribute_id')
                ->from('ec_variant_attributes')
                ->whereIn('product_variant_id', function ($subQuery) use ($id) {
                    $subQuery->select('id')
                        ->from('ec_product_variants')
                        ->where('product_id', $id);
                });
        })->get();

        $viewData = [
            "product"    => $product,
            "attributes" => $attributes
        ];
        return view("fe.ecommerce.product-detail.index", $viewData);
    }
}
