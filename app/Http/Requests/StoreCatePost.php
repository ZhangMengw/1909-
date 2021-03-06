<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCatePost extends FormRequest
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
            "cate_name"=>"required|unique:category",
            "cate_desc"=>"required",
        ];
    }
    public function messages(){
        return[
            "cate_name.required"=>"分类名称不能为空",
            "cate_name.unique"=>"分类名称已存在",
            "cate_desc.required"=>"分类描述必填",
        ];
    }
}
