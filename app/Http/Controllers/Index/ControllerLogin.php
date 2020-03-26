<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;
use Validator;

//短信验证
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

//邮箱验证
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;

class ControllerLogin extends Controller
{
    public function log(){
        return view("index.login");
    }
    public function logdo(){
        $arr = request()->except("_token");
        // dd($arr);
        $res = Login::where("user_name",$arr["user_name"])->first();
        // dd($res);
        if(decrypt($res->user_pwd) != $arr["user_pwd"]){
            return redirect("/log")->with('msg','用户名或者密码错误！');
        }
        session(["adminuser"=>$res]);
        if($arr["refer"]){
            return redirect($arr["refer"]);
        }else{
            return redirect("/");
        }
    }
    public function reg(){
        return view("index.reg");
    }
    //发送手机验证码
    public function sendSMS(){
        $name = request()->name;
        // dd($name);
        $ags = "/^1[3|5|6|7|8|9]\d{9}$/";
        
        if(!preg_match($ags,$name)){
            return json_encode(["code"=>"00001","msg"=>"请输入正确的手机号"]);
        }else{
            $resname = Login::where("user_name",$name)->count();
            if($resname>0){
                return json_encode(["code"=>"00001","msg"=>"手机号已存在"]);
            }
        }
        //随机验证码
        $code = rand(100000,999999);
        $res = $this->send($name,$code);
        if($res["Message"]=="OK"){
            $nameInfo = ["send_name"=>$name,"send_code"=>$code,"send_time"=>time()];
            session(["nameInfo"=>$nameInfo]);
            return json_encode(["code"=>"00000","msg"=>"发送成功！"]);
        }
        return json_encode(["code"=>"00000","msg"=>$res["Messags"]]);
    }
    //手机验证码
    public function send($name,$code){
        

        // Download：https://github.com/aliyun/openapi-sdk-php
        // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

        AlibabaCloud::accessKeyClient('LTAI4Fhpz5biVzk7iJmkd8RC', 'h45qQpXawB68a2aPzntyVBBaQIrWFV')
                                ->regionId('cn-hangzhou')
                                ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                ->product('Dysmsapi')
                                // ->scheme('https') // https | http
                                ->version('2017-05-25')
                                ->action('SendSms')
                                ->method('POST')
                                ->host('dysmsapi.aliyuncs.com')
                                ->options([
                                                'query' => [
                                                'RegionId' => "cn-hangzhou",
                                                'PhoneNumbers' => $name,
                                                'SignName' => "云霄之上",
                                                'TemplateCode' => "SMS_183261712",
                                                'TemplateParam' => "{code:$code}",
                                                ],
                                            ])
                                ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }

    }
    //ajax验证邮箱
    public function sendEmail(){
        $name = request()->name;
        // dd($name);
        $ags = "/^[a-z0-9]{5,15}@[a-z0-9]{2,4}\.com$/i";
        
        if(!preg_match($ags,$name)){
            return json_encode(["code"=>"00001","msg"=>"请输入正确的邮箱号"]);
        }else{
            $resname = Login::where("user_name",$name)->count();
            if($resname>0){
                return json_encode(["code"=>"00001","msg"=>"邮箱号已存在"]);
            }
        }
        $code = rand(100000,999999);
        Mail::to($name)->send(new SendCode($code));
        $emailInfo = ["send_name"=>$name,"send_code"=>$code,"send_time"=>time()];
        session(["emailInfo"=>$emailInfo]);
        return json_encode(["code"=>"00000","msg"=>"发送成功！"]);
    }
    //注册手机号
    public function regdo(){
        $arr = request()->except("_token");

        //手机号
        $ags = "/^1[3|5|6|7|8|9]\d{9}$/";
        if(preg_match($ags,$arr["user_name"])){
            $nameInfo = session('nameInfo');
            // dd($nameInfo);
            //判断账号是否为空是否存在
            if(empty($arr["user_name"])){
                return redirect("/reg")->with("msg","账号不能为空");
            }
            //判断账号是否一直
            if($arr["user_name"]!=$nameInfo["send_name"]){
                return redirect("/reg")->with("msg","发送验证码手机号跟当前手机号不一致");
            }else{
                $resname = Login::where("user_name",$arr["user_name"])->count();
                if($resname>0){
                    return redirect("/reg")->with("msg","手机号已存在");
                }
            }
            //验证验证码是否为空
            if(empty($arr["user_code"])){
                return redirect("/reg")->with("msg","验证码不能为空");
            }else if($arr["user_code"]!=$nameInfo["send_code"]){
                return redirect("/reg")->with("msg","发送验证码跟当前验证码不一致");
            }else if((time()-$nameInfo['send_time'])>300){
                return redirect("/reg")->with("msg","验证码已过期");
            }
        }
        //邮箱
        $seg = "/^[a-z0-9]{5,15}@[a-z0-9]{2,4}\.com$/i";
        if(preg_match($seg,$arr["user_name"])){
            $emailInfo = session('emailInfo');
            // dd($emailInfo);
            //判断账号是否为空是否存在
            if(empty($arr["user_name"])){
                return redirect("/reg")->with("msg","账号不能为空");
            }
            //判断账号是否一直
            if($arr["user_name"]!=$emailInfo["send_name"]){
                return redirect("/reg")->with("msg","发送验证码手机号跟当前手机号不一致");
            }else{
                $resname = Login::where("user_name",$arr["user_name"])->count();
                if($resname>0){
                    return redirect("/reg")->with("msg","手机号已存在");
                }
            }
            //验证验证码是否为空
            if(empty($arr["user_code"])){
                return redirect("/reg")->with("msg","验证码不能为空");
            }else if($arr["user_code"]!=$emailInfo["send_code"]){
                return redirect("/reg")->with("msg","发送验证码跟当前验证码不一致");
            }else if((time()-$emailInfo['send_time'])>300){
                return redirect("/reg")->with("msg","验证码已过期");
            }
        }

        //验证密码
        $ags = "/^\w{6,18}$/";
        if(empty($arr["user_pwd"])){
            return redirect("/reg")->with("msg","密码不能为空");
        }else if(!preg_match($ags,$arr["user_pwd"])){
            return redirect("/reg")->with("msg","密码必须由6-18位以上数字，字母，下划线组成");
        }
        if($arr["user_pwd"]!=$arr["user_pwds"]){
            return redirect("/reg")->with("msg","密码跟确认密码不一致");
        }
        $arr["user_pwd"] = encrypt($arr["user_pwd"]);
        $arr["user_pwds"] = encrypt($arr["user_pwds"]);
        //成功
        $arr["user_time"] = time();
        $res = Login::create($arr);
        if($res){
            return redirect("/log");
        }
        

    }
    public function quie(){
        $res = session(["adminuser"=>null]);
        // dd($res);
        if($res==null){
            return redirect("/log");
        }
    }
}
