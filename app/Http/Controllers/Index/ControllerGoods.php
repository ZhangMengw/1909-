<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ControllerGoods extends Controller
{
    //商品详情页
    public function proInfo($id){
        // Cache::flush();
        $proInfo = Cache::get("goods_id");
        // dd($proInfo);
        if(!$proInfo){
            // echo "D====";
            $proInfo = Goods::where("goods_id",$id)->first();
            Cache::put("goods_id",$proInfo,60*60*24);
        }else{
            // echo "DB====";
        }
        // dd($proInfo);
        // $proress = Cache::increment('goods');
        // $proress = Cache::add("count_".$id,1) ? Cache::get("count_".$id) : Cache::increment("count_".$id);
        $proress = Redis::setnx("count_".$id,1) ? Redis::get("count_".$id) : Redis::incr("count_".$id);
        // dd($proress);
        return view("index.proInfo",["proInfo"=>$proInfo,"proress"=>$proress]);
    }
    //加入购物车
    public function cart(){
        $buy_number = request()->get("buy_number");
        $goods_id = request()->get("goods_id");
        // dd($buy_number);
        // dd($goods_id);
        $name = session("adminuser");
        // dd($name);
        // $user_id = $name->user_id;

        if($name==""){
            return json_encode(["code"=>"00003","msg"=>"请先登录"]);
        }
        //检测库存
        $goods = Goods::where("goods_id",$goods_id)->first();
        // dd($goods);
        if($goods->goods_num<$buy_number){
            return json_encode(["code"=>"0004","msg"=>"库存不足"]);
        }
        $where = [
            ["goods_id","=",$goods_id],
            ["goods_del","=",1],
            ["user_id","=",$name->user_id]
        ];
        $cart = Cart::where($where)->first();
        // dd($cart);
        if($cart){
            $buy_number = $cart->buy_number+$buy_number;
            // dd($buy_number);
            if($goods->goods_num<$buy_number){
                $buy_number = $goods->goods_num;
            }
            // dd($buy_number);
            $res = Cart::where("cart_id",$cart->cart_id)->update(["buy_number"=>$buy_number]);
            
        }else{
            $arr=[
                "user_id"=>$name->user_id,
                "goods_id"=>$goods->goods_id,
                "goods_name"=>$goods->goods_name,
                "goods_price"=>$goods->goods_price,
                "add_time"=>time(),
                "buy_number"=>$buy_number,
                "goods_del"=>1,
            ];
            // dd($arr);
            //添加
            $res = Cart::create($arr);
        }
        // dd($res);
        if($res){
            return json_encode(["code"=>"00000","msg"=>"加入购物车成功"]);
        }
    }
    //加入购物车页面
    public function addcart(){
        $name = session("adminuser");
        $cart = Cart::join("goods","cart.goods_id","=","goods.goods_id")->where("user_id",$name->user_id)->get();
        // dd($cart);
        $buy_number = array_column($cart->toArray(),"buy_number");
        $cart_id = array_column($cart->toArray(),"cart_id");
        
        // $buy_num = $cart->goods_price*$cart->buy_number;
        // dd($buy_num);
        return view("index/addcart",["cart"=>$cart,"buy_number"=>$buy_number,"cart_id"=>$cart_id]);
    }
    //修改购买数量
    public function changeNumber(){
        $goods_id = request()->goods_id;
        $buy_number = request()->buy_number;
        // dd($goods_id);
        // dd($buy_number);
        $name = session("adminuser");
        $user_id = $name->user_id;
        // dd($user_id);
        // $goods = Goods::where("goods_id",$goods_id)->value("goods_num");
        // dd($goods);
        // if(){}
        //写 商品id 用户id 是否删除 的where条件
        $where = [
            ["goods_id","=",$goods_id],
            ["user_id","=",$user_id],
            ["goods_del","=",1]
        ];
        //将根据where条件 修改的购物车表中的购买数量
        return $res = Cart::where($where)->update(["buy_number"=>$buy_number]);
    }
    //修改小计
    public function getTotal(){
        $goods_id = request()->goods_id;
        $name = session("adminuser");
        $user_id = $name->user_id;
        //根据商品id 用户id 是否删除 写where条件
        $where = [
            ["goods_id","=",$goods_id],
            ["user_id","=",$user_id],
            ["goods_del","=",1]
        ];
        //将查询出的购买数量返回
        $buy_number = Cart::where($where)->value("buy_number");
        //获取商品价格
        $goods_price = Goods::where("goods_id",$goods_id)->value("goods_price");
        //计算
        echo $goods_price*$buy_number;
    }
    //计算总价
    public function gatMoney(){
        $goods_id = request()->get("goods_id");
        // dd($goods_id);
        $goods_id = explode(",",$goods_id);
        // dd($goods_id);
        //获取用户id
        $name = session("adminuser");
        $user_id = $name->user_id;
        // dd($user_id);
        //根据商品id 用户id 是否删除 定义where条件
        $where = [
            "user_id"=>$user_id,
            "goods_del"=>1
        ];
        // dd($where);
        // dd($goods_id);
        //查询goods表中的价格 跟购物车表中的购买数量 根据条件 和连表查询
        $info = Cart::where($where)
                    ->whereIn("goods_id",$goods_id)
                    ->get(["goods_price","buy_number"])
                    ->toArray();
        // dd($info);
        // dd($goods_id);
        //定义一个为零的
        $money=0;
        //循环查询出的值
        foreach($info as $k=>$v){
            // dump($v);
            //将价格乘以购买数量 赋值给空值
            $money += $v["goods_price"]*$v["buy_number"];
            // dump($money);
        }
        
        // dd($money);
        return $money;
    }
    
}
