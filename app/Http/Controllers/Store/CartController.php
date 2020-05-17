<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Product;
use App\Order;
use App\DetailOrder;
use Cart;
use Auth;


class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::getContent();
        return view('store.cart', ['data' => $cart]);
    }

    public function ajax_index() {
        $cart = Cart::getContent();
        return response()->json($cart);
    }

    public function add($product_id)
    {
        $product = Product::findOrFail($product_id);
        if($product->sale > 0) {
            $price = $product->price - ($product->price * $product->sale / 100);
        } else {
            $price = $product->price;
        }
        Cart::add(array(
            'id' => 'cart_product_'.$product->id,
            'name' => $product->name,
            'price' => $price,
            'quantity' => 1,
            'associatedModel' => $product
        ));
        
        return response()->json(["status" => 'OK'], 200);
    }

    public function delete($row_id) {
        $id = 'cart_product_'.$row_id;
        Cart::remove($row_id);
        $total = Cart::getTotal();
        return response()->json(['total' => $total]);
    }

    public function update(Request $request, $row_id) {
        Cart::update($row_id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            ),
        ));

        $item = Cart::get($row_id);
        $total = Cart::getTotal();
        return response()->json(['total' => $total, 'product_total' => $item->price * $item->quantity]);
    }

    public function checkout()
    {
        if(Cart::isEmpty()) {
            // nếu giỏ hàng không có gì thì sẽ không được thanh toán
            abort(404);
        }
        return view('store.checkout');
    }

    public function order(OrderRequest $request)
    {
        $data = $request->all();
        $data['total'] = Cart::getTotal();
        if(Auth::check()) {
            $data['user_id'] = Auth::user()->id;
        }
        $order = Order::create($data);
        $cart = Cart::getContent();
        foreach($cart as $item) {
            DetailOrder::create([
                'quality' => $item->quantity,
                'price' => $item->price,
                'sale' => $item->associatedModel->sale,
                'total' => $item->quantity * $item->price,
                'order_id' => $order->id,
                'product_id' => $item->associatedModel->id,
            ]);
        }
        Cart::clear();
        return redirect()->route('store.cart.order-complete');
    }

    public function order_complete()
    {
        return view('store.order_complete');
    }
}
