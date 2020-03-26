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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">学生信息添加</h1>
<a href="{{url('/studen/index')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">展示</a>
<div style="margin-top:110px;">
<form class="form-horizontal" action="{{url('/student/update/'.$info->s_id)}}" method="post" role="form" style="width:97%;">
@csrf
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">学生名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" value="{{$info->s_name}}" name="s_name" 
				   placeholder="请输入商品名称">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">学生性别</label>
		<div class="col-sm-10">
			<input type="radio" name="s_sex" value="1" {{$info->s_sex=='1' ? "checked" : ""}}>男
			<input type="radio" name="s_sex" value="2" {{$info->s_sex=='2' ? "checked" : ""}}>女
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">学生班级</label>
		<div class="col-sm-10">
			<select name="b_id" id="">
                <option value="">--请选择--</option>
                @foreach ($studentInfo as $v)
                <option value="{{$v->b_id}}"{{$info->b_id==$v->b_id ? "selected" : ""}}>{{$v->b_name}}</option>
                @endforeach
            </select>
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