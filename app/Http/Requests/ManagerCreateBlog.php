<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerCreateBlog extends FormRequest
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
            'name' => 'required|unique:blogs,name',
            'sub_des' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'cateblog_id' => 'exists:cateblogs,id'
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
            'name.required' => 'Vui lòng nhập tên bài viết',
            'name.unique' => 'Bài viết này đã tồn tại',
            'sub_des.required' => 'Vui lòng nhập mô tả ngắn',
            'description.required' => 'Vui lòng nhập nội dung bài viết',
            'image.required' => 'Vui lòng chọn hình ảnh',
            'image.mimes' => 'Hệ thống chỉ hỗ trợ (jpg, jpeg, png, gif)',
            'cateblog_id.exists' => 'Loại bài viết này không tồn tại'
        ];
    }
}
