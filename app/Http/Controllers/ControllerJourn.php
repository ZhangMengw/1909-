<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cate;
use App\Journ;
use Validator;
use Illuminate\Support\Facades\Cache;

class ControllerJourn extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journ_name = request()->journ_name??"";
        echo $journ_name;
        $page = request()->page??1;
        // dd($page);
        
        $journInfo = Cache::get("cate_".$page."_".$journ_name);
        // echo $journInfo;
        // Cache::flush();
        if(!$journInfo){
           
            echo "DB====";
            $where = [];
            if($journ_name){
                $where[] = ["journ_name","like","%$journ_name%"];
            }
            $journInfo = Journ::leftjoin("cate","journ.cate_id","=","cate.cate_id")
                                ->where($where)
                                ->paginate(2);
            Cache::put("cate_".$page."_".$journ_name,$journInfo,60*60*24);
        }else{
            echo "123";
        }
        
        //ajax页面刷新分页
        //判断是否接收到ajax
        if(request()->ajax()){
            //接收到Ajax 返回视图新页面
            return view("journ.ajaxpage",["journInfo"=>$journInfo]);
        }
        return view("journ.index",["journInfo"=>$journInfo,"name"=>$journ_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Cate::get();
        // dd($cate);
        $cateInfo = getCateInfo($cate);
        return view("journ.create",["cateInfo"=>$cateInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = $request->except("_token");
        $validator = Validator::make($arr,
        [
            'journ_name' => 'required|unique:journ|regex:/^[\x{4e00}-\x{9fa5}\w]{2,30}$/u',
            'journ_man' => 'required',
        ],[
            "journ_name.required"=>"新闻标题必填",
            "journ_name.unique"=>"新闻标题已存在",
            "journ_name.regex"=>"长度为2-30位，需是中文、字母、数字、下划线组成",
            "journ_man.required"=>"新闻作者必填",
        ]);
        if ($validator->fails()) {
            return redirect('journ/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $arr["journ_time"] = time();
        $res = Journ::create($arr);
        if($res){
            return redirect("/journ/index");
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
