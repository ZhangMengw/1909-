<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Article;
use App\Http\Requests\StoreArticlePost;

class ControllerArticle extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = request()->name;
        $t_name = request()->t_name;
        $where = [];
        if($name){
            $where[] = ["article_name","like","%$name%"];
        }
        if($t_name){
            $where[] = ["t_name","like","%$t_name%"];
        }
        $artiInfo = Article::where($where)
                                ->leftjoin("type","article.t_id","=","type.t_id")
                                ->paginate(3);
        $type = Type::get();
        return view("article.index",["artiInfo"=>$artiInfo,"name"=>$name,"t_name"=>$t_name,"type"=>$type]);
    }
    
    public function ajaxName(){
        $uname = request()->get("_value");
        // dd($uname);
        $res = Article::where("article_name",$uname)->count();
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
        $type = Type::get();
        return view("article.create",["type"=>$type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(StoreArticlePost $request)
    
    {
        $arr = $request->except("_token");
        if($request->hasFile("article_img")){
            $arr["article_img"] = upload("article_img");
        }
        // dd($arr);
        $res = Article::create($arr);
        if($res){
            return redirect("/article/index");
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
        $artiInfo = Article::where("article_id",$id)->first();
        $type = Type::get();
        return view("article.edit",["artiInfo"=>$artiInfo,"type"=>$type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    public function update(StoreArticlePost $request,$id)
    {
        $arr = $request->except("_token");
        if($request->hasFile("article_img")){
            $arr["article_img"] = upload("article_img");
        }
        // dd($arr);
        $res = Article::where("article_id",$id)->update($arr);
        if($res!==false){
            return redirect("/article/index");
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
        $res = Article::where("article_id",$id)->delete();
        if($res){
            if(request()->ajax()){
                echo json_encode(['code'=>'00000','msg'=>'删除成功']);die;
            }else{
                return redirect("/article/index");
            }
        }
    }
}
