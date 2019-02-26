<?php

/*
|__________________________________________________________________________
| Web Routes
|__________________________________________________________________________
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    
});

//___________________前台登陆注册开始____________________________________________

Route::get("/Front_login","Front_loginController@login")->name('Front_login');//前台登录

Route::post("/Front_do_login","Front_loginController@do_login")->name("Front_do_login");//处理登录

Route::get("/Front_logout","Front_loginController@logout")->name('Front_logout');//退出登录

Route::get("/Front_qrcode","Front_indexController@qrcode")->name('Front_qrcode');//退出登录

Route::get("/Front_send","Front_loginController@send")->name('Front_send');//手机验证码

Route::get("/Front_send","Front_loginController@send")->name('Front_send');//手机验证码

Route::post("/Front_safe_login","Front_loginController@safe_login")->name("Front_safe_login");//ip改变进行安全登陆

Route::get("/Front_register","Front_registerController@register")->name('Front_register');//前台注册

Route::post("/Front_do_register","Front_registerController@do_register")->name('Front_do_register');//前台注册

Route::get("/Front_email","Front_registerController@do_email")->name('Front_email');//前台邮箱注册

Route::get("/Front_href","Front_registerController@href")->name("Front_href");//邮箱注册后的跳转


//___________________前台登录注册结束______________________________________________

//_____________________前台主页部分开始_____________________________________________

Route::middleware(['Front'])->group(function(){

Route::get("/Front_index","Front_indexController@index")->name('Front_index');//前台主页

Route::get("/Front_cart","Front_indexController@cart")->name('Front_cart');//前台

Route::get("Front_add_cart","Front_cartController@add_cart")->name('Front_add_cart');//前台加入购物车

Route::get("/Front_del_cart","Front_cartController@del_cart")->name('Front_del_cart');//购物车的删除

Route::get("/Front_move_cart","Front_cartController@move_cart")->name('Front_move_cart');//购物车的移动

Route::get("/Front_readd_cart","Front_cartController@readd_cart")->name('Front_readd_cart');//购物车的重新加入

Route::get("/Front_del_delcart","Front_cartController@del_delcart")->name('Front_del_delcart');//购物车的删除以删除商品

Route::get("/Front_set_pay","Front_cartController@set_pay")->name('Front_set_pay');//购物车的结算

Route::get("/Front_cooperation","Front_indexController@cooperation")->name('Front_cooperation');//前台

Route::get("/Front_getOrderInfo","Front_indexController@getOrderInfo")->name('Front_getOrderInfo');//前台

Route::get("/Front_refund_order","Front_orderController@refund_order")->name('Front_refund_order');//前台

Route::get("/Front_pay_order","Front_orderController@pay_order")->name('Front_pay_order');//前台

Route::get("/Front_pay_success","Front_orderController@pay_success")->name('Front_pay_success');//前台

Route::get("/Front_order_info","Front_orderController@order_info")->name('Front_order_info');//前台订单状态

Route::post("/wxpay_notify","WxpayController@notify")->name('wxpay_notify');//前台订单状态wxpay_notify

Route::get("/Front_get_city","Front_cityController@get_city")->name('Front_get_city');//前台ajax获取城市

Route::get("/Front_set_address","Front_cityController@set_address")->name('Front_set_address');//前台ajax设置默认地址

Route::post("/Front_add_address","Front_cityController@add_address")->name('Front_add_address');//前台新增地址

Route::get("/Front_edit_address","Front_cityController@edit_address")->name('Front_edit_address');//前台编辑地址

Route::post("/Front_update_address","Front_cityController@update_address")->name('Front_update_address');//前台修改地址

Route::get("/Front_del_address","Front_cityController@del_address")->name('Front_del_address');//前台删除地址

Route::get("/Front_home_index","Front_indexController@home_index")->name('Front_home_index');//前台

Route::get("/Front_home_orderDetail","Front_indexController@home_orderDetail")->name('Front_home_orderDetail');//前台

Route::get("/Front_home_order_evaluate","Front_indexController@home_order_evaluate")->name('Front_home_order_evaluate');//前台

Route::get("/Front_home_order_pay","Front_indexController@home_order_pay")->name('Front_home_order_pay');//前台

Route::get("/Front_home_order_receive","Front_indexController@home_order_receive")->name('Front_home_order_receive');//前台

Route::get("/Front_home_order_send","Front_indexController@home_order_send")->name('Front_home_order_send');//前台

Route::get("/Front_home_person_collect","Front_indexController@home_person_collect")->name('Front_home_person_collect');//前台

Route::get("/Front_home_person_footmark","Front_indexController@home_person_footmark")->name('Front_home_person_footmark');//前台

Route::get("/Front_home_setting_address","Front_indexController@home_setting_address")->name('Front_home_setting_address');//前台

Route::get("/Front_home_setting_address_complete","Front_indexController@home_setting_address_complete")->name('Front_home_setting_address_complete');//前台

Route::get("/Front_home_setting_address_phone","Front_indexController@home_setting_address_phone")->name('Front_home_setting_address_phone');//前台

Route::get("/Front_home_setting_info","Front_indexController@home_setting_info")->name('Front_home_setting_info');//前台

Route::get("/Front_home_setting_safe","Front_indexController@home_setting_safe")->name('Front_home_setting_safe');//前台

Route::get("/Front_item","Front_indexController@item")->name('Front_item');//前台

Route::post("/Front_pay","Front_indexController@pay")->name('Front_pay');//前台

Route::get("/pay","WxpayController@pay")->name('pay');//前台支付按钮

Route::get("/qrcode","QrcodeController@qrcode")->name('qrcode');//前台支付按钮

Route::get('/go_back',"Front_orderController@go_back")->name('go_back');

Route::get("/Front_payfail","Front_indexController@payfail")->name('Front_payfail');//前台

Route::get("/Front_paysuccess","Front_indexController@paysuccess")->name('Front_paysuccess');//前台

Route::get("/Front_sampling","Front_indexController@sampling")->name('Front_sampling');//前台

Route::get("/Front_search","Front_indexController@search")->name('Front_search');//前台

Route::get("/Front_seckill_index","Front_indexController@seckill_index")->name('Front_seckill_index');//前台

Route::get("/Front_seckill_item","Front_indexController@seckill_item")->name('Front_seckill_item');//前台

Route::get("/Front_shop","Front_indexController@seckill_item")->name('Front_shop');//前台

Route::get("/Front_success_cart","Front_indexController@success_cart")->name('Front_success_cart');//前台
});
//______________________前台主页部分结束_____________________________________


//______________________后台登陆注册开始________________________________________________________________________________

Route::get("/Admin_login","Admin_loginController@login")->name('Admin_login');//后台登录

Route::post("/Admin_do_login","Admin_loginController@do_login")->name('Admin_do_login');//后台完成登录

Route::get("/Admin_logout","Admin_loginController@logout")->name('Admin_logout');//后台退出登录

Route::get("/Admin_register","Admin_registerController@register")->name('Admin_register');//后台注册

Route::get("/Admin_do_register","Admin_registerController@do_register")->name('Admin_do_register');//后台注册



//_______________________后台登陆注册结束________________________________________________________________________________

//_______________________后台主页部分开始________________________________________________________________________________
Route::get("/Admin_index","Admin_indexController@index")->name('Admin_index');//后台

Route::get("/Admin_home","Admin_indexController@home")->name('Admin_home');//后台

Route::get("/Admin_password","Admin_indexController@password")->name('Admin_password');//后台

Route::get("/Admin_seller","Admin_indexController@seller")->name('Admin_seller');//后台

Route::get("/Admin_goods","Admin_indexController@goods")->name('Admin_goods');//后台

Route::get("/Admin_goods_edit","Admin_indexController@goods_edit")->name('Admin_goods_edit');//后台

Route::get("/Admin_goods_type","Admin_indexController@goods_type")->name('Admin_goods_type');//后台商品类型

Route::get("/Admin_brand","Admin_indexController@brand")->name('Admin_brand');//后台商品品牌查询

Route::get("/Admin_goods_types","Admin_indexController@goods_types")->name('Admin_goods_types');//后台品牌添加页面

Route::post("/Admin_add_type","Admin_indexController@add_type")->name('Admin_add_type');//后台分类添加

Route::get("/Admin_brand_page","Admin_indexController@brand_page")->name('Admin_brand_page');//后台品牌页面

Route::post("/Admin_add_brand","Admin_indexController@add_brand")->name('Admin_add_brand');//后台添加品牌

Route::get("/Admin_del_brand","Admin_indexController@del_brand")->name('Admin_del_brand');//后台删除品牌

Route::get("/Admin_update_brand","Admin_indexController@update_brand")->name('Admin_update_brand');//后台修改品牌

Route::post("/Admin_doupdate_brand","Admin_indexController@doupdate_brand")->name('Admin_doupdate_brand');//后台提交修改品牌

Route::get("/Admin_update_type","Admin_indexController@update_type")->name('Admin_update_type');//后台品牌更新页面

Route::post("/Admin_type_doupdate","Admin_indexController@type_doupdate")->name('Admin_type_doupdate');//后台品牌提交更新

Route::get("/Admin_del_type","Admin_indexController@del_type")->name('Admin_del_type');//后台分类删除

Route::post("/Admin_goods_add","Admin_indexController@goods_add")->name('Admin_goods_add');//后台商品的添加

Route::get("/Admin_goods_update","Admin_indexController@goods_update")->name('Admin_goods_update');//后台商品的修改

Route::post("/Admin_goods_doupdate","Admin_indexController@goods_doupdate")->name('Admin_goods_doupdate');//后台商品的提交修改

Route::get("/Admin_goods_del","Admin_indexController@goods_del")->name('Admin_goods_del');//后台商品的删除

Route::get("/Admin_goods_price","Admin_indexController@goods_price")->name('Admin_goods_price');//后台商品价格管理

Route::get("/Admin_edit_price","Admin_indexController@edit_price")->name('Admin_edit_price');//后台商品价格编辑页面

Route::post("/Admin_update_price","Admin_indexController@update_price")->name('Admin_update_price');//后台商品价格更新

Route::get("/Admin_ajax_price","Admin_indexController@ajax_price")->name('Admin_ajax_price');//后台商品价格获取

Route::post("/Admin_add_price","Admin_indexController@add_price")->name('Admin_add_price');//后台商品提交价格

Route::get("/Admin_goods_skill","Admin_skillController@goods_skill")->name('Admin_goods_skill');//后台秒杀商品管理

Route::post("/Admin_seckill_start","Admin_skillController@seckill_start")->name('Admin_seckill_start');//后台秒杀商品的开启

Route::get("/Admin_seckill_close","Admin_skillController@seckill_close")->name('Admin_seckill_close');//后台秒杀商品的关闭

Route::get("/Admin_image","Admin_indexController@image")->name('Admin_image');//后台商品的图片管理



Route::post("/Admin_add_image","Admin_indexController@add_image")->name('Admin_add_image');//后台商品图片的添加

Route::get("/Admin_edit_image","Admin_indexController@edit_image")->name('Admin_edit_image');//后台商品图片的添加

Route::post("/Admin_update_image","Admin_indexController@update_image")->name('Admin_update_image');//后台商品图片的添加

Route::get("/Admin_del_image","Admin_indexController@del_image")->name('Admin_del_image');//后台商品图片的添加

Route::get('/Admin_order_page',"Admin_orderController@order_page")->name('Admin_order_page');//后台订单页面

Route::get('/Admin_order_ajax',"Admin_orderController@order_ajax")->name('Admin_order_ajax');//后台订单页面ajax

Route::get('/Admin_order_del',"Admin_orderController@order_del")->name('Admin_order_del');//后台订单页面ajax

Route::get('/Admin_order_content',"Admin_orderController@order_content")->name('Admin_order_content');//后台订单详情页面

Route::get('/Admin_order_send',"Admin_orderController@order_send")->name('Admin_order_send');//后台订单发货

Route::get('/Admin_refund_page',"Admin_orderController@refund_page")->name('Admin_refund_page');//后台订单退款页面

Route::get('/Admin_refund_content',"Admin_orderController@refund_content")->name('Admin_refund_content');//后台订单退款详情页面

Route::get("/Admin_ad_page","Admin_adController@ad_page")->name("Admin_ad_page");//广告页面

Route::get("/Admin_ad_type","Admin_adController@ad_type")->name('Admin_ad_type');//广告分类页面

Route::get("/Admin_ad_get_type","Admin_adController@ad_get_type")->name('Admin_ad_get_type');//广告获取分类

Route::post("/Admin_ad_add_type","Admin_adController@ad_add_type")->name('Admin_ad_add_type');//广告类型的添加

Route::get("/Admin_ad_type_edit","Admin_adController@ad_type_edit")->name('Admin_ad_type_edit');//广告类型的编辑

Route::post("/Admin_ad_type_update","Admin_adController@ad_type_update")->name('Admin_ad_type_update');//广告类型的修改

Route::get("/Admin_ad_del_type","Admin_adController@ad_del_type")->name('Admin_ad_del_type');//广告类型的删除

Route::post("/Admin_ad_add_group","Admin_adController@ad_add_group")->name('Admin_ad_add_group');//广告分组的添加

Route::post("/Admin_ad_update_group","Admin_adController@ad_update_group")->name('Admin_ad_update_group');//广告分组的修改

Route::post("/Admin_ad_del_group","Admin_adController@ad_del_group")->name('Admin_ad_del_group');//广告分组的删除

Route::post("/Admin_ad_add","Admin_adController@ad_add")->name('Admin_ad_add');//广告的修改

Route::get("/Admin_ad_edit","Admin_adController@ad_edit")->name('Admin_ad_edit');//广告的修改

Route::post("/Admin_ad_update","Admin_adController@ad_update")->name('Admin_ad_update');//广告的修改

Route::get("/Admin_ad_del","Admin_adController@ad_del")->name('Admin_ad_del');//广告的删除

Route::get("Admin_shop","Admin_shopController@shop")->name('Admin_shop');



//_______________________后台主页部分结束________________________________________________________________________________

//_______________________运行商登陆注册开始______________________________________________________________________________

Route::get("/Manager_login","Manager_loginController@login")->name('Manager_login');//运行商登录

Route::get("/Manager_dologin","Manager_loginController@dologin")->name('Manager_dologin');//运行商登录

Route::get("/Manager_logout","Manager_loginController@logout")->name('Manager_logout');//运行商退出登录

//_______________________运行商登陆注册结束______________________________________________________________________________

//_______________________运行商主页部分开始______________________________________________________________________________
Route::get("/Manager_brand","Manager_indexController@brand")->name('Manager_brand');//运行商

Route::get("/Manager_content_category","Manager_indexController@content_category")->name('Manager_content_category');//运行商

Route::get("/Manager_goods","Manager_indexController@goods")->name('Manager_goods');//运行商

Route::get("/Manager_home","Manager_indexController@home")->name('Manager_home');//运行商

Route::get("/Manager_index","Manager_indexController@index")->name('Manager_index');//运行商

Route::get("/Manager_type_template","Manager_indexController@type_template")->name('Manager_type_template');//运行商

Route::get("/Manager_item_cat","Manager_indexController@item_cat")->name('Manager_item_cat');//运行商

Route::get("/Manager_seller","Manager_indexController@seller")->name('Manager_seller');//运行商

Route::get("/Manager_seller_1","Manager_indexController@seller_1")->name('Manager_seller_1');//运行商

Route::get("/Manager_specification","Manager_indexController@specification")->name('Manager_specification');//运行商




Route::get("/Manager_ad_get_type","Manager_adController@ad_get_type")->name('Manager_ad_get_type');//广告获取分类



Route::get("/Manager_member_list","Manager_memberController@member_list")->name("Manager_member_list");//会员列表查询





Route::post("/Manager_admin_update","Manager_adminController@admin_update")->name("Manager_admin_update");//管理员提交修改



Route::post("/Manager_admin_power_doadd","Manager_adminController@admin_power_doadd")->name("Manager_admin_power_doadd");//管理员权限的提交添加

Route::post("/Manager_admin_power_update","Manager_adminController@admin_power_update")->name("Manager_admin_power_update");//管理员权限的提交修改



Route::get("/Manager_admin_info","Manager_adminController@admin_info")->name("Manager_admin_info");//管理员信息

Route::get("/Manager_admin_info_update","Manager_adminController@admin_info_update")->name("Manager_admin_info_update");//管理员信息的更新

Route::post("/Manager_admin_password_update","Manager_adminController@admin_password_update")->name("Manager_admin_password_update");//管理员密码的更新





Route::post("/Manager_artical_doadd","Manager_articalController@artical_doadd")->name("Manager_artical_doadd");//文章提交添加



Route::post("/Manager_artical_update","Manager_articalController@artical_update")->name("Manager_artical_update");//文章的修改


    
//_______________________运行商主页部分结束______________________________________________________________________________







Route::middleware(['Private'])->group(function(){


    Route::get("/Manager_ad_list","Manager_adController@ad_list")->name('Manager_ad_list');//运行商广告管理

    Route::get("/Manager_ad_start","Manager_adController@ad_start")->name('Manager_ad_start');//运行商广告的开启
    
    Route::get("/Manager_ad_stop","Manager_adController@ad_stop")->name('Manager_ad_stop');//运行商广告的屏蔽
    
    Route::get("/Manager_ad_type","Manager_adController@ad_type")->name('Manager_ad_type');//广告分类页面

    Route::post("/Manager_ad_add_type","Manager_adController@ad_add_type")->name('Manager_ad_add_type');//广告类型的添加

    Route::get("/Manager_ad_type_edit","Manager_adController@ad_type_edit")->name('Manager_ad_type_edit');//广告类型的编辑
    
    Route::post("/Manager_ad_type_update","Manager_adController@ad_type_update")->name('Manager_ad_type_update');//广告类型的修改
    
    Route::get("/Manager_ad_del_type","Manager_adController@ad_del_type")->name('Manager_ad_del_type');//广告类型的删除
    
    Route::post("/Manager_ad_add_group","Manager_adController@ad_add_group")->name('Manager_ad_add_group');//广告分组的添加
    
    Route::post("/Manager_ad_update_group","Manager_adController@ad_update_group")->name('Manager_ad_update_group');//广告分组的修改
    
    Route::post("/Manager_ad_del_group","Manager_adController@ad_del_group")->name('Manager_ad_del_group');//广告分组的删除

    Route::get("/Manager_member_level","Manager_memberController@member_level")->name("Manager_member_level");//会员等级

    Route::get("/Manager_ajax_stop","Manager_memberController@ajax_stop")->name("Manager_ajax_stop");//停用会员
    
    Route::get("/Manager_ajax_start","Manager_memberController@ajax_start")->name("Manager_ajax_start");//开启会员
    
    Route::get("/Manager_ajax_del","Manager_memberController@ajax_del")->name("Manager_ajax_del");//删除会员

    Route::get("/Manager_admin_list","Manager_adminController@admin_list")->name("Manager_admin_list");//管理员列表

    Route::get("/Manager_admin_start","Manager_adminController@admin_start")->name("Manager_admin_start");//管理员开启
    
    Route::get("/Manager_admin_stop","Manager_adminController@admin_stop")->name("Manager_admin_stop");//管理员停用
    
    Route::post("/Manager_admin_add","Manager_adminController@admin_add")->name("Manager_admin_add");//管理员添加
    
    Route::get("/Manager_admin_edit","Manager_adminController@admin_edit")->name("Manager_admin_edit");//管理员编辑

    Route::get("/Manager_admin_del","Manager_adminController@admin_del")->name("Manager_admin_del");//管理员删除

    Route::get("/Manager_admin_power","Manager_adminController@admin_power")->name("Manager_admin_power");//管理员权限
    
    Route::get("/Manager_admin_power_add","Manager_adminController@admin_power_add")->name("Manager_admin_power_add");//管理员权限的添加
    
    Route::get("/Manager_admin_power_edit","Manager_adminController@admin_power_edit")->name("Manager_admin_power_edit");//管理员权限的修改

    Route::get("/Manager_admin_power_del","Manager_adminController@admin_power_del")->name("Manager_admin_power_del");//管理员权限的删除

    Route::get("/Manager_shop_agree","Manager_shopController@shop_agree")->name("Manager_shop_agree");//店铺审核

    Route::get("/Manager_shop_start","Manager_shopController@shop_start")->name("Manager_shop_start");//店铺审核通过

    Route::get("/Manager_shop_stop","Manager_shopController@shop_stop")->name("Manager_shop_stop");//店铺审核驳回

    Route::get("/Manager_shop_del","Manager_shopController@shop_del")->name("Manager_shop_del");//店铺删除
    
    Route::get("/Manager_goods_agree","Manager_goodsController@goods_agree")->name('Manager_goods_agree');//商品审核
    
    Route::get("/Manager_goods_ok","Manager_goodsController@goods_ok")->name('Manager_goods_ok');//商品通过
    
    Route::get("/Manager_goods_no","Manager_goodsController@goods_no")->name('Manager_goods_no');//商品驳回

    Route::get("/Manager_artical_list","Manager_articalController@artical_list")->name("Manager_artical_list");//文章列表

    Route::get("/Manager_artical_add","Manager_articalController@artical_add")->name("Manager_artical_add");//文章添加

    Route::get("/Manager_artical_edit","Manager_articalController@artical_edit")->name("Manager_artical_edit");//文章编辑

    Route::get("/Manager_artical_del","Manager_articalController@artical_del")->name("Manager_artical_del");//文章的删除

    Route::get("/Manager_artical_page","Manager_articalController@artical_page")->name("Manager_artical_page");//文章管理
    
    Route::post("/Manager_artical_type_add","Manager_articalController@artical_type_add")->name("Manager_artical_type_add");//文章分类的添加
    
    Route::post("/Manager_artical_type_update","Manager_articalController@artical_type_update")->name("Manager_artical_type_update");//文章分类的编辑
    
    Route::get("/Manager_artical_type_del","Manager_articalController@artical_type_del")->name("Manager_artical_type_del");//文章分类的删除

});






