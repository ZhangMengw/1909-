<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Brand;
use App\Http\Requests\StoreBrandPost;

class ControllerBrand extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 展示页面
     */
    public function index()
    {
        //接收搜索的传值
        $name = request()->name;
        $url = request()->url;
        //定义个空数组
        $where = [];

        //判断接受的是否有值
        if($name){
            $where[] = ["brand_name","like","%$name%"];
        }
        if($url){
            $where[] = ["brand_url","like","%$url%"];
        }

        //DB方式
        // $brand = DB::table("brand")->get();

        //ORM第一种方式
        // $brand = Brand::all();

        //ORM第二种方式
        $brand = Brand::where($where)->orderBy("brand_id","desc")->paginate(3);
        // dd($brand);
        $query = request()->all();
        // dump($query);
        return view("/brand/index",["brand"=>$brand,"name"=>$name,"url"=>$url]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 添加展示页面
     */
    public function create()
    {
        return view("brand.create");
    }

    public function ajaxName(){
        $uname = request()->get("_value");
        $res = Brand::where("brand_name",$uname)->count();
        if($res>0){
            echo "no";
        }else{
            echo "ok";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 添加执行页面
     */
    public function store(Request $request)
    //第二种表单验证
    // public function store(StoreBrandPost $request)
    {
        $arr = $request->except("_token");
        // dd($arr);
        //商品名称 商品网址表单验证
        //第一种表单验证
        // $validatedData = $request->validate([
        //     'brand_name' => 'required|unique:brand|max:20',
        //     'brand_url' => 'required',
        // ],[
        //     "brand_name.required"=>"商品名称必填",
        //     "brand_name.unique"=>"商品名称已存在",
        //     "brand_name.max"=>"商品名称不能大于20位",
        //     "brand_url.required"=>"商品网址必填",
        // ]);
        $validator = Validator::make($arr,[
            'brand_name' => 'required|unique:brand|max:20',
            'brand_url' => 'required',
        ],[
            "brand_name.required"=>"商品名称必填",
            "brand_name.unique"=>"商品名称已存在",
            "brand_name.max"=>"商品名称不能大于20位",
            "brand_url.required"=>"商品网址必填",
        ]);
        if ($validator->fails()) {
            return redirect('brand/create')
                            ->withErrors($validator)
                            ->withInput();
        }


        //DB方式
        // $res = DB::table("brand")->insert($arr);

        //ORM第一种方式
        // $brand = new Brand;
        // $brand->brand_name = $request->brand_name;
        // $brand->brand_url = $request->brand_url;
        // $brand->brand_logo = $request->brand_logo;
        // $brand->brand_desc = $request->brand_desc;
        // $res = $brand->save();

        //单独接收文件
        // $arr["brand_logo"] = $request->file('brand_logo');

        // 单文件上传
        //判断方法中文件请求是否存在
        if ($request->hasFile('brand_logo')) {
            $arr["brand_logo"] = Upload("brand_logo");
            }
        
        // 多文件上传
        if ($request->hasFile("brand_logos")){
            //调用公用多文件方法
            $arr["brand_logos"] = uploads("brand_logos");
            //将数组转换为字符串 只有字符串才能入库
            $arr["brand_logos"] = implode("|",$arr["brand_logos"]);
        }
        // dd($arr);
        
        //ORM第二种方式
        $res = Brand::create($arr);
        // dd($res);
        if($res){
            return redirect("/brand/index");
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
     * 修改展示
     */
    public function edit($id)
    {
        //DB方式
        // $brandInfo = DB::table("brand")->where("brand_id",$id)->first();
        // dd($brandInfo);

        //ORM第一种方式
        $brandInfo = Brand::find($id);

        //ORM第二种方式
        // $brandInfo = Brand::where("brand_id",$id)->first();
        return view("brand.edit",["brandInfo"=>$brandInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * //修改执行
     */
    public function update(Request $request, $id)
    {
        // echo $id;
        $arr = $request->except("_token");
        //DB方式
        // $res = DB::table("brand")->where("brand_id",$id)->update($arr);
        
        //ORM第一种方式
        // $res = Brand::find($id);
        // $brand->brand_name = $request->brand_name;
        // $brand->brand_url = $request->brand_url;
        // $brand->brand_logo = $request->brand_logo;
        // $brand->brand_desc = $request->brand_desc;
        // $res = $brand->save();

        //ORM第二种方式
        //判断图片信息是否有误
        if ($request->hasFile('brand_logo')) {
            //调用公有方法
            $arr["brand_logo"] = $this->Upload("brand_logo");
            }
        $res = Brand::where("brand_id",$id)->update($arr);
        //如果返回信息不全等与false就让他执行
        if($res!==false){
            return redirect("/brand/index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 删除
     */
    public function destroy($id)
    {
        // $res = DB::table("brand")->where("brand_id",$id)->delete();

        //ORM
        $res = Brand::destroy($id);
        if($res){
            if(request()->ajax()){
                return json_encode(["code"=>"000000","msg"=>"删除成功"]);
            }else{
                return redirect("/brand/index");
            }
        }
    }
}
