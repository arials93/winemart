<?php

namespace App\Http\Requests;

class ManagerUpdateProduct extends ManagerCreateProduct
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $brand_id = request()->route('id');
        $size_id = request()->route('id');
        $country_id = request()->route('id');
        $subcate_id = request()->route('id');
        $year = now()->year;
        return [
            'name' => 'required|max:255',
            'barcode' => 'numeric|digits_between:10,13',
            'abv' => 'numeric|between:1,99',
            'vintage' => 'numeric|between:1600,'.$year,
            'price' => 'required|integer',
            'sale' => 'required|integer',
            'instock' => 'required|integer',
            'brand_id' =>'exists:brands,id,'.$brand_id,
            'size_id' =>'exists:sizes,id,'.$size_id,
            'country_id' =>'exists:countries,id,'.$country_id,
            'subcate_id' =>'exists:subcates,id,'.$subcate_id,
            'image' => 'required|mimes:jpg,jpeg,png,gif',
        ];
    }
}
