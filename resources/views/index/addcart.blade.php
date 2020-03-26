@extends('layouts.shop')
@section('title', '购物车页面')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange"></strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" class="allbox" /> 全选</a></td>
       </tr>
       
     @foreach ($cart as $v)
       <tr goods_id = "{{$v->goods_id}}">
        <td width="4%"><input type="checkbox" name="1" class="box" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date('Y-m-d H:i:s',$v->add_time)}}</time>
        </td>
        <td align="right"  goods_num = "{{$v->goods_num}}"><input type="text" id="cart_{{$v->cart_id}}" class="spinnerExample"/></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price*$v->buy_number}}</strong></th>
       </tr>
     @endforeach
      </table>
     </div><!--dingdanlist/-->
   
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="money">¥0</strong></td>
       <td width="40%"><a href="javascript:void(0)" class="jiesuan" id="pay">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
   @foreach($cart_id as $k=>$v)
      $("#cart_"+{{$v}}).val({{$buy_number[$k]}});
      @endforeach
   </script>

   <script>
   $(function(){
      //点击加号
      $(document).on("click",".increase",function(){
         // alert("123");
         var _this = $(this);
         var buy_number = parseInt(_this.prev().val());
         console.log(buy_number);
         var goods_num = parseInt($(this).parents("td").attr("goods_num"));
         // alert(goods_num);
         if(buy_number>=goods_num){
            $(this).prev().val(goods_num);
         }
         // console.log(buy_number);
         var goods_id = $(this).parents("tr").attr("goods_id");
         // alert(goods_id);
         //1.更改数据库购买数量
         changeNumber(goods_id, buy_number);
         //2.将这个对象和商品id传给小计计算方法
         getTotal(goods_id, _this);
         //选中复选框
         trChecked(_this);
         //获取总价
         getMoney();

      })

      //点击减号
      $(document).on("click",".decrease",function(){
         // alert("123");
         var _this = $(this);
         var buy_number = parseInt($(".spinnerExample").val());
         // alert(buy_number);
         var goods_num = parseInt($(this).parents("td").attr("goods_num"));
         // alert(goods_num);
         if(goods_num<=1){
            $(this).next().val("1");
         }
         var goods_id = $(this).parents("tr").attr("goods_id");
         // alert(goods_id);
         //1.更改数据库购买数量
         changeNumber(goods_id, buy_number);
         //2.将这个对象和商品id传给小计计算方法
         getTotal(goods_id, _this);
         //选中复选框
         trChecked(_this);
         //获取总价
         getMoney();

      })

      //购买数量失去焦点
      $(document).on("blur",".spinnerExample",function(){
         // alert("123");
         var _this = $(this);
         var buy_number = parseInt($(this).val());
         // alert(buy_number);
         var goods_num = parseInt($(this).parents("td").attr("goods_num"));
         // alert(goods_num);
         if(buy_number>=goods_num){
            $(this).val(goods_num);
         }
         var goods_id = $(this).parents("tr").attr("goods_id");
         //1.更改数据库购买数量
         changeNumber(goods_id, buy_number);
         //2.将这个对象和商品id传给小计计算方法
         getTotal(goods_id, _this);
         //选中复选框
         trChecked(_this);
         //获取总价
         getMoney();
         
      })

      //点击复选框
      $(document).on("click",".box",function(){
         var _this = $(this);
            var child = _this.prop("checked");
            // console.log(child);
            //给选中的复选框增加颜色
            if (child == true) {  
               //2.获取总价
               getMoney();
            }
      })

      //修改购买数量
      function changeNumber(goods_id,buy_number){
         $.ajax({
                url: "{{url('/cart/changeNumber')}}", //传给控制器
                type: "get", //post方式
                data: {
                    goods_id: goods_id,
                    buy_number: buy_number
                }, //将商品id 购买数量传给控制器
                async: false, //同步
                dataType: "json",
                success: function(res) {
                  //   alert(res);
                    if (res === false) {
                        alert("修改有误");
                    }

                }
            })
      }

      //选中复选框
      function trChecked(_this) {
            _this.parents("tr").find(".box").prop("checked", true);
        }

      //计算小计
      function getTotal(goods_id, _this){
         $.get( //get方式
                "{{url('/cart/getTotal')}}", { //传给控制器
                    goods_id: goods_id
                },
                function(res) {
                    // console.log(res);
                    _this.parents("tr").next().find("th").text("￥" + res);
                }
            )
      }
      //获取总价
      //获取总价
      function getMoney() {
            //获取类为box选择复选框的
            var _box = $(".box:checked");
            // console.log(_box);
            var goods_id = "";
            //将选中的复选框循环
            _box.each(function(index) {
                    //获取到的值 再加上id
                    goods_id += $(this).parents("tr").attr("goods_id") + ",";
                })
                console.log(goods_id);
                //将id最后一个符号去掉
            goods_id = goods_id.substr(0, goods_id.length - 1);
            // console.log(goods_id);
            //post传给控制器
            $.get(
                "{{url('/cart/gatMoney')}}", {
                    goods_id: goods_id
                },
                function(res) {
                  //   console.log(res);
                    $("#money").text("￥" + res);
                }
            )
        }
        //确认结算
        $(document).on("click","#pay",function(){
         //   alert(123);
         var _box = $(".box:checked");
         // alert(_box);
         if(_box.length>0){
            var goods_id = "";
                _box.each(function(index) {
                    goods_id += $(this).parents("tr").attr("goods_id") + ",";
                    // console.log(goods_id);
                })
                goods_id = goods_id.substr(0, goods_id.length - 1);
                // console.log(goods_id);
                location.href = "/cart/pay/"+goods_id;
         }else{
            alert("请至少选择一件商品");
         }
        })
   })
   </script>
   
   @endsection