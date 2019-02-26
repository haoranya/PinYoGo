<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="/css/shop.css" type="text/css" rel="stylesheet" />
    <link href="/css/Sellerber.css" type="text/css" rel="stylesheet" />
    <link href="/css/bkg_ui.css" type="text/css" rel="stylesheet" />
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="/js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
    <script src="/js/shopFrame.js" type="text/javascript"></script>
    <script src="/js/Sellerber.js" type="text/javascript"></script>
    <script src="/js/layer/layer.js" type="text/javascript"></script>
    <script src="/js/laydate/laydate.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/proTree.js"></script>
    <script src="/js/jquery.easy-pie-chart.min.js"></script>
    <title>订单详细</title>
</head>

<body>
    <div class="margin clearfix" id="page_style">
        <div class="Order_Details_style">
            <div class="Numbering">订单编号:
                <b>{{$order->order}}</b>
            </div>
        </div>
        <div class="detailed_style">
            <!--收件人信息-->
            <div class="Receiver_style">
                <div class="title_name">收件人信息</div>
                <div class="Info_style clearfix padding15">
                    <div class="col-xs-3">
                        <label class="label_name" for="form-field-2"> 收件人姓名： </label>
                        <div class="o_content">{{$address->name}}</div>
                    </div>
                    <div class="col-xs-3">
                        <label class="label_name" for="form-field-2"> 收件人电话： </label>
                        <div class="o_content">{{$address->phone}}</div>
                    </div>
                    <div class="col-xs-3">
                        <label class="label_name" for="form-field-2"> 收件地邮编： </label>
                        <div class="o_content">{{$address->zip_code}}</div>
                    </div>
                    <div class="col-xs-3">
                        <label class="label_name" for="form-field-2"> 收件地址： </label>
                        <div class="o_content">{{$address->province}},{{$address->city}},{{$address->county}},{{$address->address_name}}</div>
                    </div>
                    <div class="col-xs-12">
                        <label class="label_name" for="form-field-2">备注说明： </label>
                        <div class="o_content">{{$order->order_desc}}</div>
                    </div>
                </div>
            </div>
            <!--订单信息-->
            <div class="product_style">
                <div class="title_name">产品信息</div>
                <div class="Info_style clearfix">

                    <?php for($i = 1;$i<=$order->order_num;$i++){?>
                    <div class="product_info clearfix">
                        <a href="#" class="img_link">
                            <img src="{{Storage::url($goods_image->logo)}}" />
                        </a>
                        <span>
                            <a href="#" class="name_link">{{$goods->desc}}</a><br>
                            <b>{{$goods->goods_name}}</b>
                            @foreach($spec_arr as $spec)
                            <p>{{$spec['attr_name']}}：{{$spec['spec']}}</p>
                            @endforeach
                            <p>价格：
                                <b class="price">
                                    <i>￥</i>{{$goods->price}}</b>
                            </p>
                            <p>状态：
                                <i class="label label-success radius">有货</i>
                            </p>
                        </span>
                    </div>
                    <?php }?>

                </div>
            </div>
            <!--总价-->
            <div class="Total_style">
                <div class="Info_style clearfix">
                    <div class="col-xs-3">
                        <label class="label_name" for="form-field-2"> 支付方式： </label>
                        <div class="o_content">在线支付</div>
                    </div>
                    <div class="col-xs-3">
                        <label class="label_name" for="form-field-2"> 支付状态： </label>
                        <div class="o_content">{{$order_info->buyer_state}}</div>
                    </div>
                    <div class="col-xs-3">
                        <label class="label_name" for="form-field-2"> 订单生成日期： </label>
                        <div class="o_content">{{$order_info->created_at}}</div>
                    </div>
                    <div class="col-xs-3">
                        <label class="label_name" for="form-field-2"> 快递名称： </label>
                        <div class="o_content">{{$order_info->express}}</div>
                    </div>
                    <div class="col-xs-3">
                        <label class="label_name" for="form-field-2"> 发货日期： </label>
                        <div class="o_content">{{$order_info->updated_at}}</div>
                    </div>
                    <div class="col-xs-3">
                        <label class="label_name" for="form-field-2"> 快递单号： </label>
                        <div class="o_content">{{$order_info->express_number}}</div>
                    </div>
                </div>
                <div class="Total_m_style">
                    <span class="Total">总数：
                        <b>{{$order->order_num}}</b>
                    </span>
                    <span class="Total_price">总价：
                        <b>{{$order->order_num*$goods->price}}</b>元</span> 
                </div>
            </div>

            <!--物流信息-->
            <div class="Logistics_style clearfix">
                <div class="title_name">物流信息</div>
                <!--<div class="prompt"><img src="images/meiyou.png" /><p>暂无物流信息！</p></div>-->
                <div data-mohe-type="kuaidi_new" class="g-mohe " id="mohe-kuaidi_new">
                    <div id="mohe-kuaidi_new_nucom">
                        <div class="mohe-wrap mh-wrap">
                            <div class="mh-cont mh-list-wrap mh-unfold">
                                <div class="mh-list">
                                    <ul>
                                        <li class="first">
                                            <p>2015-04-28 11:23:28</p>
                                            <p>妥投投递并签收，签收人：他人收 他人收</p>
                                            <span class="before"></span>
                                            <span class="after"></span>
                                            <i class="mh-icon mh-icon-new"></i>
                                        </li>
                                        <li>
                                            <p>2015-04-28 07:38:44</p>
                                            <p>深圳市南油速递营销部安排投递（投递员姓名：蔡远发
                                                <a href="tel:18718860573">18718860573</a>;联系电话：）</p>
                                            <span class="before"></span>
                                            <span class="after"></span>
                                        </li>
                                        <li>
                                            <p>2015-04-28 05:08:00</p>
                                            <p>到达广东省邮政速递物流有限公司深圳航空邮件处理中心处理中心（经转）</p>
                                            <span class="before"></span>
                                            <span class="after"></span>
                                        </li>
                                        <li>
                                            <p>2015-04-28 00:00:00</p>
                                            <p>离开中山市 发往深圳市（经转）</p>
                                            <span class="before"></span>
                                            <span class="after"></span>
                                        </li>
                                        <li>
                                            <p>2015-04-27 15:00:00</p>
                                            <p>到达广东省邮政速递物流有限公司中山三角邮件处理中心处理中心（经转）</p>
                                            <span class="before"></span>
                                            <span class="after"></span>
                                        </li>
                                        <li>
                                            <p>2015-04-27 08:46:00</p>
                                            <p>离开泉州市 发往中山市</p>
                                            <span class="before"></span>
                                            <span class="after"></span>
                                        </li>
                                        <li>
                                            <p>2015-04-26 17:12:00</p>
                                            <p>泉州市速递物流分公司南区电子商务业务部已收件，（揽投员姓名：王晨光;联系电话：
                                                <a href="tel:13774826403">13774826403</a>）</p>
                                            <span class="before"></span>
                                            <span class="after"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Button_operation">
                <a href="Admin_order_page" class="btn button_btn bg-deep-blue margin-top" type="submit">返回上一步</a>
                   

                <button onclick="layer_close();" class="btn btn-default button_btn" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>


        </div>
    </div>
</body>

</html>
<script>
    /*******滚动条*******/
    $("body").niceScroll({
        cursorcolor: "#888888",
        cursoropacitymax: 1,
        touchbehavior: false,
        cursorwidth: "5px",
        cursorborder: "0",
        cursorborderradius: "5px"
    });
</script>