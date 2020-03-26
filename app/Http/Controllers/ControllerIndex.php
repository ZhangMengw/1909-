<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerIndex extends Controller
{
    public function goods(){
        echo "我是商品首页";
    }
    public function add(){
        //判断是以什么方式跳转的
        if(request()->isMethod("get")){
            return view("add");            
        } 
        if(request()->isMethod("post")){
            echo request()->name;
        }
        //跳转页面  重定向
        // return redirect("/goods");
        
    }
    public function adddo(){
        echo request()->name;
    }
    //必填路由控制器
    public function show($id,$name){
        echo $id."==".$name;
    }
    // public function news($id=null){
    //     echo $id;
    // }
    public function news($id=null,$name=null){
        echo $id."==".$name;
    }
}
