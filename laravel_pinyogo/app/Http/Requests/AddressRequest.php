<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'name' => [
                'required',
            ],
            'province' => [
                'required'
            ],
            'city' => [
                'required'
            ],
            'county' => [
                'required'
            ],
            'address_name'=>[
                'required'
            ],

            'zip_code'=>[
                'required',
                'regex:/^\d{6}$/'

            ]
        ];
    }

    public function messages()
    {
        return [
            'phone.required'=>'手机号不能为空',
            'phone.regex'=>"请输入正确的手机号",
            'name.required'=>'联系人名字不可以为空',
            'province.required'=>'省份请选择',
            'city.required'=>'城市请选择',
            'county.required'=>'县级请选择',
            'address_name.required'=>'详细地址请填写',
            'zip_code.required'=>'邮政编码不可以为空',
            'zip_code.regex'=>'请填写正确的邮政编码',
        ];
    }
}
