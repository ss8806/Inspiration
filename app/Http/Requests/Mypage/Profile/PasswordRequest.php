<?php

namespace App\Http\Requests\Mypage\Profile;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password' => ['required',    
                function ($attribute, $value, $fail) {
                if(!(\Hash::check($value, \Auth::user()->password))) {
                    return $fail('現在のパスワードを正しく入力してください');
                    }
                },
            ],
            'new-password' => ['required','min:8', 'max:20','confirmed'],
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'パスワード',
            'new-password'    => '新しいパスワード',
            'new-password_confirmation'     => '新しいパスワード（再入力）',
        ];
    }
}
