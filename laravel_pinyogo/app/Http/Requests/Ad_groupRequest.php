<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Ad_groupRequest extends FormRequest
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
            'group' => ['required','unique:ad_groups'],
        ];
    }

    public function messages()
    {
        return [
            'group.required'=>'分组不能为空',
            'group.unique'=>'分组已经存在'
        ];
    }
}
