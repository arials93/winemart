<?php

namespace App\Http\Requests;

class ManagerUpdateCategory extends ManagerCreateCategory
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
            'name' => 'required|unique:cates,name,'.$cate_id
        ];
    }
}
