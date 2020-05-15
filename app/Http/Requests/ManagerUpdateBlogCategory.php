<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerUpdateBlogCategory extends ManagerCreateBlogCategory
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->route('id');
        return [
            'name' => 'required|unique:cateblogs,name,'.$id
        ];
    }
}
