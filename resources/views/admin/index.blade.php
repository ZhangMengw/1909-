<!-- 导航 -->
@include('public\bar')
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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">管理员展示</h1>
<a href="{{url('/admin/create')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">添加</a>
<div class="table-responsive" style="margin-top:110px;">
	<form action="{{url('/admin/index')}}">
		<input type="text" name="name" value="{{$name??''}}" placeholder="请输入管理员名称">
		<input type="submit" value="搜索">
	</form>
	<table class="table">
		<thead>
			<tr>
				<th style="padding-left:20px;">管理员id</th>
				<th>管理员名称</th>
				<th>管理员邮箱</th>
				<th>管理员手机号</th>
				<th>管理员头像</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($admin as $v)
			<tr>
				<th style="padding-left:20px;">{{$v->admin_id}}</th>
				<th>{{$v->admin_name}}</th>
				<th>{{$v->admin_email}}</th>
				<th>{{$v->admin_tel}}</th>
				<th>@if($v->admin_img)<img src="{{env('UPLOADS_URL')}}{{$v->admin_img}}" width="35px" alt="">@endif</th>
				<th>
                <a href="{{url('/admin/edit/'.$v->admin_id)}}" class="btn btn-info">编辑</a>
                <!-- <a href="{{url('/admin/destroy/'.$v->admin_id)}}" class="btn btn-danger">删除</a> -->
                <a href="javascript:void(0)" class="btn btn-danger del" admin_id="{{$v->admin_id}}">删除</a>
                </th>
			</tr>
        @endforeach
		<tr><td colspan="6">{{$admin->appends(["name"=>$name])->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>
<script src="/static/jquery.js"></script>
<script>
$(function(){
	$(document).on("click",".del",function(){
		var _value = $(this).attr("admin_id");
		// alert(_value);
		if(confirm("是否确认删除？")){
			$.get(
				"/admin/destroy/"+_value,
				function(res){
					// alert(res);
					if(res.code==00000){
							location.reload();
							// alert("已删除");
						}else{
							alert("删除失败");
						}
				},"json"
			)
		}
	})
})
</script>