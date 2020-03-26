@extends('layouts.shop')
@section('title', '商品详情')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
        @if($proInfo->goods_imgs)
					@php $goods_imgs = explode("|",$proInfo["goods_imgs"]); @endphp
					@foreach($goods_imgs as $vv)
					<img src="{{env('UPLOADS_URL')}}{{$vv}}" width="35px" alt="">
					@endforeach
				@endif
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$proInfo->goods_price}}</strong></th>
       <td>
        <input type="text" id="buy_number" class="spinnerExample" />
       </td>
       <td>浏览:{{$proress}}</td>
      </tr>
      <tr>
       <td>
        <strong>{{$proInfo->goods_name}}</strong>
        <p class="hui">富含纤维素，平衡每日膳食</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      {{$proInfo->goods_desc}}
    </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td id="carOrder"><a href="javascript:;">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    
     <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
  </script>
  @include('index.public.footer');
  <script>
  $(function(){
    //加号按钮
    // $(document).on("click","button[class='increase']",function(){
    //   var buy_number = parseInt($("#buy_number").val());
    //   var goods_num = parseInt("{{$proInfo->goods_num}}");
    //   // alert(goods_num);
    //   // alert(buy_number);
    //   if (buy_number >= goods_num) {
    //         $("#buy_number").val(goods_num);
    //   }
    // })
    // //减号按钮
    // $(document).on("click","button[class='decrease']",function(){
    //   var buy_number = parseInt($("#buy_number").val());
    //   var goods_num = parseInt("{{$proInfo->goods_num}}");
    //   // alert(goods_num);
    //   // alert(buy_number);
    //   if (buy_number <= 1) {
    //         $("#buy_number").val("1");
    //   }
    // })
    //加入购物车按钮
    $(document).on("click","#carOrder",function(){
      // alert("123");
      var buy_number = $("#buy_number").val();
      // alert(buy_number);
      var goods_id = "{{$proInfo->goods_id}}";
      // alert(goods_id);
      if(buy_number<1){
        alert("请更新购买数量");
        return false;
      }
      $.get(
          "/cart", {
              goods_id: goods_id,
              buy_number: buy_number
          },
          function(res) {
              // alert(res);
              if (res.code == 00003) {
                location.href="/log?refer="+location.href;
              }else if(res.code==00004){
                alert(res.msg);
              }else if(res.code==00000){
                alert(res.msg);
                location.href="/addcart";
              }
          },
          "json"
      )
    })
  })
  </script>

  
  @endsection