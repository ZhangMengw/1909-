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
<form class="form-horizontal" action="{{url('/category/update/'.$cateInfo->cate_id)}}" method="post" role="form" style="width:97%;">
@csrf
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="cate_name" value="{{$cateInfo->cate_name}}" 
				   placeholder="请输入商品名称">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">分类</label>
		<div class="col-sm-10">
			<select name="pid" id="">
                <option value="">--请选择--</option>
                @foreach ($cateInfos as $v)
                <option value="{{$v->cate_id}}" {{$v->cate_id==$cateInfo->cate_id ? "selected" : ""}}>{{$v->cate_name}}</option>
                @endforeach
            </select>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">是否在导航栏显示性别</label>
		<div class="col-sm-10">
			<input type="radio" name="cate_nav" value="1" {{$cateInfo->cate_nav=='1' ? "checked" : ""}}>是
			<input type="radio" name="cate_nav" value="2" {{$cateInfo->cate_nav=='2' ? "checked" : ""}}>否
		</div>
	</div>
    <div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="lastname" name="cate_desc" placeholder="请输入商品描述">{{$cateInfo->cate_desc}}</textarea>
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