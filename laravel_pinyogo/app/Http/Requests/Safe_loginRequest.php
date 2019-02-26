<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Safe_loginRequest extends FormRequest
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
            'phone' => [
                'required',
                'regex:/^0?(13|14|15|17|18)[0-9]{9}$/'
            ],
            'code' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'phone.required'=>'手机号不能为空',
            'phone.regex'=>"请输入正确的手机号",
            'code.required'=>'请输入六位验证码'
        ];
    }
}
