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
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">文章展示</h1>
<a href="{{url('/article/create')}}" style="float:right;margin-right:40px" type="button" class="btn btn-default">添加</a>
<div class="table-responsive" style="margin-top:110px;">
	<form action="{{url('/article/index')}}">
		<input type="text" name="name" value="{{$name??''}}" placeholder="请输入文章标题">
		<select name="t_name" id="">
                <option value="">--请选择--</option>
                @foreach ($type as $v)
                <option value="{{$v->t_name}}"{{$v->t_name==$t_name ? "selected" : ""}}>{{$v->t_name}}</option>
                @endforeach
            </select>
		<input type="submit" value="搜索">
	</form>
	<table class="table">
		<thead>
			<tr>
				<th style="padding-left:20px;">文章id</th>
				<th>文章标题</th>
				<th>文章分类</th>
				<th>是否重要性</th>
				<th>是否显示</th>
				<th>文章作者</th>
				<th>作者email</th>
				<th>关键字</th>
				<th>网页描述</th>
				<th>上传文件</th>
				<th>添加时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($artiInfo as $v)
			<tr article_id = "{{$v->article_id}}">
				<th style="padding-left:20px;">{{$v->article_id}}</th>
				<th>{{$v->article_name}}</th>
				<th>{{$v->t_name}}</th>
				<th>{{$v->is_impor ? "√" : "×"}}</th>
				<th>{{$v->is_show ? "√" : "×"}}</th>
				<th>{{$v->article_man}}</th>
				<th>{{$v->article_email}}</th>
				<th>{{$v->article_word}}</th>
				<th>{{$v->article_desc}}</th>
				<th>@if($v->article_img)<img src="{{env('UPLOADS_URL')}}{{$v->article_img}}" width="35px" alt="">@endif</th>
				<th>{{date('Y-m-d H:i:s',$v->article_time)}}</th>
				<th>
                <a href="{{url('/article/edit/'.$v->article_id)}}" class="btn btn-info">编辑</a>
                <a href="javascript:void(0)" class="btn btn-danger del">删除</a>
                </th>
			</tr>
        @endforeach
		<tr><td colspan="6">{{$artiInfo->appends(["name"=>$name,"t_name"=>$t_name])->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>
<script src="/static/jquery.js"></script>
<script>
$(function(){
	$(document).on("click",".del",function(){
		var _this = $(this);
		var _aid = _this.parents("tr").attr("article_id");
		// alert(_aid);
		if (confirm("确定要删除")) {
					// $.get(
					// 	"/article/destroy/"+_aid,
					// 	function(res){
					// 		if(res.code==00000){
					// 		location.reload();
					// 		alert("已删除");
					// 	}else{
					// 		alert("删除失败");
					// 	}
					// },"json"
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.post(
						"/article/destroy/"+_aid,
						function(res){
							if(res.code==00000){
							location.reload();
							// alert("已删除");
						}else{
							alert("删除失败");
						}
					},"json"
				)
            }
	})
})
</script>