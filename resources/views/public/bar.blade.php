<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>欢迎进入后台数据</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<!-- <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid"> 
    <div class="navbar-header">
        <a class="navbar-brand" href="{{url('home')}}">后台数据首页</a>
    </div>
    <div>
        <!--向左对齐-->
        <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">管理员<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('/admin/create')}}">管理员添加</a></li>
                    <li><a href="{{url('/admin/index')}}">管理员列表</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">分类<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('/category/create')}}">分类添加</a></li>
                    <li><a href="{{url('/category/index')}}">分类列表</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">品牌<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('/brand/create')}}">品牌添加</a></li>
                    <li><a href="{{url('/brand/index')}}">品牌列表</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">商品<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('/goods/create')}}">商品添加</a></li>
                    <li><a href="{{url('/goods/index')}}">商品列表</a></li>
                </ul>
            </li>
        </ul>
        <!--向右对齐-->
        <ul class="nav navbar-nav navbar-right">
           
            <div class="navbar-header">
                @if(session('adminuser')=="")
                <a class="navbar-brand"style="font-size:15px">欢迎登陆</a>
                @else
                <a class="navbar-brand"style="font-size:15px">欢迎{{session('adduser')['admin_name']}}登陆</a>
                @endif
            </div>
            <div class="navbar-header">
                <!-- <a class="navbar-brand" href="{{url('Login/logout')}}" style="font-size:15px">退出</a> -->
            </div>
        </ul>
    </div>
	</div>
</nav>
</body>
</html>