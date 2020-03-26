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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">商品添加</h1>
<a href="{{url('/brand/index')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">展示</a>
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

<form class="form-horizontal" action="{{url('/brand/store')}}" method="post" enctype="multipart/form-data" role="form" style="width:97%;">
@csrf
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="brand_name" name="brand_name" 
				   placeholder="请输入商品名称">
			<b style="color:#e63f00;">{{$errors->first("brand_name")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="brand_url"  name="brand_url"
				   placeholder="请输入商品网址">
			<b style="color:#e63f00;">{{$errors->first("brand_url")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品logo</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" name="brand_logo">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品logo相册</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" multiple="multiple" name="brand_logos[]">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">商品描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="brand_desc" name="brand_desc"placeholder="请输入商品描述"></textarea>
			<b style="color:#e63f00;"></b>
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
$(function(){
	//验证商品名称
	$(document).on("blur","#brand_name",function(){
		var _value = $(this).val();
		// alert(_value);
		if(_value==""){
			$(this).next().text("商品名称不能为空");
		}else if(_value.length>20){
			$(this).next().text("商品名称不能超过20位");
		}else{
			$.get(
				"/brand/ajaxName",
				{_value:_value},
				function(res){
					// alert(res);
					if(res=="no"){
						$("#brand_name").next().text("该品牌名称已存在");
					}else{
						$("#brand_name").next().html("<font color='green'>√</font>");
					}
				}
			)
		}
		// return false;
	})
	//验证商品网址
	$(document).on("blur","#brand_url",function(){
		var _value = $(this).val();
		if(_value==""){
			$(this).next().text("品牌网址不能为空");
		}else{
			$(this).next().html("<font color='green'>√</font>");
		}
	})
	//验证商品描述
	$(document).on("blur","#brand_desc",function(){
		var _value = $(this).val();
		if(_value==""){
			$(this).next().text("品牌描述不能为空");
		}else{
			$(this).next().html("<font color='green'>√</font>");
		}
	})
	//商品阻止提交
	$(document).on("click","button",function(){
		//阻止商品名称
		var nameflag = true;
		var _value = $("#brand_name").val();
		// alert(_value);
		if(_value==""){
			// alert("123");
			$("#brand_name").next().text("商品名称不能为空");
			return false;
		}else if(_value.length>20){
			$("#brand_name").next().text("商品名称不能超过20位");
			return false;
		}else{
			$.ajax({
				url:"/brand/ajaxName",
				type:"get",
				data:{_value:_value},
				async:false,
				success:function(res){
					// alert(res);
					if(res=="no"){
						$("#brand_name").next().text("该品牌名称已存在");
						nameflag = false;
					}
				}
			})
			if(!nameflag){
				return false;
			}
		}
		//阻止商品网址
		var _value = $("#brand_url").val();
		if(_value==""){
			$("#brand_url").next().text("品牌网址不能为空");
			return false;
		}else{
			$("brand_url").next().html("<font color='green'>√</font>");
			return false;
		}
		//阻止商品描述
		var _value = $("#brand_desc").val();
		if(_value==""){
			$("#brand_desc").next().text("品牌描述不能为空");
			return false;
		}else{
			$("#brand_desc").next().html("<font color='green'>√</font>");
			return false;
		}
	})
})
</script>