<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerCreateBrand extends FormRequest
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
        return [
            'name' => 'required|unique:brands,name',
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
        return [
            'name.required' => 'Vui lòng nhập tên nhãn hiệu',
            'name.unique' => 'Nhãn hiệu này đã tồn tại',
            'image.required' => 'Vui lòng chọn hình ảnh',
            'image.mimes' => 'Hệ thống chỉ hỗ trợ (jpg, jpeg, png, gif)',
        ];
    }
}
