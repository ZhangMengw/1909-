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
<a href="{{url('/goods/create')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">添加</a>
<div class="table-responsive" style="margin-top:110px;">
	<form action="{{url('/goods/index')}}">
		<input type="text" name="name" value="{{$name??''}}" placeholder="请输入商品名称">
		<input type="submit" value="搜索">
	</form>
	<table class="table">
		<thead>
			<tr>
				<th style="padding-left:20px;">商品id</th>
				<th>商品名称</th>
				<th>商品货号</th>
				<th>商品分类</th>
				<th>商品品牌</th>
				<th>商品价格</th>
				<th>商品库存</th>
				<th>是否显示</th>
				<th>是否新品</th>
				<th>是否精品</th>
				<th>商品主图</th>
				<th>商品相册</th>
				<th>商品详情</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($goods as $v)
			<tr>
				<th style="padding-left:20px;">{{$v->goods_id}}</th>
				<th>{{$v->goods_name}}</th>
				<th>{{$v->goods_ltem}}</th>
				<th>{{$v->cate_name}}</th>
				<th>{{$v->brand_name}}</th>
				<th>{{$v->goods_price}}</th>
				<th>{{$v->goods_num}}</th>
				<th>{{$v->is_show=='1' ? "√" : "×"}}</th>
				<th>{{$v->is_new=='1' ? "√" : "×"}}</th>
				<th>{{$v->is_best=='1' ? "√" : "×"}}</th>
				<th>{{$v->is_res=='1' ? "√" : "×"}}</th>
				<th>{{$v->is_sell=='1' ? "√" : "×"}}</th>
				<th>{{$v->is_sale=='1' ? "√" : "×"}}</th>
				<th>@if($v->goods_img)<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="35px" alt="">@endif</th>
				<th>@if($v->goods_imgs)
					@php $goods_imgs = explode("|",$v["goods_imgs"]); @endphp
					@foreach($goods_imgs as $vv)
					<img src="{{env('UPLOADS_URL')}}{{$vv}}" width="35px" alt="">
					@endforeach
				@endif</th>
				<th>{{$v->goods_desc}}</th>
				<th>
                <a href="{{url('/proInfo/'.$v->goods_id)}}" class="btn btn-info">预览</a>
                <a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-info">编辑</a>
				<!-- <a href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a> -->
                <a href="javascript:void(0)" class="btn btn-danger del" goods_id="{{$v->goods_id}}">删除</a>
                </th>
			</tr>
        @endforeach
		<tr><td colspan="13">{{$goods->appends(["name"=>$name])->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>
<script src="/static/jquery.js"></script>
<script>
$(function(){
	$(document).on("click",".del",function(){
		// alert("123");
		var _gid = $(this).attr("goods_id");
		if(confirm("是否确认要删除？")){
			$.get(
				"/goods/destroy/"+_gid,
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