<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeckillRequest extends FormRequest
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
            'start'=>'required|date',
            'over'=>'required|date',
            'title'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'start.required'=>'开始时间不可以为空！！！',
            'start.date'=>'必须是日期格式',
            'over.required'=>'结束时间不可以为空！！！',
            'over.date'=>'必须是日期格式',
            'title.required'=>'标题不能为空'
        ];
    }
}
