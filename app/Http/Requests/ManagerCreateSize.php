<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerCreateSize extends FormRequest
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
            'capacity' => 'required|integer|between:100,5000|unique:sizes,capacity'
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
            'capacity.required' => 'Vui lòng nhập kích cỡ sản phẩm',
            'capacity.unique' => 'Kích cỡ này đã tồn tại',
            'capacity.between' => 'Kích cỡ phải từ 100ml đến 5000ml',
            'capacity.integer' => 'Kích cỡ phải là chữ số',
        ];
    }
}
