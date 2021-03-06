<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Integer;

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
            'image'       => 'nullable|file|image',
            'price'       => 'required|integer|min:100|max:9999999',
            'size'        => 'required|alpha_num',
            'material'    => 'required|string',
            'item_category'    => 'required|integer',
            'brand_category'    => 'required|integer',
        ];
    }
    public function attributes()
    {
        return [
            'name'        => '商品名',
            'description' => '商品の説明',
            'image'       => '商品画像',
            'price'       => '販売価格',
            'size'        => 'サイズ',
            'material'    => '素材',
            'item_category'    => 'アイテムカテゴリ',
            'brand_category'    => 'ブランドカテゴリ',
        ];
    }
}
