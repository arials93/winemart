<?php

namespace App\Http\Requests;

class ManagerUpdateSubCategory extends ManagerCreateSubCategory
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $cate_id = request()->route('id');
        return [
            'name' => 'required|unique:subcates,name,'.$cate_id,
            // cate_id phải tồn tại trong bảng cates
            'cate_id' => 'required|exists:cates,id',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
        ];
    }
}
