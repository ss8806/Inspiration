<?php

namespace App\Http\Requests\Mypage\Profile;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'avatar' => ['file', 'image'],
            'name' => [ 'string', 'min:4', 'max:15'],
            'email' =>[ 'string', 'max:100','email'],
        ];
    }

    public function attributes()
    {
        return [
            'name'        => '名前',
        ];
    }
}
