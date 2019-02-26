<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Admin_loginRequest extends FormRequest
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
            'admin'=>'required',
            'password'=>'required|min:5|max:10',
            'code'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'admin.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码最少填写五位',
            'password.max'=>'密码最多填写十位',
            'code.required'=>"验证码不能为空"
        ];
    }
}
