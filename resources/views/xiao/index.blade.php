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
<a href="{{url('/xiao/create')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">添加</a>
<div class="table-responsive" style="margin-top:110px;">
	<table class="table">
		<thead>
			<tr>
				<th style="padding-left:20px;">销售id</th>
				<th>小区名称</th>
				<th>销售人</th>
				<th>销售方式</th>
				<th>房屋面积</th>
				<th>房屋图片</th>
				<th>房屋相册</th>
				<th>售价</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($xiaoInfo as $v)
			<tr>
				<th style="padding-left:20px;">{{$v->x_id}}</th>
				<th>{{$v->x_name}}</th>
				<th>{{$v->x_man}}</th>
				<th>{{$v->x_tel}}</th>
				<th>{{$v->x_mian}}</th>
				<th>@if($v->x_img)<img src="{{env('UPLOADS_URL')}}{{$v->x_img}}" width="35px" alt="">@endif</th>
				<th>@if($v->x_imgs)
                    <!-- 将转换后的字符串分割为数组 -->
                    @php $x_imgs=explode("|",$v->x_imgs); @endphp
                    <!-- 将得到的数组循环 -->
                    @foreach ($x_imgs as $vv)
                    <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="35px" alt="">
                    @endforeach
                @endif</th>
				<th>{{$v->x_price}}</th>
				<th>
                <a href="{{url('/xiao/edit/'.$v->x_id)}}" class="btn btn-info">编辑</a>
                <a href="{{url('/xiao/destroy/'.$v->x_id)}}" class="btn btn-danger">删除</a>
                </th>
			</tr>
        @endforeach
		<tr><td colspan="6">{{$xiaoInfo->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>