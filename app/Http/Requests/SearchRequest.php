<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => ['required', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:200'],
            'content'     => ['required', 'string', 'max:2000'],
            'category'    => ['required', 'integer'],
            'price'       => ['required', 'integer', 'min:100', 'max:9999999'],
        ];
    }
}
