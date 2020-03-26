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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">分类展示</h1>
<a href="{{url('/category/create')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">添加</a>
<div class="table-responsive" style="margin-top:110px;">
	<table class="table">
		<thead>
			<tr>
				<th style="padding-left:20px;">分类id</th>
				<th>分类名称</th>
				<th>是否在导航栏显示</th>
				<th>分类描述</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($cateInfo as $v)
			<tr>
				<th style="padding-left:20px;">{{$v->cate_id}}</th>
				<th>{{str_repeat("|——",$v->level)}}{{$v->cate_name}}</th>
				<th>{{$v->cate_nav=='1' ? "√" : "×"}}</th>
				<th>{{$v->cate_desc}}</th>
				<th>
                <a href="{{url('/category/edit/'.$v->cate_id)}}" class="btn btn-info">编辑</a>
                <!-- <a href="{{url('/category/destroy/'.$v->cate_id)}}" class="btn btn-danger">删除</a> -->
                <a href="javascript:void(0)" class="btn btn-danger del" cate_id="{{$v->cate_id}}">删除</a>
                </th>
			</tr>
        @endforeach
		</tbody>
</table>
</div>  	

</body>
</html>
<script src="/static/jquery.js"></script>
<script>
$(function(){
	$(document).on("click",".del",function(){
		var _cid = $(this).attr("cate_id");
		if(confirm("是否确认要删除？")){
			$.get(
				"/category/destroy/"+_cid,
				function(res){
					// alert(res);
					if(res.code==00000){
						location.reload();
					}else{
						alert("删除失败");
					}
				},"json"
			)
		}
	})
})
</script>