<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Goods_updateRequest extends FormRequest
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
            'cat_one_id'=>'required',
            'cat_two_id'=>'required',
            'cat_three_id'=>'required',
            'goods_name'=>'required',
            'brand_id'=>'required',
            'price'=>'required|numeric',
            'number'=>'required|numeric',
            'desc'=>'required',
            'packing'=>'required',
            'serve'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'cat_one_id.required'=>'分类不可以为空！！！',
            'cat_two_id.required'=>'分类不可以为空！！！',
            'cat_three_id.required'=>'分类不可以为空！！！',
            'goods_name.required'=>'商品名不可以为空！！！',
            'brand_id.required'=>'品牌名不可以为空！！！',
            'price.required'=>'价格不可以为空！！！',
            'price.numeric'=>'值必需是数字',
            'number.required'=>'库存量不可以为空！！！',
            'number.numeric'=>'值必需是数字',
            'desc.required'=>'描述不可以为空！！！',
            'packing.required'=>'包装不可以为空！！！',
            'serve.required'=>'售后不可以为空！！！',
        ];
    }
}
