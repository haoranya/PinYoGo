<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Manager_loginRequest extends FormRequest
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
            'manager'=>'required',
            'password'=>'required|min:5|max:10',
        ];
    }

    public function messages()
    {
        return [
            'manager.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码最少填写五位',
            'password.max'=>'密码最多填写十位',
        ];
    }
}
