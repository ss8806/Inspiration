<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
            'name'          => ['required', 'string', 'max:20'],
            'description'   => ['required', 'string', 'max:200'],
            'content'       => ['required', 'string', 'min:10', 'max:2000'],
            'category'      => ['required', 'integer'],
            'price'         => ['required', 'integer', 'min:100', 'max:100000'],
        ];
    }

    public function attributes()
    {
        return [
            'name'        => 'アイディア名',
            'description' => 'アイディアの概要',
            'content'     => 'アイディアの内容',
            'category'    => 'カテゴリ',
            'price'       => '販売価格',
        ];
    }
}
