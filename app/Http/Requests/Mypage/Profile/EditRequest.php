<?php

namespace App\Http\Requests\Mypage\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditRequest extends FormRequest
{

    private const GUEST_USER_ID = 2;
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
        if (Auth::id() == self::GUEST_USER_ID) {
            return [
                'image' => ['file', 'image'],
                'avatar' => 'file|image',
            ];
        } else {
            return [
                'image' => ['file', 'image'],
                'avatar' => 'file|image',
                'name'   => 'required|string|max:50',
            ];
        }
    }
}
