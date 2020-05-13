<?php

namespace App\Http\Requests;


class ManagerUpdateSize extends ManagerCreateSize
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $size_id = request()->route('id');
        return [
            'capacity' => 'required|integer|between:100,5000|unique:sizes,capacity,'.$size_id
        ];
    }
}
