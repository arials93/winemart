<?php

namespace App\Http\Requests;

class ManagerUpdateBrand extends ManagerCreateBrand
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $brand_id = request()->route('id');
        return [
            'name' => 'required|unique:brands,name,'.$brand_id,
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
        ];
    }
}
