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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">商品修改</h1>
<a href="{{url('/goods/index')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">展示</a>
<div style="margin-top:110px;">
<form class="form-horizontal" action="{{url('/goods/update/'.$goodsInfo->goods_id)}}" method="post" enctype="multipart/form-data" role="form" style="width:97%;">
@csrf
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="goods_name" value="{{$goodsInfo->goods_name}}" 
				   placeholder="请输入商品名称">
        <b style="color:#e63f00">{{$errors->first("goods_name")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="goods_ltem"  value="{{$goodsInfo->goods_ltem}}" 
				   placeholder="请输入商品货号">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-10">
			<select name="cate_id" id="">
                <option value="">--请选择--</option>
                @foreach ($cateInfo as $v)
                <option value="{{$v->cate_id}}"{{$v->cate_id==$goodsInfo->cate_id ? "selected" : ""}}>{{str_repeat("|——",$v->level)}}{{$v->cate_name}}</option>
                @endforeach
            </select>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-10">
			<select name="brand_id" id="">
                <option value="">--请选择--</option>
                @foreach ($brandInfo as $v)
                <option value="{{$v->brand_id}}"{{$v->brand_id==$goodsInfo->brand_id ? "selected" : ""}}>{{$v->brand_name}}</option>
                @endforeach
            </select>
            <b style="color:#e63f00">{{$errors->first("brand_name")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="goods_price"  value="{{$goodsInfo->goods_price}}"
				   placeholder="请输入商品价格">
            <b style="color:#e63f00">{{$errors->first("goods_price")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="goods_num"  value="{{$goodsInfo->goods_num}}"
				   placeholder="请输入商品库存">
            <b style="color:#e63f00">{{$errors->first("goods_num")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="is_show" value="1" {{$goodsInfo->is_show=='1' ? "checked" : ""}}>是
			<input type="radio" name="is_show" value="2" {{$goodsInfo->is_show=='2' ? "checked" : ""}}>否
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_new" value="1"  {{$goodsInfo->is_new=='1' ? "checked" : ""}}>是
			<input type="radio" name="is_new" value="2" {{$goodsInfo->is_new=='2' ? "checked" : ""}}>否
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_best" value="1"  {{$goodsInfo->is_best=='1' ? "checked" : ""}}>是
			<input type="radio" name="is_best" value="2" {{$goodsInfo->is_best=='2' ? "checked" : ""}}>否
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品主图</label>
		<div class="col-sm-10">
            @if($goodsInfo->goods_img)<img src="{{env('UPLOADS_URL')}}{{$goodsInfo->goods_img}}" width="35px" alt="">@endif
			<input type="file" class="form-control" id="firstname" name="goods_img" >
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
        @if($goodsInfo->goods_imgs)
			@php $goods_imgs = explode("|",$goodsInfo["goods_imgs"]); @endphp
				@foreach($goods_imgs as $vv)
					<img src="{{env('UPLOADS_URL')}}{{$vv}}" width="35px" alt="">
			    @endforeach
		@endif
			<input type="file" class="form-control" id="firstname" multiple="multiple" name="goods_imgs[]" >
		</div>
	</div>
    <div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">商品描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="lastname" name="goods_desc" placeholder="请输入商品描述">{{$goodsInfo->goods_desc}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>
</div>

</body>
</html>