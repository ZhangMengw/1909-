<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Area;
use App\Address;

class ControllerAddress extends Controller
{
    //确认结算
    public function pay($id){
        // echo $id;
        $id = explode(",",$id);
        // dd($id);
        $name = session("adminuser");
        $user_id = $name->user_id;
        $where = [
            ["user_id","=",$user_id],
            ["goods_del","=",1]
        ];
        $payInfo = Cart::join("goods","cart.goods_id","=","goods.goods_id")
                    ->where($where)
                    ->whereIn("goods.goods_id",$id)
                    ->get();
        // dd($payInfo);

        //根据商品id 用户id 是否删除 定义where条件
        $where = [
            "user_id"=>$user_id,
            "goods_del"=>1
        ];
        // dd($where);
        // dd($goods_id);
        //查询goods表中的价格 跟购物车表中的购买数量 根据条件 和连表查询
        $info = Cart::where($where)
                    ->whereIn("goods_id",$id)
                    ->get(["goods_price","buy_number"])
                    ->toArray();
        // dd($info);
        //收货地址
        $where = [
            ["user_id","=",$user_id],
            ["is_del","=",1],
            ["is_default","=",1]
        ];
        $addressInfo = Address::where($where)->get();
        // dd($addressInfo);
        foreach($addressInfo as $k=>$v){
            //根据下表中 所指示的 等于设置的 城市表中根据条件 城市表中的id 等于收货地址表中的数据 查找值为name的
            $addressInfo[$k]->country = Area::where("id",$v->country)->value("name");
            $addressInfo[$k]->province = Area::where("id",$v->province)->value("name");
            $addressInfo[$k]->area = Area::where("id",$v->area)->value("name");
        }
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
        return view("index.pay",["payInfo"=>$payInfo,"money"=>$money,"addressInfo"=>$addressInfo]);
    }

    

    //展示收货地址
    public function add_address(){
        $user_id = session("adminuser")->user_id;
        // dd($user_id);
        $where = [
            ["user_id","=",$user_id],
            ["is_del","=",1]
        ];
        $addressInfo = Address::where($where)->get();
        // dd($addressInfo);
        foreach($addressInfo as $k=>$v){
            //根据下表中 所指示的 等于设置的 城市表中根据条件 城市表中的id 等于收货地址表中的数据 查找值为name的
            $addressInfo[$k]->country = Area::where("id",$v->country)->value("name");
            $addressInfo[$k]->province = Area::where("id",$v->province)->value("name");
            $addressInfo[$k]->area = Area::where("id",$v->area)->value("name");
        }
        // dd($addressInfo);
        return view("index.add_address",["addressInfo"=>$addressInfo]);
    }
    //收货地址
    public function address(){
        $area = Area::where(["pid"=>0])->get();
        // dd($area);
        // var_dump($area);die;
        $areaInfo = $this->getAddress(0);
        // dd($areaInfo);
        return view("index.address",["areaInfo"=>$areaInfo]);
    }
    public function getAddress($pid){
        $pid = explode(",",$pid);
        $res = Area::whereIn("pid",$pid)->get();
        // dd($res);
        return $res;
    }
    //Ajax内容改变事件
    public function getCity(){
        $id = request()->get("id");
        // dd($id);
        $cityInfo = $this->getaddress($id);
        // dd($cityInfo);
        echo json_encode($cityInfo);
    }
    public function addressDo(){
        $arr = request()->except("_token");
        // dd($arr);
        $ags = "/^1[358]\d{9}$/";
        if(empty($arr["country"])){
            return redirect("/cart/address")->with("msg","省市不能为空");
        }else if(empty($arr["province"])){
            return redirect("/cart/address")->with("msg","市区不能为空");
        }else if(empty($arr["area"])){
            return redirect("/cart/address")->with("msg","县城不能为空");
        }else if(empty($arr["address_name"])){
            return redirect("/cart/address")->with("msg","收货人不能为空");
        }else if(empty($arr["address_tel"])){
            return redirect("/cart/address")->with("msg","手机号不能为空");
        }else if(!preg_match($ags,$arr["address_tel"])){
            return redirect("/cart/address")->with("msg","手机号格式不正确");
        }else if(empty($arr["address_datail"])){
            return redirect("/cart/address")->with("msg","详细地址不能为空");
        }
        $name = session("adminuser");
        $user_id = $name->user_id;
        $arr["user_id"] = $name->user_id;
        $arr["is_default"] = "1";
        // dd($user_id);
        // dd($arr);
        if(!empty($arr["is_default"])){
            //根据 用户id 是否删除 写where条件
            $where = [
                ["user_id","=",$user_id],
                ["is_del","=",1]
            ];
            //加上where条件将数据库中的迷人改为2
            Address::where($where)->update(["is_default"=>2]);
        }
        $res = Address::create($arr);
        if($res){
            return redirect("/cart/add_address");
        }

    }
}
