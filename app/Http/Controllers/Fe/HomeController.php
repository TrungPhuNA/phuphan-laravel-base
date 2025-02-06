<?php

namespace App\Http\Controllers\Fe;

use App\Http\Controllers\Controller;
use App\Service\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected ProductService $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    public function index(Request $request)
    {
        $conditions = $request->all();
        $products = $this->productService->getListsProducts($conditions);
        $viewData = [
            "products" => $products
        ];
        return view("fe.home.index", $viewData);
    }
}
