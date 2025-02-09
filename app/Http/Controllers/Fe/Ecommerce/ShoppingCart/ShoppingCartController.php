<?php

namespace App\Http\Controllers\Fe\Ecommerce\ShoppingCart;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Product;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        return view('fe.ecommerce.shopping-cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $variants = $request->variants;

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại!']);
        }

        Cart::add([
            'id'       => $productId,
            'name'     => $product->name,
            'price'    => $product->price,
            'quantity' => $quantity,
            'attributes' => [
                'image'  => $product->image,
                'variant' => json_encode($variants)
            ]
        ]);

        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng']);
    }

    public function updateCart(Request $request)
    {
        Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value'    => $request->quantity
            ],
        ]);

        return response()->json(['success' => 'Giỏ hàng đã được cập nhật']);
    }

    public function removeFromCart(Request $request)
    {
        Cart::remove($request->id);
        return response()->json(['success' => 'Sản phẩm đã bị xóa khỏi giỏ hàng']);
    }

    public function checkout(Request $request)
    {
        $cartItems = Cart::getContent();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Giỏ hàng trống'], 400);
        }

//        $order = Order::create([
//            'user_id' => auth()->id(),
//            'total_price' => Cart::getTotal(),
//            'status' => 'pending'
//        ]);
//
//        foreach ($cartItems as $item) {
//            OrderItem::create([
//                'order_id' => $order->id,
//                'product_id' => explode('-', $item->id)[0], // Lấy ID sản phẩm gốc
//                'quantity' => $item->quantity,
//                'price' => $item->price,
//                'variants' => json_encode($item->attributes->variants)
//            ]);
//        }

        Cart::clear(); // Xóa giỏ hàng sau khi đặt hàng thành công

        return response()->json(['success' => 'Đơn hàng đã được tạo']);
    }
}
