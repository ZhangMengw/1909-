<!-- 导航 -->
@include('public\bar')
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">管理员添加</h1>
<a href="{{url('/admin/index')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">展示</a>
<div style="margin-top:110px;">

<!-- @if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif -->

<form class="form-horizontal" action="{{url('/admin/store')}}" method="post" enctype="multipart/form-data" role="form" style="width:97%;">
@csrf
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="admin_name" name="admin_name" 
				   placeholder="请输入管理员名称">
			<b style="color:#e63f00;" id="b_name">{{$errors->first("admin_name")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="admin_pwd"  name="admin_pwd"
				   placeholder="请输入管理员密码">
			<b style="color:#e63f00;" id="b_pwd">{{$errors->first("admin_pwd")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">管理员邮箱</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="admin_email" name="admin_email" 
				   placeholder="请输入管理员邮箱">
			<b style="color:#e63f00;" id="b_email">{{$errors->first("admin_email")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">管理员手机号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="admin_tel"  name="admin_tel"
				   placeholder="请输入管理员手机号">
			<b style="color:#e63f00;" id="b_tel">{{$errors->first("admin_tel")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" name="admin_img">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
</div>

</body>
</html>
<script src="/static/jquery.js"></script>
<script>
	$(document).ready(function(){
		$(document).on("blur","#admin_name",function(){
			var ags = /^[\u4e00-\u9fa5,a-z0-9A-Z_——]{2,16}$/;
			var _this = $(this);
			// console.log(_this);
			var _value = _this.val();
			// console.log(_value);
			if(_value==""){
				$("#b_name").html("管理员名称不能为空");
			}else if(!ags.test(_value)){
				$("#b_name").html("管理员名称中文、字母、数字、下划线、破折号2-16位");
			}else{
				$.ajax({
                    url: "{{url('/admin/ajaxName')}}",
                    type: "get",
                    data: {
                        _value:_value 
                    },
                    success: function(res) {
                        console.log(res);
                        if (res == 'no') {
                            $("#b_name").html("<font color='red'>该用户名已存在</font>");
                        } else {
                            $("#b_name").html("<font color='green'>√</font>");
                        }
                    }
                })
			}
		})
		$(document).on("blur","#admin_pwd",function(){
			var ags = /^\w{6,}$/;
			var _this = $(this);
			// console.log(_this);
			var _value = _this.val();
			// console.log(_value);
			if(_value==""){
				$("#b_pwd").html("管理员密码不能为空");
			}else if(!ags.test(_value)){
				$("#b_pwd").html("管理员密码最稍6位");
			
			}else{
				$("#b_pwd").html("<font color='green'>√</font>");
			}
		})
		$(document).on("blur","#admin_email",function(){
			var ags = /^\w{5,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/;
			var _this = $(this);
			// console.log(_this);
			var _value = _this.val();
			// console.log(_value);
			if(_value==""){
				$("#b_email").html("管理员邮箱不能为空");
			}else if(!ags.test(_value)){
				$("#b_email").html("管理员邮箱格式不正确");
			
			}else{
				$("#b_email").html("<font color='green'>√</font>");
			}
		})
		$(document).on("blur","#admin_tel",function(){
			var ags = /^1[35789]\d{9}$/;
			var _this = $(this);
			// console.log(_this);
			var _value = _this.val();
			// console.log(_value);
			if(_value==""){
				$("#b_tel").html("管理员手机号不能为空");
			}else if(!ags.test(_value)){
				$("#b_tel").html("管理员手机号格式不正确");
			
			}else{
				$("#b_tel").html("<font color='green'>√</font>");
			}
		})
		$(document).on("click","button",function(){
			var nameflag = true;
			var ags = /^[\u4e00-\u9fa5,a-z0-9A-Z_——]{2,16}$/;
			var _this = $("input[name='admin_name']");
			// console.log(_this);
			var _value = _this.val();
			// console.log(_value);
			if(_value==""){
				$("#b_name").html("管理员名称不能为空");
				return false;
			}else if(!ags.test(_value)){
				$("#b_name").html("管理员名称中文、字母、数字、下划线、破折号2-16位");
				return false;
			}else{
				$.ajax({
                    url: "{{url('/admin/ajaxName')}}",
                    type: "get",
                    data: {
                        _value:_value 
                    },
					async:false,
                    success: function(res) {
                        console.log(res);
                        if (res == 'no') {
                            $("#b_name").html("<font color='red'>该用户名已存在</font>");
							nameflag = false;
                        }
                    }
                })
				if(!nameflag){
					return false;
				}
			}
			//密码阻止
			var ags = /^\w{6,}$/;
			var _this = $("input[name='admin_pwd']");
			// console.log(_this);
			var _value = _this.val();
			// console.log(_value);
			if(_value==""){
				$("#b_pwd").html("管理员密码不能为空");
				return false;
			}else if(!ags.test(_value)){
				$("#b_pwd").html("管理员密码最稍6位");
				return false;
			}
			//邮箱阻止
			var ags = /^\w{5,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/;
			var _this = $("input[name='admin_email']");
			// console.log(_this);
			var _value = _this.val();
			// console.log(_value);
			if(_value==""){
				$("#b_email").html("管理员邮箱不能为空");
				return false;
			}else if(!ags.test(_value)){
				$("#b_email").html("管理员邮箱格式不正确");
				return false;
			
			}
			//手机号阻止
			var ags = /^1[35789]\d{9}$/;
			var _this = $("input[name='admin_tel']");
			// console.log(_this);
			var _value = _this.val();
			// console.log(_value);
			if(_value==""){
				$("#b_tel").html("管理员手机号不能为空");
				return false;
			}else if(!ags.test(_value)){
				$("#b_tel").html("管理员手机号格式不正确");
				return false;
			
			}
		})
	})

</script>