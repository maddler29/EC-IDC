<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'        => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'image'       => 'required',
            'price'       => 'required|integer|min:100|max:9999999',
            'size'        => 'required|alpha_num',
            'material'    => 'required|string',
        ];
    }
}
