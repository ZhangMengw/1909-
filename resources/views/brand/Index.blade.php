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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">商品展示</h1>
<a href="{{url('/brand/create')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">添加</a>
<div class="table-responsive" style="margin-top:110px;">
	<form action="{{url('/brand/index')}}">
		<input type="text" name="name" value="{{$name??''}}" placeholder="请输入商品名称">
		<input type="text" name="url" value="{{$url??''}}" placeholder="请输入商品网址">
		<input type="submit" value="搜索">
	</form>
	<table class="table">
		<thead>
			<tr>
				<th style="padding-left:20px;">商品id</th>
				<th>商品名称</th>
				<th>商品网址</th>
				<th>商品logo</th>
				<th>商品描述</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($brand as $v)
			<tr>
				<th style="padding-left:20px;">{{$v->brand_id}}</th>
				<th>{{$v->brand_name}}</th>
				<th>{{$v->brand_url}}</th>
				<th>@if($v->brand_logo)<img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" width="35px" alt="">@endif</th>
				<th>@if($v->brand_logo)
					@php $brand_logos = explode("|",$v["brand_logos"]); @endphp
					@foreach($brand_logos as $vv)
					<img src="{{env('UPLOADS_URL')}}{{$vv}}" width="35px" alt="">
					@endforeach
				@endif</th>
				<th>{{$v->brand_desc}}</th>
				<th>
                <a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-info">编辑</a>
                <!-- <a href="{{url('/brand/destroy/'.$v->brand_id)}}" class="btn btn-danger">删除</a> -->
                <a href="javascript:void(0)" class="btn btn-danger del" brand_id="{{$v->brand_id}}">删除</a>
                </th>
			</tr>
        @endforeach
		<tr><td colspan="6">{{$brand->appends(["name"=>$name,"url"=>$url])->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>
<script src="/static/jquery.js"></script>
<script>
$(function(){
	$(document).on("click",".del",function(){
		var bid = $(this).attr("brand_id");
		if(confirm("是否确认要删除?")){
			$.get(
				"/brand/destroy/"+bid,
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