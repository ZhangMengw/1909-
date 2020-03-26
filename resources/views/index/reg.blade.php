@extends('layouts.shop')
@section('title', '首页')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     @if(session('msg'))
          <div class="alert alert-danger">{{session("msg")}}</div>
     @endif
     <form action="{{url('/reg/regdo')}}" method="post" class="reg-login">
     @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('/log')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="user_name" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="user_code" placeholder="输入短信验证码" /> <button type="button">获取验证码</button></div>
       <div class="lrList"><input type="password" name="user_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" name="user_pwds" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     @include('index.public.footer');
     <script>
          $(function(){
               $(document).on("click","button",function(){
                    var name = $("input[name='user_name']").val();
                    // alert(name);
                    if(name==""){
                         alert("请输入手机号或者邮箱");
                         return;
                    }
                   
                    var ags = /^1[3|5|6|7|8|9]\d{9}$/;
                    if(ags.test(name)){
                         //发送手机验证码
                         $.get(
                              "/reg/sendSMS",
                              {name:name},
                              function(res){
                                   // alert(res);
                                   if(res.code==00001){
                                        alert(res.msg);
                                   }else{
                                        alert(res.msg);
                                   }
                              },"json"
                         )
                         return false;
                    }
                    var seg = /^[a-z0-9]{5,15}@[a-z0-9]{2,4}\.com$/i;
                    if(seg.test(name)){
                         //发送邮箱验证码
                         $.get(
                              "/reg/sendEmail",
                              {name:name},
                              function(res){
                                   // alert(res);
                                   if(res.code==00001){
                                        alert(res.msg);
                                   }else{
                                        alert(res.msg);
                                   }
                              },"json"
                         )
                         return false;
                    }
                    alert("请输入正确的手机号或者邮箱");
                    return false;
                    $("button").text("60s");
                    _h = setInterval(timename, 1000);

                    
               })
               function timename() {
                    var second = $("button").text();
                    second = parseInt(second);
                    if (second <= 0) {
                         $("button").text("获取");
                         clearInterval(_h);
                         $("button").css("pointer-events", "auto");
                    } else {
                         second = second - 1;
                         $("button").text(second + "s");
                         $("button").css("pointer-events", "none");
                    }
               }
          })
     </script>
     @endsection