<?php

namespace App\Http\Requests;


class ManagerUpdateCountry extends ManagerCreateCountry
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $country_id = request()->route('id');
        return [
            'name' => 'required|unique:countries,name,'.$country_id
        ];
    }
}
