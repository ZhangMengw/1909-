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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">商品添加</h1>
<a href="{{url('/goods/index')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">展示</a>
<div style="margin-top:110px;">
<form class="form-horizontal" action="{{url('/goods/store')}}" method="post" enctype="multipart/form-data" role="form" style="width:97%;">
@csrf
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="goods_name" name="goods_name" 
				   placeholder="请输入商品名称">
        <b style="color:#e63f00">{{$errors->first("goods_name")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="goods_ltem" 
				   placeholder="请输入商品货号">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-10">
			<select name="cate_id" id="">
                <option value="">--请选择--</option>
                @foreach ($cateInfo as $v)
                <option value="{{$v->cate_id}}">{{str_repeat("|——",$v->level)}}{{$v->cate_name}}</option>
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
                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                @endforeach
            </select>
            <b style="color:#e63f00">{{$errors->first("brand_name")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="goods_price" name="goods_price" 
				   placeholder="请输入商品价格">
            <b style="color:#e63f00">{{$errors->first("goods_price")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="goods_num" name="goods_num" 
				   placeholder="请输入商品库存">
            <b style="color:#e63f00">{{$errors->first("goods_num")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio" name="is_show" value="1" checked>是
			<input type="radio" name="is_show" value="2">否
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_new" value="1" checked>是
			<input type="radio" name="is_new" value="2">否
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_best" value="1" checked>是
			<input type="radio" name="is_best" value="2">否
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否推荐</label>
		<div class="col-sm-10">
			<input type="radio" name="is_res" value="1" checked>是
			<input type="radio" name="is_res" value="2">否
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否热销</label>
		<div class="col-sm-10">
			<input type="radio" name="is_sell" value="1" checked>是
			<input type="radio" name="is_sell" value="2">否
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否促销</label>
		<div class="col-sm-10">
			<input type="radio" name="is_sale" value="1" checked>是
			<input type="radio" name="is_sale" value="2">否
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否在幻灯片显示</label>
		<div class="col-sm-10">
			<input type="radio" name="is_seild" value="1">是
			<input type="radio" name="is_seild" value="2" checked>否
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品主图</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" name="goods_img" >
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" multiple="multiple" name="goods_imgs[]" >
		</div>
	</div>
    <div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">商品描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="goods_desc" name="goods_desc" placeholder="请输入商品描述"></textarea>
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
<script src="/static/jquery.js"></script>
<script>
$(function(){
	$(document).on("blur","#goods_name",function(){
		var ags = /^[\u4e00-\u9fa5,\d]{2,50}$/;
		//验证商品名称
		var _value = $(this).val();
		if(_value==""){
			$(this).next().text("商品名称不能为空");
		}else if(!ags.test(_value)){
			$(this).next().text("商品名称长度在2-50位,可以包含数字、字母、下划线、汉字组成");
		}else{
			$.ajax({
				url:("/goods/ajaxName"),
				type:"get",
				data:{_value:_value},
				success:function(res){
					// alert(res);
					if(res=="no"){
						$("#goods_name").next().text("商品名称已存在");
					}else{
						$("#goods_name").next().html("<font color='green'>√</font>");
					}
				}
			})
		}
	})
	//验证商品库存
	$(document).on("blur","#goods_num",function(){
		var _value = $(this).val();
		var ags = /^[0-9]{1,8}$/;
		if(_value==""){
			$(this).next().text("商品库存不能为空");
		}else if(!ags.test(_value)){
			$(this).next().text("商品库存必须为数字长度8位以内");
		}else{
			$(this).next().html("<font color='green'>√</font>");
		}
	})
	//验证商品价格
	$(document).on("blur","#goods_price",function(){
		var _value = $(this).val();
		if(_value==""){
			$(this).next().text("商品价格不能为空");
		}else if(isNaN(_value)){
			$(this).next().text("商品价格必须为数字");
		}else{
			$(this).next().html("<font color='green'>√</font>");
		}
	})
	//按钮验证
	$(document).on("click","button",function(){
		// alert("123");
		var nameflag = true;
		//验证商品
		var ags = /^[\u4e00-\u9fa5,\d]{2,50}$/;
		//验证商品名称
		var goods_name = $("#goods_name").val();
		if(goods_name==""){
			$("#goods_name").next().text("商品名称不能为空");
			return false;
		}else if(!ags.test(goods_name)){
			$("#goods_name").next().text("商品名称长度在2-50位,可以包含数字、字母、下划线、汉字组成");
			return false;
		}else{
			$.ajax({
				url:("/goods/ajaxName"),
				type:"get",
				data:{_value:goods_name},
				async:false,
				success:function(res){
					// alert(res);
					if(res=="no"){
						// alert("123");
						$("#goods_name").next().text("商品名称已存在");
						nameflag = false;
					}
				}
			})
			if(!nameflag){
				return false;
			}
		}
		//验证库存
		var goods_num = $("#goods_num").val();
		var ags1 = /^[0-9]{1,8}$/;
		if(goods_num==""){
			// alert("123");
			$("#goods_num").next().text("商品库存不能为空");
			return false;
		}else if(!ags1.test(goods_num)){
			$("#goods_num").next().text("商品库存必须为数字长度8位以内");
			return false;
		}
		//验证价格
		var _value = $("#goods_price").val();
		if(_value==""){
			// alert(123);
			$("#goods_price").next().text("商品价格不能为空");
			return false;
		}else if(isNaN(_value)){
			$("#goods_price").next().text("商品价格必须为数字");
			return false;
		}
	})
})
</script>