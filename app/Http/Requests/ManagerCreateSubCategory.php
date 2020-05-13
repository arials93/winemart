<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerCreateSubCategory extends FormRequest
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
            'name' => 'required|unique:subcates,name',
            // cate_id phải tồn tại trong bảng cates
            'cate_id' => 'required|exists:cates,id',
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
            'name.required' => 'Vui lòng nhập tên loại sản phẩm',
            'name.unique' => 'Loại sản phẩm này đã tồn tại',
            'cate_id.required' => 'Vui lòng chọn loại cha',
            'cate_id.exists' => 'Loại sản phẩm này không tồn tại',
            'image.required' => 'Vui lòng chọn hình ảnh',
            'image.mimes' => 'Hệ thống chỉ hỗ trợ (jpg, jpeg, png, gif)',
        ];
    }
}
