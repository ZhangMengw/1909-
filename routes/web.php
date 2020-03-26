<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// //闭包路由  系统自带
// Route::get('/', function () {
//     return view('welcome');
// });
// 项目后台
Route::get('/admin', function () {
    return view('public\home');
});

Route::get('/goods', "ControllerIndex@goods");
// Route::get('/add', function(){
//     echo "<form action='/adddo' method='post'>".csrf_field()."<input name='name'><input type='submit'></form>";
// });
// Route::post('/adddo', function(){
//     echo request()->name;
// });

//使用get方式找到控制器
// Route::get('/add', "ControllerIndex@add");
//post接收找到控制器
// Route::post('/adddo', "ControllerIndex@adddo");

//可以使用get和post一起使用 接收到控制器
// Route::match(['get','post'],'/add', "ControllerIndex@add");

//查看视图
// Route::view('/addb', "add");

// //可以不写提交方式有默认
// Route::any("/add","ControllerIndex@add");

//必填路由参数 闭包 
// Route::get("/show/{id}",function($id){
//     echo $id;
// });

//必填路由参数 控制器
// Route::get("/show/{id}/{name}","ControllerIndex@show");

//可填路由器参数 闭包 
// Route::get("/news/{id?}","ControllerIndex@news");

//
// Route::get("/news/{id?}/{name?}","ControllerIndex@news")->where("id","[0-9]+");

//可填路由器参数 正则约束 控制器
// Route::get("/news/{id?}/{name?}","ControllerIndex@news")->where(["id"=>"[0-9]+","name"=>"[a-zA-Z]+"]);



//品牌路由
// Route::prefix('brand')->middleware("auth.basic")->group(function () {
Route::prefix('brand')->middleware("isuser")->group(function () {
    //添加路由
    Route::get("create","ControllerBrand@create");
    //Ajax验证
    Route::get("ajaxName","ControllerBrand@ajaxName");
    //执行添加路由
    Route::post("store","ControllerBrand@store");
    //展示路由
    Route::get("index","ControllerBrand@index");
    //修改展示路由
    Route::get("edit/{id}","ControllerBrand@edit");
    Route::post("update/{id}","ControllerBrand@update");
    //删除展示路由
    Route::get("destroy/{id}","ControllerBrand@destroy");
});

//商品路由
// Route::prefix('goods')->middleware("auth.basic")->group(function () {
Route::prefix('goods')->middleware("isuser")->group(function () {
    //添加路由
    Route::get("create","ControllerGoods@create");
    //ajax
    Route::get("ajaxName","ControllerGoods@ajaxName");
    //执行添加路由
    Route::post("store","ControllerGoods@store")->name("goodsstore");
    //展示路由
    Route::get("index","ControllerGoods@index");
    //修改展示路由
    Route::get("edit/{id}","ControllerGoods@edit");
    Route::post("update/{id}","ControllerGoods@update")->name("goodsupdate");
    //删除展示路由
    Route::get("destroy/{id}","ControllerGoods@destroy");
});

//管理员路由
// Route::prefix('admin')->middleware("auth.basic")->group(function () {
Route::prefix('admin')->middleware("isuser")->group(function () {
    //添加路由
    Route::get("create","ControllerAdmin@create");
    //ajax验证
    Route::get("ajaxName","ControllerAdmin@ajaxName");
    //执行添加路由
    Route::post("store","ControllerAdmin@store");
    //展示路由
    Route::get("index","ControllerAdmin@index");
    //修改展示路由
    Route::get("edit/{id}","ControllerAdmin@edit");
    Route::post("update/{id}","ControllerAdmin@update");
    //删除展示路由
    Route::get("destroy/{id}","ControllerAdmin@destroy");
});

//登录页面
// Route::get("login","ControllerLogin@login");
Route::post("/login/logindo","ControllerLogin@logindo");
// 后台首页
Route::get("home","ControllerLogin@home");



//班级路由
//添加
Route::get("/student/create","ControllerStudent@create");
Route::post("/student/store","ControllerStudent@store");
Route::get("/student/index","ControllerStudent@index");
Route::get("/student/edit/{id}","ControllerStudent@edit");
Route::post("/student/update/{id}","ControllerStudent@update");
Route::get("/student/destroy/{id}","ControllerStudent@destroy");

