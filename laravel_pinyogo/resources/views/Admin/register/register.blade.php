<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>商家入驻申请</title>
    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-register.css" />
</head>

<body>
	<div class="register py-container ">
		<!--head-->
		<div class="logoArea">
			<a href="" class="logo"></a>
		</div>
		<!--register-->
		<div class="registerArea">
			<h3>商家入驻申请<span class="go">我有账号，去<a href="{{route('Admin_login')}}" target="_blank">登陆</a></span></h3>
			<div class="info">
				<form class="sui-form form-horizontal" action="route('Admin_do_register')" method="post">
				
					<div class="control-group">
						<label class="control-label">登陆名（不可修改）：</label>
						<div class="controls">
							<input type="text" placeholder="登陆名" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">登陆密码：</label>
						<div class="controls">
							<input type="password" placeholder="登陆密码" class="input-xfat input-xlarge">
						</div>
					</div>
				
					<div class="control-group">
						<label class="control-label">店铺名称：</label>
						<div class="controls">
							<input type="text" placeholder="店铺名称" class="input-xfat input-xlarge">
						</div>
					</div>
				
					<div class="control-group">
						<label class="control-label">公司名称：</label>
						<div class="controls">
							<input type="text" placeholder="公司名称" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">公司电话：</label>
						<div class="controls">
							<input type="text" placeholder="公司电话" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">公司详细地址：</label>
						<div class="controls">
							<input type="text" placeholder="公司详细地址" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">联系人姓名：</label>
						<div class="controls">
							<input type="text" placeholder="联系人姓名" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">联系人QQ：</label>
						<div class="controls">
							<input type="text" placeholder="联系人QQ" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">联系人手机：</label>
						<div class="controls">
							<input type="text" placeholder="联系人手机" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">联系人EMAIL：</label>
						<div class="controls">
							<input type="text" placeholder="联系人EMAIL" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">营业执照号：</label>
						<div class="controls">
							<input type="text" placeholder="营业执照号" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">税务登记证号：</label>
						<div class="controls">
							<input type="text" placeholder="税务登记证号" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">组织机构代码证：</label>
						<div class="controls">
							<input type="text" placeholder="组织机构代码证" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">法定代表人：</label>
						<div class="controls">
							<input type="text" placeholder="法定代表人" class="input-xfat input-xlarge">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">法定代表人身份证号：</label>
						<div class="controls">
							<input type="text" placeholder="法定代表人身份证号" class="input-xfat input-xlarge">
						</div>
					</div>	

					<div class="control-group">
						<label class="control-label">开户行名称：</label>
						<div class="controls">
							<input type="text" placeholder="开户行名称" class="input-xfat input-xlarge">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">开户行支行：</label>
						<div class="controls">
							<input type="text" placeholder="开户行支行" class="input-xfat input-xlarge">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">银行账号：</label>
						<div class="controls">
							<input type="text" placeholder="银行账号" class="input-xfat input-xlarge">
						</div>
					</div>					
					
					<div class="control-group">
						<label for="inputPassword" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls">
							<input name="m1" type="checkbox" value="2" checked=""><span>同意协议并注册  <a href="sampling.html">《品优购商家入驻协议》</a></span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls btn-reg">
							<a class="sui-btn btn-block btn-xlarge btn-danger" href="home.html" target="_blank">申请入驻</a>
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