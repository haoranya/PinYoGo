<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>个人注册</title>


	<link rel="stylesheet" type="text/css" href="css/webbase.css" />
	<link rel="stylesheet" type="text/css" href="css/pages-register.css" />
</head>
<style>
	.red {
		color: red;

		font-size: 12px;
	}

	.skyblue {
		color: skyblue;

		font-size: 12px;
	}
</style>

<body>
	<div class="register py-container ">
		<!--head-->
		<div class="logoArea">
			<a href="" class="logo"></a>
		</div>
		<!--register-->

		<div class="registerArea">
			<h3>注册新用户
				<span class="go">我有账号，去
					<a href="{{route('Front_login')}}" target="_blank">登陆</a>
				</span>
			</h3>
			<div class="info">
				<div class="form-group">

					<div class="form-group">

					</div>

				</div>
				<form class="sui-form form-horizontal" action="{{route('Front_do_register')}}" method="post">
					{{csrf_field()}}
					<div class="control-group">
						<label class="control-label">用户名：</label>
						<div class="controls">
							<input type="text" id="user" name="user" value="{{old('user')}}" placeholder="请输入你的用户名" class="input-xfat input-xlarge"> 
							@if($errors->has('user'))
							<span class="red">{{$errors->first('user')}}</span>
							@endif
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">登录密码：</label>
						<div class="controls">
							<input type="password" name="password" placeholder="设置登录密码" class="input-xfat input-xlarge"> 
							@if($errors->has('password'))
							<span class="red">{{$errors->first('password')}}</span>
							@elseif(session()->get('error_password'))
							<span class="red">{{session()->get('error_password')}}</span>
							@endif
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">确认密码：</label>
						<div class="controls">
							<input type="password" name="password_confirmation" placeholder="再次确认密码" class="input-xfat input-xlarge"> 
							@if($errors->has('password_confirmation'))
							<span class="red">{{$errors->first('password_confirmation')}}</span>
							@elseif(session()->get('error_password_confirmation'))
							<span class="red">{{session()->get('error_password_confirmation')}}</span>
							@endif
						</div>
					</div>
					<div class="block">

							<div class="control-group none">
						<label class="control-label">手机号：</label>
						<div class="controls">
							<input type="text" id="phone" name="phone" value="{{old('phone')}}" placeholder="请输入你的手机号" class="input-xfat input-xlarge"> @if($errors->has('phone'))
							<span class="red">{{$errors->first('phone')}}</span>
							@endif
						</div>
					</div>
					<div class="control-group none">
						<label for="inputPassword" class="control-label">短信验证码：</label>
						<div class="controls">
							<input type="text" name="code" value="{{old('code')}}" placeholder="短信验证码" class="input-xfat input-xlarge">
							<input type="button" id="send_btn" onclick="send_code()" value="发送验证码"> @if($errors->has('code'))
							<span class="red">{{$errors->first('code')}}</span>
							@endif
						</div>
					</div>

					</div>
				
					<div class="control-group ">
						<label for="inputPassword" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls">
							<input name="ml" type="checkbox">
							<span>同意协议并注册《品优购用户协议》</span>
							@if($errors->has('ml'))
							<span class="red">{{$errors->first('ml')}}</span>
							@elseif(session()->get('error_ml'))
							<span class="red">{{session()->get('error_ml')}}</span>
							@endif
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls btn-reg">
							<input type="submit" class="sui-btn btn-block btn-xlarge btn-danger" value="完成注册">
						</div>
					</div>
				</form>
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
	</div>


	<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
	<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
	<script type="text/javascript" src="js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
	<script type="text/javascript" src="js/pages/register.js"></script>
</body>

</html>
<script>

	var url = '{{route('Front_send')}}';

	var time = 60;

	var si;

	function send_code() {

		var phone = $("#phone").val();

		if (phone != '') {

			$.ajax({

				type: "GET",

				url: url,

				data: { 'phone': phone },

				dataType:'json',

				success: function (data) {}

			});

				$("#send_btn").attr('disabled', true);

					si = setInterval(function () {

						time--;

						if (time == 0) {
							$("#send_btn").attr("disabled", false);
							//重置时间
							time = 60;
							//清除即使器
							clearInterval(si);

							$("#send_btn").val("发送验证码");
						} else {
						
							$("#send_btn").val("需等" + time + "秒");

						}

					}, 1000)


		} else {

			alert('请填写手机号');

		}



	};

	var html =`<div class="control-group none">
						<label class="control-label">手机号：</label>
						<div class="controls">
							<input type="text" id="phone" name="phone" value="{{old('phone')}}" placeholder="请输入你的手机号" class="input-xfat input-xlarge"> @if($errors->has('phone'))
							<span class="red">{{$errors->first('phone')}}</span>
							@endif
						</div>
					</div>
					<div class="control-group none">
						<label for="inputPassword" class="control-label">短信验证码：</label>
						<div class="controls">
							<input type="text" name="code" value="{{old('code')}}" placeholder="短信验证码" class="input-xfat input-xlarge">
							<input type="button" id="send" onclick="send_code()" value="发送验证码"> @if($errors->has('code'))
							<span class="red">{{$errors->first('code')}}</span>
							@endif
						</div>
					</div>`;

	$("#user").blur(function(){

		var info = $(this).val();

		if(info!=""){

			//验证邮箱
			var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;

			if(reg.test(info)){

				$(".none").remove();

             }else{

				if ($( ".block:has(div)" ).length==0){
                
					$(".block").append(html);
				}

			 }
		}

	})

	var email = "<?=session()->get('error_email')?>"
	var password = "<?=session()->get('error_password')?>"
	var password_confirmation = "<?=session()->get('error_password_confirmation')?>"
	var ml = "<?=session()->get('error_ml')?>"
	if(email!=''||password!=''||password_confirmation!=''||ml!=''){

		$(".none").remove();

	}


</script>