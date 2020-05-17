<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Cart;


class CartController extends Controller
{
    public function index()
    {
        // Cart::clear();
        $cart = Cart::getContent();
        if(request()->ajax()) {
            return response()->json($cart);
        }

        return view('store.cart', ['data' => $cart]);
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
        return view('store.checkout');
    }
}
