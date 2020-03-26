<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticlePost extends FormRequest
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
        $name = \Route::currentRouteName();
        if($name=="articlestore"){
            return [
                "article_name"=>"required|unique:article|regex:/^[\x{4e00}-\x{9fa5}0-9a-zA-Z_\s]+$/u",
            ];
        }else{
            return [
                "article_name"=>
                [
                    "regex:/^[\x{4e00}-\x{9fa5}0-9a-zA-Z_\s]+$/u",
                    Rule::unique('article')->ignore(request()->id,"article_id"),
                ],
            ];
        }
        
    }
    public function messages(){
        return [
            "article_name.required"=>"文章标题必填",
            "article_name.unique"=>"文章标题已存在",
            "article_name.max"=>"文章标题是中文字母数字下划线",
        ];
    }
}
