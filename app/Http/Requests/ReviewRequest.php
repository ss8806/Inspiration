<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'rates'        =>['required'],
            'comment'       =>['required'],
        ];
    }

    public function attributes()
    {
        return [
            'rates'        => '５段階評価',
            'comment'       => '口コミ',
        ];
    }
}
