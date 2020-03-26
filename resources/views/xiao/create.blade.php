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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">导购添加</h1>
<a href="{{url('/xiao/index')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">展示</a>
<div style="margin-top:110px;">
<form class="form-horizontal" action="{{url('/xiao/store')}}" method="post" enctype="multipart/form-data" role="form" style="width:97%;">
@csrf
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">小区名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="x_name" 
				   placeholder="请输入小区名称">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">导购人</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname"  name="x_man"
				   placeholder="请输入导购人">
		</div>
	</div>
    <div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">导购联系方式</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname"  name="x_tel"
				   placeholder="请输入导购联系方式">
		</div>
	</div>
    <div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">房屋面积</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname"  name="x_mian"
				   placeholder="请输入房屋面积">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">房屋图片</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" name="x_img">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">房屋相册</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" multiple="multiple" id="firstname" name="x_imgs[]">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">售价</label>
		<div class="col-sm-10">
            <input type="text" class="form-control" id="firstname"  name="x_price" placeholder="请输入售价"></div>
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