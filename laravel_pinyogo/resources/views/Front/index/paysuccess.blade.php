@extends("Front/layouts/footer")
 @section('footer')
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<title>支付页-成功</title>
		<link rel="icon" href="/assets/img/favicon.ico">
	    <link rel="stylesheet" type="text/css" href="css/pages-paysuccess.css" />
    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-paysuccess.css" />
</head>

	<body>
		<!--head-->
		<div class="top">
			<div class="py-container">
				<div class="shortcut">
				<ul class="fl">
					@if(session()->get('id'))
					<li class="f-item">品优购欢迎您！尊敬的用户
						<a href="#" style="font-size:16px;">{{session()->get('user')}}</a>您好！！！</li>
					@else
					<li class="f-item">品优购欢迎您！</li>
					<li class="f-item">请
						<a href="{{ route('Front_login') }}" target="_blank">登录</a>
						<span>
							<a href="{{ route('Front_register') }}" target="_blank">免费注册</a>
						</span>
					</li>
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
				<div class="fl logo"><span class="title">支付页</span></div>
			</div>
			<!--主内容-->
			<div class="paysuccess">
				<div class="success">
					<h3><img src="img/_/right.png" width="48" height="48">　恭喜您，支付成功啦！</h3>
					<div class="paydetail">
					<p>支付方式：{{$pay_style}}</p>
					<p>支付金额：￥{{$price}}元</p>
					<p class="button"><a href="Front_home_index" class="sui-btn btn-xlarge btn-danger">查看订单</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="Front_index" class="sui-btn btn-xlarge ">继续购物</a></p>
				    </div>
				</div>
				
			</div>
		</div>
		<!-- 底部栏位 -->
@endsection('footer')