<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $subcates = \App\SubCategory::all();
        $brands = \App\Brand::all();
        $countries = \App\Country::all();
        $sizes = \App\Size::all();

        $data = [
            'subcates' => $subcates,
            'brands' => $brands,
            'countries' => $countries,
            'sizes' => $sizes,
        ];


        
        $search_data = [];
        if($request->category) {
            array_push($search_data, [
                'subcate_id', '=', $request->category
            ]);
        }
        if($request->country) {
            array_push($search_data, [
                'country_id', '=', $request->country
            ]);
        }
        if($request->size) {
            array_push($search_data, [
                'size_id', '=', $request->size
            ]);
        }
        if($request->brand) {
            array_push($search_data, [
                'brand_id', '=', $request->brand
            ]);
        }
        if($request->name) {
            array_push($search_data, [
                'name', 'LIKE', '%'.$request->name.'%'
            ]);
        }
        
        if(count($search_data) > 0) {
            $products = Product::where($search_data)->orderby('id', 'desc')->paginate(9);
        } else {
            $products = Product::orderby('id', 'desc')->paginate(9);
        }
        $data['products'] = $products;
        return view('store.products', $data);
    }

    public function product($id)
    {
        $product = Product::findOrFail($id);
        return view('store.product', ['product' => $product]);
    }
}
