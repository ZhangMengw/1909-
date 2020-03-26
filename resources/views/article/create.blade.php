<!-- 导航 -->
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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">文章添加</h1>
<a href="{{url('/article/index')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">展示</a>
<div style="margin-top:110px;">
<form class="form-horizontal" action="{{url('/article/store')}}" method="post" enctype="multipart/form-data" role="form" style="width:97%;">
@csrf
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="article_name" name="article_name" 
				   placeholder="请输入文章标题">
        <b style="color:#e63f00" id="b_name">{{$errors->first("article_name")}}</b>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-10">
			<select name="t_id" id="">
                <option value="">--请选择--</option>
                @foreach ($type as $v)
                <option value="{{$v->t_id}}">{{$v->t_name}}</option>
                @endforeach
            </select>
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
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-10">
			<input type="radio" name="is_impor" value="1" checked>普通
			<input type="radio" name="is_impor" value="2">置顶
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="article_man" 
				   placeholder="请输入文章作者">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="article_email" 
				   placeholder="请输入作者email">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="article_word" 
				   placeholder="请输入关键字">
		</div>
	</div>
    <div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="lastname" name="article_desc" placeholder="请输入网页描述"></textarea>
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" name="article_img" >
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default button">添加</button>
			<button type="reset" class="btn btn-default">重置</button>
		</div>
	</div>
</form>
</div>

</body>
</html>
<script src="/static/jquery.js"></script>
<script>
$(function(){
    $(document).on("blur","#article_name",function(){
        // alert("123");
        var _value = $(this).val();
        var ags = /^[\u4e00-\u9fa5,\w]{1,}$/;
        if(_value==""){
            $("#b_name").html("文章标题不能为空");
            // alert("123");
        }else if(!ags.test(_value)){
            // alert("123");
            $("#b_name").html("文章标题是中文字母数字下划线");
        }else{
            $.ajax({
                    url: "{{url('/article/ajaxName')}}",
                    type: "get",
                    data: {
                        _value:_value 
                    },
                    success: function(res) {
                        // alert(res);
                        if (res == 'no') {
                            $("#b_name").html("<font color='red'>该用户名已存在</font>");
                        } else {
                            $("#b_name").html("<font color='green'>√</font>");
                        }
                    }
                })
        }
    })
    $(document).on("click",".button",function(){
        var nameflag = true;
        var _value = $("input[name='article_name']").val();
        var ags = /^[\u4e00-\u9fa5,\w]{1,}$/;
        if(_value==""){
            alert("123");
            $("#b_name").html("文章标题不能为空");
            return false;
        }else if(!ags.test(_value)){
            // alert("123");
            $("#b_name").html("文章标题是中文字母数字下划线");
            return false;
        }else{
            $.ajax({
                    url: "{{url('/article/ajaxName')}}",
                    type: "get",
                    data: {
                        _value:_value 
                    },
                    async:false,
                    success: function(res) {
                        // alert(res);
                        if (res == 'no') {
                            $("#b_name").html("<font color='red'>该用户名已存在</font>");
                            nameflag = false;
                        }
                    }
                })
            if(!nameflag){
                return false;
            }
        }
    })
    
})
</script>