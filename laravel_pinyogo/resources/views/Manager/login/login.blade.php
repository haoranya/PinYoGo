<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>品优购运营商运营管理后台</title>
	 <link rel="icon" href="../assets/img/favicon.ico">


    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-login-manage.css" />
</head>

<body>
	<div class="loginmanage">
		<div class="py-container">
			<h4 class="manage-title">品优购运营商运营管理后台</h4>
			<div class="loginform">

				<ul class="sui-nav nav-tabs tab-wraped">
					<li>
						<a href="#index" data-toggle="tab">
							<h3>扫描登录</h3>
						</a>
					</li>
					<li class="active">
						<a href="#profile" data-toggle="tab">
							<h3>账户登录</h3>
						</a>
					</li>
				</ul>
				<div class="tab-content tab-wraped">
					<div id="index" class="tab-pane">
						<p>二维码登录，暂为官网二维码</p>
						<img src="../img/wx_cz.jpg" />
					</div>
					<div id="profile" class="tab-pane  active">
						<form class="sui-form" action="Manager_dologin" id="form">
							<div class="input-prepend"><span class="add-on loginname"></span>
								<input id="prependedInput" name="manager" type="text" placeholder="邮箱/用户名/手机号" class="span2 input-xfat">
							</div>
							@if($errors->has('manager'))
							<p style="color:red">{{$errors->first('manager')}}</p>
							@endif
							<div class="input-prepend"><span class="add-on loginpwd"></span>
								<input id="prependedInput" name="password" type="password" placeholder="请输入密码" class="span2 input-xfat">
							</div>
							@if($errors->has('password'))
							<p style="color:red">{{$errors->first('password')}}</p>
							@elseif(session()->get('error_login'))
							<p style="color:red">{{session()->get('error_login')}}</p>
							@endif
							<div class="setting">
								 <div id="slider">
									<div id="slider_bg"></div>
									<span id="label">>></span> <span id="labelTip">拖动滑块验证</span>
									</div>
							</div>
							<div class="logined">
								<input type="button" onclick="hit()" class="sui-btn btn-block btn-xlarge btn-danger" value="登&nbsp;&nbsp;录" >
							</div>
						</form>

					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>


	<!--foot-->
	<div class="py-container copyright">
		<ul>
			<li>关于我们</li>
			<li>联系我们</li>
			<li>联系客服</li>
			<li>商家入驻</li>
			<li>营销中心</li>
			<li>手机品优购</li>
			<li>销售联盟</li>
			<li>品优购社区</li>
		</ul>
		<div class="address">地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</div>
		<div class="beian">京ICP备08001421号京公网安备110108007702
		</div>
	</div>


<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script src="js/pages/jquery.slideunlock.js"></script>
<script>
	$(function(){

		state = false;

		var slider = new SliderUnlock("#slider",{
				successLabelTip : "欢迎访问品优购"	
			},function(){
				// alert("验证成功,即将跳转至首页");
            	// window.location.href="{{ route('Manager_index') }}"

				 state = true;

        	});
        slider.init();

		
	})

		function hit(){

			if(state==false){

				alert('请进行滑块验证');

			}else{

				$("#form").submit();

			}

		}
	</script>
</body>

</html>