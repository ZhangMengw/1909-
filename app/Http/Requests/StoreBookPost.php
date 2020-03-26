<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookPost extends FormRequest
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
            'book_name' => 'required|unique:book|between:2,15|regex:/^[\x{4e00}-\x{9fa5}0-9a-zA-Z-_\s]+$/u',
            'book_man' => 'required',
        ];
    }
    public function messages(){
        return [
            "book_name.required"=>"图书名称必填",
            "book_name.unique"=>"图书名称已存在",
            "book_name.between"=>"图书名称不能大于15位小于2位",
            "book_name.regex"=>"需是中文、字母、数字、下划线组成",
            "book_man.required"=>"图书作者必填",
        ];
    }
}
