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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">图书信息添加</h1>
<a href="{{url('/book/index')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">展示</a>
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

<form class="form-horizontal" action="{{url('/book/store')}}" method="post" enctype="multipart/form-data" role="form" style="width:97%;">
@csrf
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">图书名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="book_name" 
				   placeholder="请输入图书名称">
			<b style="color:#e63f00;">{{$errors->first("book_name")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">图书作者</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname"  name="book_man"
				   placeholder="请输入图书作者">
			<b style="color:#e63f00;">{{$errors->first("book_man")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">图书售价</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname"  name="book_price"
				   placeholder="请输入图书售价">
			<b style="color:#e63f00;">{{$errors->first("book_price")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">图书封面</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" name="book_img">
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