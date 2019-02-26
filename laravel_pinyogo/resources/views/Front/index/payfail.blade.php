@extends("Front/layouts/footer")
 @section('footer')
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<title>支付页-失败</title>
		<link rel="icon" href="/assets/img/favicon.ico">
		
	
    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-payfail.css" />
</head>

	<body>
		<!--head-->
		<div class="top">
			<div class="py-container">
				<div class="shortcut">
					<ul class="fl">
						<li class="f-item">品优购欢迎您！</li>
						<li class="f-item">请登录　<span><a href="#">免费注册</a></span></li>
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
			<div class="payfail">
				<div class="fail">
					<h3><img src="img/_/fail.png" width="48" height="48">　支付失败，请稍后再试</h3>
					<div class="fail-text">
					<p>失败原因：不能使用金币购买！</p>
					<p>您可以先去　<a href="index.html" target="_blank">品优购首页</a>　逛逛</p>
					<p class="button"><a href="" class="sui-btn btn-xlarge btn-danger">重新支付</a></p>
				    </div>
				</div>
				
			</div>
		</div>
		<!-- 底部栏位 -->
@endsection('footer')