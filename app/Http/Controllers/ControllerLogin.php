<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class ControllerLogin extends Controller
{
    // 后台首页
    public function home(){
        return view("public/home");
    }

    // 登录首页
    public function login(){
        return view("login");
    }

    // 执行登录
    public function logindo(){
        $arr = request()->except("_token");
        // $arr["admin_pwd"] = md5($arr["admin_pwd"]);
        // dd($arr);
        $res = Admin::where("admin_name",$arr["admin_name"])->first();
        // dd($res);
        if(decrypt($res->admin_pwd) != $arr["admin_pwd"]){
            return redirect("/login")->with('msg','用户名或者密码错误！');
        }
        if(isset($arr["rember"])){
            Cookie::queue("adduser",$res,7*24*60);
        }
        session(["adduser"=>$res]);
        return redirect("/home");
        
    }
}
