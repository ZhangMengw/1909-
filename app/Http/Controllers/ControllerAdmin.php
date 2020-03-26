<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Validator;
use Illuminate\Validation\Rule;

class ControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = request()->get("name");
        
        $where = [];
        if($name){
            $where[] = ["admin_name","like","%$name%"];
        }
        $admin = Admin::where($where)->paginate(2);
        // dd($admin);
        return view("admin.index",["admin"=>$admin,"name"=>$name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.create");
    }
    //ajax验证唯一性
    public function ajaxName(){
        $uname = request()->get("_value");
        // dd($uname);
        $res = Admin::where("admin_name",$uname)->count();
        // dd($res);
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
    public function store(Request $request)
    {
        $arr = $request->except("_token");
        $validator = Validator::make($arr,
        [
            'admin_name' => 'required|unique:admin|regex:/^[\x{4e00}-\x{9fa5}\w——]{2,16}$/u',
            'admin_pwd' => 'min:6',
            'admin_email' => 'email',
            'admin_tel' => 'regex:/^1[35789]\d{9}$/u',
        ],[
            "admin_name.required"=>"管理员名称不能为空",
            "admin_name.unique"=>"管理员名称已存在",
            "admin_name.regex"=>"管理员名称由2-16位的中文、字母、数字、下划线、破折号组成",
            "admin_pwd.min"=>"管理员密码最少6位",
            "admin_email.email"=>"管理员邮箱格式不正确",
            "admin_tel.regex"=>"管理员手机号格式不正确",
        ]);
        if ($validator->fails()) {
            return redirect('admin/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        if($request->hasFile("admin_img")){
            $arr["admin_img"] = upload("admin_img");
        }
        // dd($arr);
        $arr["admin_pwd"] = encrypt($arr["admin_pwd"]);
        $res = Admin::create($arr);
        if($res){
            return redirect("/admin/index");
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
        $adminInfo = Admin::where("admin_id",$id)->first();
        // dd($adminInfo);
        return view("admin.edit",["adminInfo"=>$adminInfo]);
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
        $validator = Validator::make($arr,
        [
            'admin_name' => [
                'regex:/^[\x{4e00}-\x{9fa5}\w——]{2,16}$/u',
                Rule::unique('admin')->ignore($id,"admin_id"),
            ],
            'admin_pwd' => 'min:6',
            'admin_email' => 'email',
            'admin_tel' => 'regex:/^1[35789]\d{9}$/u',
        ],[
            "admin_name.required"=>"管理员名称不能为空",
            "admin_name.unique"=>"管理员名称已存在",
            "admin_name.regex"=>"管理员名称由2-16位的中文、字母、数字、下划线、破折号组成",
            "admin_pwd.min"=>"管理员密码最少6位",
            "admin_email.email"=>"管理员邮箱格式不正确",
            "admin_tel.regex"=>"管理员手机号格式不正确",
        ]);
        if ($validator->fails()) {
            return redirect('admin/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        if($request->hasFile("admin_img")){
            $arr["admin_img"] = upload("admin_img");
        }
        $arr["admin_pwd"] = md5($arr["admin_pwd"]);
        // dd($arr);
        $res = Admin::where("admin_id",$id)->update($arr);
        if($res){
            return redirect("/admin/index");
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
        $res = Admin::where("admin_id",$id)->delete();
        if($res){
            if(request()->ajax()){
                return json_encode(["code"=>"00000","msg"=>"删除成功"]);
            }else{
                return redirect("/admin/index");
            }
        }
    }
}
