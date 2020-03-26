<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *授权
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *验证规则
     * @return array
     */
    public function rules()
    {
        return [
            'brand_name' => 'required|unique:brand|max:20',
            'brand_url' => 'required',
        ];
    }
    public function messages(){
        return [
            "brand_name.required"=>"商品名称必填",
            "brand_name.unique"=>"商品名称已存在",
            "brand_name.max"=>"商品名称不能大于20位",
            "brand_url.required"=>"商品网址必填",
        ];
    }
}
