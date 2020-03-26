<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bootstrap 实例 - 响应式表格</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">图书信息展示</h1>
<a href="{{url('/book/create')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">添加</a>
<div class="table-responsive" style="margin-top:110px;">
	<form action="{{url('/book/index')}}">
		<input type="text" name="name" value="{{$name??''}}" placeholder="请输入图书名称">
		<input type="submit" value="搜索">
	</form>
	<table class="table">
		<thead>
			<tr>
				<th style="padding-left:20px;">图书id</th>
				<th>图书名称</th>
				<th>图书作者</th>
				<th>图书价格</th>
				<th>图书封面</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($book as $v)
			<tr>
				<th style="padding-left:20px;">{{$v->book_id}}</th>
				<th>{{$v->book_name}}</th>
				<th>{{$v->book_man}}</th>
				<th>{{$v->book_price}}</th>
				<th>@if($v->book_img)<img src="{{env('UPLOADS_URL')}}{{$v->book_img}}" width="35px" alt="">@endif</th>
				<th>
                <a href="{{url('/book/edit/'.$v->book_id)}}" class="btn btn-info">编辑</a>
                <a href="{{url('/book/destroy/'.$v->book_id)}}" class="btn btn-danger">删除</a>
                </th>
			</tr>
        @endforeach
		<tr><td colspan="6">{{$book->appends(["name"=>$name])->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>