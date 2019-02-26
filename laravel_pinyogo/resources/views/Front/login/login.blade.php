<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>品优购，欢迎登录</title>

	<link rel="stylesheet" type="text/css" href="css/webbase.css" />
	<link rel="stylesheet" type="text/css" href="css/pages-login.css" />
</head>
<style>

	.red{
		color:red;

		font-size:12px;
	}

	.skyblue{
		color:skyblue;

		font-size:12px;
	}

	.code_again{

		width: 330px;

		height: 370px;
		
		background-color: rgba(23,45,36,0.9);
		
		position: absolute;

		z-index: 1;

		margin: 0px auto;
		
		top:0px;

		display:none;

	}

	#phone,#code,#send{

		margin-top:25px;

	}

</style>
<body>
	<div class="login-box">
		<!--head-->
		<div class="py-container logoArea">
			<a href="" class="logo"></a>
		</div>
		<!--loginArea-->
		<div class="loginArea">
			<div class="py-container login">
				<div class="loginform">
				<div class="code_again loginform">

				<form action="{{route('Front_safe_login')}}" method="post">
				   <div class="box">
					 {{csrf_field()}}
					<input type="hidden" name="ip"  value="<?=$ip?>">
					<input type="hidden" name="browser"  value="<?=$browser?>">
					<input type="hidden" name="country"  value="<?=$country?>">
					<input type="hidden" name="city"  value="<?=$city?>">
					<input type="hidden" name="shebei"  value="<?=$shebei?>">
					<input type="hidden" name="user_id"  value="<?=$user_id?>">
					<input type="hidden" name="user_name"  value="<?=$user_name?>">
					<p style="font-size:20px;color:skyblue">输入你的手机号:<input id="phone" type="text" name="phone" value="{{old('phone')}}" placeholder="手机号"></p>
					@if($errors->has('phone'))
						<p class="red">{{$errors->first('phone')}}</p>
					    @elseif(session()->get('error_phone'))
						<p class="red">{{session()->get('error_phone')}}</p>									
					@endif
				
					<p style="font-size:20px;color:skyblue">点击发送验证码:<input id="send" type="button" class="sui-btn btn-block btn-xlarge btn-success" style="width:220px;" value="发送"></input></p>
					<p style="font-size:20px;color:skyblue">输入你的验证码:<input id="code" type="text" name="code" placeholder="验证码"></p>
					@if($errors->has('code'))
						<p class="red">{{$errors->first('code')}}</p>
					@endif
					<div class="logined">
						<input type="submit" class="sui-btn btn-block btn-xlarge btn-danger" value="安全登录" style="width:340px;"></input>
					</div>

				</div>
			</form>

				</div>
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
							<img src="img/wx_cz.jpg" />
						</div>
						<div id="profile" class="tab-pane  active">
							<form class="sui-form" action="{{ route('Front_do_login') }}" method="post">
								{{csrf_field()}}
								<div class="input-prepend">
									<span class="add-on loginname"></span>
									<input id="prependedInput" type="text" name="user" value="{{old('user')}}" placeholder="邮箱/用户名/手机号" class="span2 input-xfat">
									@if($errors->has('user'))
									<p class="red">{{$errors->first('user')}}</p>
									@elseif(session()->get('error_user'))
									<p class="red">{{session()->get('error_user')}}</p>		
									@endif
								</div>
								<div class="input-prepend">
									<span class="add-on loginpwd"></span>
									<input id="prependedInput" type="password" name="password" value="{{old('password')}}" placeholder="请输入密码" class="span2 input-xfat">
									@if($errors->has('password'))
									<p class="red">{{$errors->first('password')}}</p>
									@elseif(session()->get('error_password'))
									<p class="red">{{session()->get('error_password')}}</p>									
									@endif
								</div>

								<div class="input-prepend" style="width:345px;">
									<span class="add-on loginpwd" style="float:left"></span>
									<input id="prependedInput" type="text" name="code" placeholder="验证码" class="input-xfat" style="width:100px;float:left">
									<img id="recode" src="{{ route('Front_qrcode') }}" style="margin:0;float:left;height:36px;">
									<input type="button"style="float:left;height:36px;" onclick="document.getElementById('recode').src='{{ route('Front_qrcode') }}?'+Math.random()" value="换">
									
								</div>

								    @if($errors->has('code'))
									<p style="overflow:hidden;" class="red">{{$errors->first('code')}}</p>
									@elseif(session()->get('error_code'))
									<p class="red">{{session()->get('error_code')}}</p>									
									@endif

								

								<div class="setting">
									<label class="checkbox inline">
										<input type="checkbox" value="true" name="remember"> 自动登录
									</label>
									<span class="forget">忘记密码？</span>
								</div>
								<div class="logined">
									<input type="submit" class="sui-btn btn-block btn-xlarge btn-danger" value="登录"></input>
								</div>
							</form>
							<div class="otherlogin">
								<div class="types">
									<ul>
										<li>
											<img src="img/qq.png" width="35px" height="35px" />
										</li>
										<li>
											<img src="img/sina.png" />
										</li>
										<li>
											<img src="img/ali.png" />
										</li>
										<li>
											<img src="img/weixin.png" />
										</li>
									</ul>
								</div>
								<span class="register">
									<a href="{{route('Front_register')}}" target="_blank">立即注册</a>
								</span>
							</div>
						</div>
					</div>
				</div>
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
	</div>

	<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
	<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
	<script type="text/javascript" src="js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
	<script type="text/javascript" src="js/pages/login.js"></script>
</body>

</html>

<script>

	var ip_info = <?=$bool?>;

	if(ip_info==true){

		if(confirm("由于你IP地址改变了,为了账户的安全请进行严格的验证")){

			$(".code_again").css('display','block');

		}else{

			location.href('/Front_login');

		}
	}

	var url = '{{route('Front_send')}}';

	var oldphone = '{{$phone}}';

	var time = 60;

	var si;

	$("#send").click(function(){

		var phone = $('#phone').val();

	if(oldphone=='null'||oldphone==phone){

			$.ajax({

			   type:"GET",

			   url:url,

			   data:{'phone':phone},

			   success:function(data){

			   $("#send").attr('disabled',true);

			   si = setInterval(function(){

			   time--;
					
				if(time==0){                    
                    $("#send").attr("disabled",false);
                    //重置时间
                    time = 60;
                    //清除即使器
                    clearInterval(si);
                    
                    $("#send").val("发送");                    
				}else{

					$("#send").val("需等"+time+"秒");

					}

				},1000)

			}
		})

	}else{

		alert('请输入你注册时绑定的手机号');

	}



	})


</script>