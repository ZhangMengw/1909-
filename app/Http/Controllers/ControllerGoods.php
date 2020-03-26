<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Goods;
use DB;
use App\Http\Requests\StoreGoodsPost;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;

class ControllerGoods extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //存储
        // session(["name"=>"zhangsan"]);
        //获取
        // echo session("name");
        //清楚
        // session(["name"=>null]);

        //使用request
        //存储
        // request()->session()->put("num",100);
        //获取
        // echo request()->session()->get("num");
        //清楚
        // request()->session()->forget("num");
        //删除所有
        // request()->session()->flush();
        //获取所有
        // dump(request()->session()->all());

        $name = request()->name??"";
        $page = request()->page??1;
        // echo $page;
        //redis
        $goods = Redis::get("goods_".$name."_".$page);
        // dd($goods);
        // echo $goods;
        // Redis::flushall();
        if(!$goods){
            echo "DB====";
            $where = [];
            if($name){
                    $where[] = ["goods_name","like","%$name%"];
            }
            // DB::connection()->enableQueryLog();
            $goods = Goods::leftjoin("brand","brand.brand_id","=","goods.brand_id")
                            ->leftjoin("category","category.cate_id","=","goods.cate_id")
                            ->where($where)
                            ->orderBy("goods_id","desc")
                            ->paginate(3);
            $goods = serialize($goods);
            Redis::setex("goods_".$name."_".$page,60*60*24,$goods);
        }
        $goods = unserialize($goods);
        // dd($goods);
        // $logs = DB::getQueryLog();
        // dd($logs);
        // $query = request()->all();
        return view("goods.index",["goods"=>$goods,"name"=>$name]);
    }

    //ajax
    public function ajaxName(){
        $uname = request()->get("_value");
        $res = Goods::where("goods_name",$uname)->count();
        // dd($res);
        if($res>0){
            echo "no";
        }else{
            echo "ok";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $brandInfo = Brand::get();
        $cate = Category::get();
        // dd($cate);
        $cateInfo = getCateInfo($cate);
        // dd($cateInfo);
        return view("goods.create",["brandInfo"=>$brandInfo,"cateInfo"=>$cateInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(StoreGoodsPost $request)
    {
        $arr = $request->except("_token");
        //单文件上传
        if($request->hasFile("goods_img")){
            $arr["goods_img"] = upload("goods_img");
        }
        //多文件上传
        if($request->hasFile("goods_imgs")){
            $arr["goods_imgs"] = uploads("goods_imgs");
            $arr["goods_imgs"] = implode("|",$arr["goods_imgs"]);
        }
        // dd($arr);
        //使用ORM将数据进库
        $res = Goods::create($arr);
        //判断
        if($res){
            return redirect("goods/index");
        }


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $goodsInfo = Goods::find($id);
        $goodsInfo = Goods::where("goods_id",$id)->first();
        $brandInfo = Brand::get();
        $cate = Category::get();
        // dd($cate);
        $cateInfo = getCateInfo($cate);
        // dd($goodsInfo);
        return view("goods.edit",["goodsInfo"=>$goodsInfo,"brandInfo"=>$brandInfo,"cateInfo"=>$cateInfo]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    public function update(StoreGoodsPost $request,$id)
    {
        $arr = $request->except("_token");

        // $request->validate([
        //     'goods_name' => [
        //         'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
        //         Rule::unique('goods')->ignore($id,"goods_id"),
        // ],
        //         'cate_id' => 'required',
        //         'brand_id' => 'required',
        //         'goods_num' => 'required|between:1,9999999|integer',
        //         'goods_price'=>'required|integer',
        // ],[
        //         "goods_name.required"=>"商品名称必填",
        //         "goods_name.unique"=>"商品名称已存在",
        //         "goods_name.regex"=>"长度在2-50位,可以包含数字、字母、下划线、汉字组成",
        //         "cate_id.required"=>"商品分类必填",
        //         "brand_id.required"=>"商品品牌必填",
        //         "goods_num.required"=>"商品库存必填",
        //         "goods_num.between"=>"商品库存最大8位",
        //         "goods_num.integer"=>"商品库存必须为数字",
        //         "goods_price.required"=>"商品价格必填",
        //         "goods_price.integer"=>"商品价格必须为数字",
        // ]);

        //单文件上传
        if($request->hasFile("goods_img")){
            $arr["goods_img"] = $this->upload("goods_img");
        }
        //多文件上传
        if($request->hasFile("goods_imgs")){
            $arr["goods_imgs"] = $this->uploads("goods_imgs");
            $arr["goods_imgs"] = implode("|",$arr["goods_imgs"]);
        }
        // dd($arr);
        //使用ORM将数据进库
        $res = Goods::where("goods_id",$id)->update($arr);
        //判断
        if($res!==false){
            return redirect("/goods/index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo $id;
        $res = Goods::where("goods_id",$id)->delete();
        if($res){
            if(request()->ajax()){
                return json_encode(["code"=>"00000","msg"=>"删除成功"]);
            }else{
                return redirect("/goods/index");
            }
        }
    }
}
