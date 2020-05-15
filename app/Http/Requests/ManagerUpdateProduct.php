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
        $year = now()->year;
        return [
            'name' => 'required|max:255',
            'barcode' => 'numeric|digits_between:10,13',
            'abv' => 'numeric|between:1,99',
            'vintage' => 'numeric|between:1600,'.$year,
            'price' => 'required|integer',
            'sale' => 'required|integer',
            'instock' => 'required|integer',
            'brand_id' =>'exists:brands,id',
            'size_id' =>'exists:sizes,id',
            'country_id' =>'exists:countries,id',
            'subcate_id' =>'exists:subcates,id',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
        ];
    }
}
