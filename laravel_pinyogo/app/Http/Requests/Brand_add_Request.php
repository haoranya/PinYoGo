<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Brand_add_Request extends FormRequest
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
            'brand'=>'required',
            'ucfirst_brand'=>'required|regex:/^[A-Z]{1}$/',
        ];
    }

    public function messages()
    {
        return [
            'brand.required'=>'品牌不可以为空！！！',
            'ucfirst_brand.required'=>'品牌首字母不可以为空！！！',
            'ucfirst_brand.regex'=>'只能是一个大写字母'
        ];
    }
}
