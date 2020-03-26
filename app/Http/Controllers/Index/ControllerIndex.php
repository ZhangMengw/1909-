<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Goods;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ControllerIndex extends Controller
{
    public function index(){

        //推荐
        // $resInfo = Cache::get("is_seild");
        // dd($resInfo);
        // if(!$resInfo){
        //     echo "DB=====";
        //     $resInfo = Goods::where("is_seild",1)->orderBy("goods_id","desc")->take(5)->get();    
        //     Cache::put("is_seild",$resInfo,60*60*24);
            
        // }

        //redis
        $resInfo = Redis::get("is_seild");
        
        // dd($resInfo);
        // Redis::flushall();
        if(!$resInfo){
            // echo "DB====";
            $resInfo = Goods::where("is_seild",1)->orderBy("goods_id","desc")->take(5)->get(); 
            // dump($resInfo);
            $resInfo = serialize($resInfo);
            Redis::setex("is_seild",60*60*24,$resInfo);
        }
        // dd($resInfo);
        // die;
        $resInfo = unserialize($resInfo);
        // dd($resInfo);
        //顶级分类
        $cateInfo = Category::where("pid",0)->take(4)->get();
        // dd($resInfo);
        //热销
        $sellInfo = Goods::where("is_sell",1)->orderBy("goods_id","desc")->take(8)->get();
        //促销
        $saleInfo = Goods::where("is_sale",1)->orderBy("goods_id","desc")->take(3)->get();
        return view("index.index",["resInfo"=>$resInfo,"cateInfo"=>$cateInfo,"sellInfo"=>$sellInfo,"saleInfo"=>$saleInfo]);
            // echo "123";
        
    }
    //新品列表展示
    public function prolist(){
        //新品列表展示
        $newInfo = Goods::where("is_new",1)->orderBy("goods_id","desc")->get();
        // dd($newInfo);
        return view("index.prolist",["newInfo"=>$newInfo]);
    }
    
}
