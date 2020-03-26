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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">学生列表展示</h1>
<a href="{{url('/student/create')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">添加</a>
<div class="table-responsive" style="margin-top:110px;">
	<table class="table">
		<thead>
			<tr>
				<th style="padding-left:20px;">商品id</th>
				<th>学生名称</th>
				<th>学生性别</th>
				<th>学生班级</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($info as $v)
			<tr>
				<th style="padding-left:20px;">{{$v->s_id}}</th>
				<th>{{$v->s_name}}</th>
				<th>{{$v->s_sex=='1' ? "男" : "女"}}</th>
				<th>{{$v->b_name}}</th>
				<th>
                <a href="{{url('/student/edit/'.$v->s_id)}}" class="btn btn-info">编辑</a>
                <a href="{{url('/student/destroy/'.$v->s_id)}}" class="btn btn-danger">删除</a>
                </th>
			</tr>
        @endforeach
		</tbody>
</table>
</div>  	

</body>
</html>