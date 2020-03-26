<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGoodsPost extends FormRequest
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
        if($name=='goodsstore'){
            return [
                'goods_name' => 'required|unique:goods|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
                'cate_id' => 'required',
                'brand_id' => 'required',
                'goods_num' => 'required|between:1,9999999|integer',
                'goods_price'=>'required|integer',
            ];
        }else{
            return [
                'goods_name' => [
                    'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
                    Rule::unique('goods')->ignore(request()->id,"goods_id"),
                ],
                    'cate_id' => 'required',
                    'brand_id' => 'required',
                    'goods_num' => 'required|between:1,9999999|integer',
                    'goods_price'=>'required|integer',
            ];
        }
    }
    public function messages(){
        return [
            "goods_name.required"=>"商品名称必填",
            "goods_name.unique"=>"商品名称已存在",
            "goods_name.regex"=>"长度在2-50位,可以包含数字、字母、下划线、汉字组成",
            "cate_id.required"=>"商品分类必填",
            "brand_id.required"=>"商品品牌必填",
            "goods_num.required"=>"商品库存必填",
            "goods_num.between"=>"商品库存最大8位",
            "goods_num.integer"=>"商品库存必须为数字",
            "goods_price.required"=>"商品价格必填",
            "goods_price.integer"=>"商品价格必须为数字",
        ];
    }
}
