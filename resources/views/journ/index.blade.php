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
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">新闻展示</h1>
<a href="{{url('/journ/create')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">添加</a>
<div class="table-responsive" style="margin-top:110px;">
	
	<form action="{{url('/journ/index')}}" method="get">
		<input type="text" name="journ_name" placeholder="请输入新闻标题">
		<input type="submit" value="搜索">
	</form>

	<table class="table">
		<thead>
			<tr>
				<th style="padding-left:20px;">新闻id</th>
				<th>新闻标题</th>
				<th>新闻作者</th>
				<th>新闻分类</th>
				<th>添加时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($journInfo as $v)
			<tr>
				<th style="padding-left:20px;">{{$v->journ_id}}</th>
				<th>{{$v->journ_name}}</th>
				<th>{{$v->journ_man}}</th>
				<th>{{$v->cate_name}}</th>
				<th>{{date('Y-m-d H:i:s',$v->journ_time)}}</th>
				<th>
                <a href="{{url('/journ/edit/'.$v->journ_id)}}" class="btn btn-info">编辑</a>
                <a href="{{url('/journ/destroy/'.$v->journ_id)}}" class="btn btn-danger">删除</a>
                </th>
			</tr>
        @endforeach
		<tr><td colspan="6">{{$journInfo->appends(["journ_name"=>$name])->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>
<script src="/static/jquery.js"></script>
<script>
    //给分页的每个a标签增加点击事件
    $(document).on("click",".pagination a",function(){
        //回去点击的a标签的href中的地址
        var url = $(this).attr("href");
        // alert(url);
        //将获取的href中的地址使用Ajax传给控制器
        $.get(url,function(res){
            // alert(res);
            //返回的数据放回tbody中
            $("tbody").html(res);
        })
        //让路径关闭
        return false;
    })
</script>