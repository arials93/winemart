<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerUpdateBlog extends ManagerCreateBlog
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->route('id');
        $rules = parent::rules();
        $rules['name'] = 'required|unique:blogs,name,'.$id;
        $rules['image'] = 'nullable|mimes:jpg,jpeg,png,gif';
        return $rules;
    }
}
