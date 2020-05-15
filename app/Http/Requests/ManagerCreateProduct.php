<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerCreateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
            'image' => 'required|mimes:jpg,jpeg,png,gif',
        ];
        
    }

     /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        $year = now()->year;
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.max' => 'Tên sản phẩm không quá 255 kí tự',
            'barcode.numeric' => 'Mã vạch phải là chữ số',
            'barcode.digits_between' => 'Mã vạch phải từ 10 đến 13 chữ số',
            'abv.numeric' => 'Nồng độ phải là chữ số',
            'abv.between' => 'Nồng độ phải từ 1 đến 99',
            'vintage.numeric' => 'Năm sản xuất phải là chữ số',
            'vintage.between' => 'Năm sản xuất phải từ năm 1600 đến '.$year,
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.integer' => 'Giá sản phẩm phải đúng kiểu số',
            'sale.required' => 'Vui lòng nhập giảm giá',
            'sale.integer' => 'Giảm giá phải đúng kiểu số',
            'instock.required' => 'Vui lòng nhập số lượng tồn',
            'instock.integer' => 'Số lượng tồn phải đúng kiểu số',
            'brand_id.exists' => 'Nhãn hiệu này không tồn tại',
            'country_id.exists' => 'Quốc gia này không tồn tại',
            'size_id.exists' => 'Kích cỡ này không tồn tại',
            'subcate_id.exists' => 'Loại sản phẩm con này không tồn tại',
            'image.mimes' => 'Hệ thống chỉ hỗ trợ (jpg, jpeg, png, gif)',
        ];
    }
}
