<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Xiao;

class ControllerXiao extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 展示页面
     */
    public function index()
    {
        //查询数据
        $xiaoInfo = Xiao::orderBy("x_id","desc")->paginate(3);
        return view("xiao.index",["xiaoInfo"=>$xiaoInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 添加展示页面
     */
    public function create()
    {
        return view("xiao.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * //添加执行页面
     */
    public function store(Request $request)
    {
        $arr = $request->except("_token");
        // dd($arr);
        //单文件上传
        //判断是否有值
        if ($request->hasFile('x_img')) {
            //调用公用方法
            $arr["x_img"] = upload("x_img");
            }
        //多文件
        //判断是否有值
        if ($request->hasFile('x_imgs')) {
            //调用多文件公用方法
            $arr["x_imgs"] = uploads("x_imgs");
            //将数组转换为字符串  字符串才能入库
            $arr["x_imgs"] = implode("|",$arr["x_imgs"]);
            }
        // dd($arr);
        $res = Xiao::create($arr);
        if($res){
            return redirect("/xiao/index");
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
