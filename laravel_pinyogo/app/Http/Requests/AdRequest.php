<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'ad_title'=>'required',
            'url'=>'required',
            'ad_logo'=>'required|image|mimes:jpeg,jpg,png,gif,bmp',
            'logo'=>'image|mimes:jpeg,jpg,png,gif,bmp'
        ];
    }

    public function messages()
    {
        return [
            'ad_title.required'=>'广告标题不能为空',
            'url.required'=>'广告链接不能为空',
            'ad_logo.required'=>'LOGO图不能为空',
            'ad_logo.image'=>'只能上传图片',
            'ad_logo.mimes'=>'支持后缀为jpg，jpeg,png,bmp等图片',
            'logo.image'=>'只能上传图片',
            'logo.mimes'=>'后缀只能是jpeg,jpg,png,gif,bmp'
        ];
    }
}
