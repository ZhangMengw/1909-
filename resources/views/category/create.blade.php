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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">分类添加</h1>
<a href="{{url('/category/index')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">展示</a>
<div style="margin-top:110px;">
<form class="form-horizontal" action="{{url('/category/store')}}" method="post" role="form" style="width:97%;">
@csrf
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="cate_name" name="cate_name" 
				   placeholder="请输入商品名称">
			<b style="color:#e63f00;">{{$errors->first("cate_name")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">分类</label>
		<div class="col-sm-10">
			<select name="pid" id="">
                <option value="">--请选择--</option>
                @foreach ($cateInfo as $v)
                <option value="{{$v->cate_id}}">{{str_repeat("|——",$v->level)}}{{$v->cate_name}}</option>
                @endforeach
            </select>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否在导航栏显示性别</label>
		<div class="col-sm-10">
			<input type="radio" name="cate_nav" value="1">是
			<input type="radio" name="cate_nav" value="2">否
		</div>
	</div>
    <div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="cate_desc" name="cate_desc" placeholder="请输入商品描述"></textarea>
			<b style="color:#e63f00;">{{$errors->first("cate_desc")}}</b>
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
	//验证分类名称
	$(document).on("blur","#cate_name",function(){
		// alert("123");
		var _value = $(this).val();
		//判断不能为空
		if(_value==""){
			// alert("123");
			$(this).next().text("分类名称不能为空");
		}else{
			$.ajax({
				url:"{{url('/category/ajaxName')}}",
				type:"get",
				data:{_value:_value},
				success:function(res){
					// alert(res);
					if(res=="no"){
						$("#cate_name").next().text("分类名称不能为空");
					}else{
						$("#cate_name").next().html("<font color='green'>√</font>");
					}
				}
			})
		}
	})
	//验证分类描述
	$(document).on("blur","#cate_desc",function(){
		var _value = $(this).val();
		if(_value==""){
			_value.next().text("分类描述不能为空");
		}
	})
	//验证禁止提交
	$(document).on("click","button",function(){
		var nameflag = true;
		//分类名称
		var _value = $("#cate_name").val();
		//判断不能为空
		if(_value==""){
			// alert("123");
			$("#cate_name").next().text("分类名称不能为空");
			return false;
		}else{
			$.ajax({
				url:"{{url('/category/ajaxName')}}",
				type:"get",
				data:{_value:_value},
				async:false,
				success:function(res){
					// alert(res);
					if(res=="no"){
						$("#cate_name").next().text("分类名称不能为空");
						nameflag = false;
					}
				}
			})
			if(!nameflag){
				return false;
			}
		}
		//分类描述
		var _value = $("#cate_desc").val();
		if(_value==""){
			$("#cate_desc").next().text("分类描述不能为空");
			return false;
		}
	})
})
</script>