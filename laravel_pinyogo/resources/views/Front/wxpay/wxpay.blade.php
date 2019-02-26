@extends("Front/layouts/footer")
 @section('footer')
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<title>微信支付页</title>
        <link rel="icon" href="/assets/img/favicon.ico">
		
	
    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-weixinpay.css" />
</head>

	<body>
		<!--head-->
		<div class="top">
			<div class="py-container">
				<div class="shortcut">
				<ul class="fl">
						@if(session()->get('id'))
						<li class="f-item">品优购欢迎您！尊敬的用户<a href="#" style="font-size:16px;">{{session()->get('user')}}</a>您好！！！</li>
						@else
						<li class="f-item">品优购欢迎您！</li>
						<li class="f-item">请<a href="{{ route('Front_login') }}" target="_blank">登录</a>　<span><a href="{{ route('Front_register') }}" target="_blank">免费注册</a></span></li>
						@endif
					</ul>
					<ul class="fr">
						<li class="f-item">我的订单</li>
						<li class="f-item space"></li>
						<li class="f-item">我的品优购</li>
						<li class="f-item space"></li>
						<li class="f-item">品优购会员</li>
						<li class="f-item space"></li>
						<li class="f-item">企业采购</li>
						<li class="f-item space"></li>
						<li class="f-item">关注品优购</li>
						<li class="f-item space"></li>
						<li class="f-item">客户服务</li>
						<li class="f-item space"></li>
						<li class="f-item">网站导航</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="cart py-container">
			<!--logoArea-->
			<div class="logoArea">
				<div class="fl logo"><span class="title">收银台</span></div>

			</div>
			<!--主内容-->
			<div class="checkout py-container  pay">
				<div class="checkout-tit">
					<h4 class="fl tit-txt"><span class="success-icon"></span><span  class="success-info">请您及时付款！订单号：{{$sn}}</span></h4>
                    <span class="fr"><em class="sui-lead">应付金额：</em><em  class="orange money">￥{{$price}}</em>元</span>
					<div class="clearfix"></div>
				</div>				
				<div class="checkout-steps">
					<div class="fl weixin">微信支付</div>
                    <div class="fl sao">                    
                        <div class="fl code">
                        <img src="qrcode?code={{$code}}" alt="">
                            <div class="saosao">
                                <p>请使用微信扫一扫</p>
                                <p>扫描二维码支付</p>
                            </div>
                        </div>
                        <div class="fl phone">
                            
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
				    <p><a href="pay.html" target="_blank">> 其他支付方式</a></p>
				</div>
			</div>

		</div>
		<!-- 底部栏位 -->
<script>

     var order_id = "{{$order_id}}";



    function check(){

    $.ajax({
        type:"GET",
        url:"Front_order_info?order_id="+order_id,
        success:function(data){

            if(data==1){

                alert("支付成功");

                window.close();

               location.href="Front_paysuccess?pay_style='微信支付'&price={{$price}}";

            }else{

                setTimeout(check,1000);

            }

        }


    })


    }

    setTimeout(check,1000);

</script>
@endsection('footer')