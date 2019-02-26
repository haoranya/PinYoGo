<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Ad_typeRequest extends FormRequest
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
            'ad_type'=>['required'],
            'key'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'ad_type.required'=>'广告分类不能为空',
            'key.required'=>'页面索引不能为空',
        ];
    }
}