//分类
// Route::prefix("category")->middleware("auth.basic")->group(function(){
Route::prefix("category")->middleware("isuser")->group(function(){
    //添加
    Route::get("create","ControllerCategory@create");
    //Ajax
    Route::get("ajaxName","ControllerCategory@ajaxName");
    //执行添加
    Route::post("store","ControllerCategory@store");
    //展示
    Route::get("index","ControllerCategory@index");
    //修改展示
    Route::get("edit/{id}","ControllerCategory@edit");
    //执行修改
    Route::post("update/{id}","ControllerCategory@update");
    //删除展示
    Route::get("destroy/{id}","ControllerCategory@destroy");
});

//销售
//添加
Route::get("/xiao/create","ControllerXiao@create");
//执行添加
Route::post("/xiao/store","ControllerXiao@store");
//展示
Route::get("/xiao/index","ControllerXiao@index");

//图书路由
Route::prefix('book')->group(function () {
    //添加路由
    Route::get("create","ControllerBook@create");
    //执行添加路由
    Route::post("store","ControllerBook@store");
    //展示路由
    Route::get("index","ControllerBook@index");
});

//新闻路由
Route::prefix('journ')->group(function () {
    //添加路由
    Route::get("create","ControllerJourn@create");
    //执行添加路由
    Route::post("store","ControllerJourn@store");
    //展示路由
    Route::get("index","ControllerJourn@index");
});
Route::prefix("article")->middleware("islogin")->group(function(){
    //添加路由
    Route::get("create","ControllerArticle@create");
    //执行添加路由
    Route::post("store","ControllerArticle@store")->name("articlestore");
    //执行添加路由
    Route::get("ajaxName","ControllerArticle@ajaxName");
    //展示路由
    Route::get("index","ControllerArticle@index");
    //修改展示
    Route::get("edit/{id}","ControllerArticle@edit");
    //执行修改
    Route::post("update/{id}","ControllerArticle@update")->name("articleupdate");
    //删除展示
    // Route::get("destroy/{id}","ControllerArticle@destroy");
    Route::post("destroy/{id}","ControllerArticle@destroy");
});

//前台首页
Route::get("/","Index\ControllerIndex@index")->middleware("islogin");
Route::get("/log","Index\ControllerLogin@log");
//商品首页
Route::get("/reg","Index\ControllerLogin@reg");
//商品列表新品
Route::get("/prolistNew","Index\ControllerIndex@prolist");
//商品详情页
Route::get("/proInfo/{id}","Index\ControllerGoods@proInfo");
//商品购物车
Route::get("/cart","Index\ControllerGoods@cart");
//加入购物车
Route::get("/addcart","Index\ControllerGoods@addcart");
//修改数据库购买数量
Route::get("/cart/changeNumber","Index\ControllerGoods@changeNumber");
//修改小计
Route::get("/cart/getTotal","Index\ControllerGoods@getTotal");
//计算总价
Route::get("/cart/gatMoney","Index\ControllerGoods@gatMoney");
//确认结算
Route::get("/cart/pay/{id}","Index\ControllerAddress@pay");
//确认收货地址
Route::get("/cart/add_address","Index\ControllerAddress@add_address");
//添加收货地址
Route::get("/cart/address","Index\ControllerAddress@address");
//三级联动内容改变事件
Route::get("/address/getCity","Index\ControllerAddress@getCity");
//执行添加收货地址
Route::post("/address/addressDo","Index\ControllerAddress@addressDo");
//支付方式
Route::post("/cart/payment","Index\ControllerAddress@payment");
//确认订单
Route::get("/paysuccess/{orderId}","Index\ControllerPay@pay");
//同步跳转
Route::get("/return_url","Index\ControllerPay@return_url");
//异步跳转
Route::post("/notify_url","Index\ControllerPay@notify_url");
//退出
Route::get("/quie","Index\ControllerLogin@quie");
//手机号验证
Route::get("/reg/sendSMS","Index\ControllerLogin@sendSMS");
//邮箱验证
Route::get("/reg/sendEmail","Index\ControllerLogin@sendEmail");
//注册执行
Route::post("/reg/regdo","Index\ControllerLogin@regdo");
//登陆执行
Route::post("/log/logdo","Index\ControllerLogin@logdo");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
