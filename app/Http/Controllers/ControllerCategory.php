<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\StoreCatePost;

class ControllerCategory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate = Category::get();
        
        $cateInfo = getCateInfo($cate);
        return view("category.index",["cateInfo"=>$cateInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Category::get();
        $cateInfo = getCateInfo($cate);
        // $cateInfo = $this->CateInfo($info);
        // dd($cateInfo);
        return view("category.create",["cateInfo"=>$cateInfo]);
    }

    // public function CateInfo($info,$pid=0){
    //     static $cInfo = [];
    //     foreach($info as $k=>$v){
    //         if($v->pid==$pid){
    //             dump($v);
    //             $cInfo[] = $v;
    //             $cInfo = CateInfo($info,$v["cate_id"]);
    //         }
    //     }
    //     return $cInfo;
    // }

    //ajax唯一性
    public function ajaxName(){
        $uname = request()->get("_value");
        $res = Category::where("cate_name",$uname)->count();
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
     */
    // public function store(Request $request)
    public function store(StoreCatePost $request)
    {
        $arr = $request->except("_token");
        // dd($arr);
        $res = Category::create($arr);
        // dd($res);
        if($res){
            return redirect("/category/index");
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
        $cateInfo = Category::find($id);
        $cateInfos = Category::get();
        // dd($cateInfo);
        return view("category.edit",["cateInfo"=>$cateInfo,"cateInfos"=>$cateInfos]);
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
        $arr = $request->except("_token");
        $res = Category::where("cate_id",$id)->update($arr);
        if($res!==false){
            return redirect("/category/index");
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
        $res = Category::destroy($id);
        if($res){
            if(request()->ajax()){
                return json_encode(["code"=>"00000","msg"=>"删除成功"]);
            }else{
                return redirect("/category/index");
            }
        }
    }
}
