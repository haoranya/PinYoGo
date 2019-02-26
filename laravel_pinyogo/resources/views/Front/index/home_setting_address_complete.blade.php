@extends("Front/layouts/footer")
 @section('footer')
  @extends("Front/layouts/head")
	 @section('head')
	 @endsection('head')
<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/widget/nav.js"></script>
</body>
    <!--header-->
    <div id="account">
        <div class="py-container">
            <div class="yui3-g home">
                <!--左侧列表-->
                <div class="yui3-u-1-6 list">

                    <div class="person-info">
                        <div class="person-photo"><img src="img/_/photo.png" alt=""></div>
                        <div class="person-account">
                            <span class="name">Michelle</span>
                            <span class="safe">账户安全</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="list-items">
					<dl>
							<dt><i>·</i> 订单中心</dt>
							<dd ><a href="{{ route('Front_home_index') }}"   >我的订单</a></dd>
							<dd><a href="{{ route('Front_home_order_pay') }}" >待付款</a></dd>
							<dd><a href="{{ route('Front_home_order_send') }}"  >待发货</a></dd>
							<dd><a href="{{ route('Front_home_order_receive') }}" >待收货</a></dd>
							<dd><a href="{{ route('Front_home_order_evaluate') }}"  class="list-active">待评价</a></dd>
						</dl>
						<dl>
							<dt><i>·</i> 我的中心</dt>
							<dd><a href="{{ route('Front_home_person_collect') }}">我的收藏</a></dd>
							<dd><a href="{{ route('Front_home_person_footmark') }}">我的足迹</a></dd>
						</dl>
						<dl>
							<dt><i>·</i> 物流消息</dt>
						</dl>
						<dl>
						<dt><i>·</i> 设置</dt>
							<dd><a href="{{ route('Front_home_setting_info') }}">个人信息</a></dd>
							<dd><a href="{{ route('Front_home_setting_address') }}"  >地址管理</a></dd>
							<dd><a href="{{ route('Front_home_setting_safe') }}" >安全管理</a></dd>
						</dl>
                    </div>
                </div>
                <!--右侧主内容-->
                <div class="yui3-u-5-6">
                    <div class="body userSafe">
                        <ul class="sui-nav nav-tabs nav-large nav-primary ">
                            <li><a href="#one" data-toggle="tab">密码设置</a></li>
                            <li class="active"><a href="#two" data-toggle="tab">绑定手机</a></li>
                        </ul>
                        <div class="tab-content ">
                            <div id="one" class="tab-pane">
                                <form class="sui-form form-horizontal sui-validate" id="jsForm">
                                    <div class="control-group">
                                        <label for="inputusername" class="control-label">用户名：</label>
                                        <div class="controls">
                                            <input id="pwdid" class="fn-tinput" data-rule-remote="http://www.baidu.com" type="password" name="OldPassword" placeholder="输入昵称"
                                                required data-msg-required="请输入昵称" minlength="6" data-msg-minlength="至少输入6个字符"
                                            />

                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">密码：</label>
                                        <div class="controls">
                                            <input class="fn-tinput" type="password" name="password" value="" placeholder="新密码" required id="password" data-rule-remote="php.php">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputRepassword" class="control-label">重复密码：</label>
                                        <div class="controls">
                                            <input class="fn-tinput" type="password" name="confirm_password" value="" placeholder="确认新密码" required equalTo="#password">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">
                                            <button type="submit" class="sui-btn btn-primary">提交按钮</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="two" class="tab-pane active">
                                <!--步骤条-->
                                <div class="sui-steps steps-auto">
                                    <div class="wrap">
                                        <div class="finished">
                                        <label><span class="round"><i class="sui-icon icon-pc-right"></i></span><span>第一步 验证身份</span></label><i class="triangle-right-bg"></i><i class="triangle-right"></i>
                                        </div>
                                    </div>
                                    <div class="wrap">
                                        <div class="finished">
                                        <label><span class="round"><i class="sui-icon icon-pc-right"></i></span><span>第二步 绑定新手机号</span></label><i class="triangle-right-bg"></i><i class="triangle-right"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="wrap">
                                        <div class="todo">
                                        <label><span class="round">3</span><span>第三步 完成</span></label>
                                        </div>
                                    </div>
                                </div>
                                <!--完成-->
                                <div class="overed">
                                    <div class="content">
                                         <div class="img">
                                             <img src="img/_/right.png" alt="">
                                        </div>
                                        <div class="text">
                                            <p class="success">恭喜你，新手机绑定成功！</p>
                                            <p class="back"><a href="home-setting-safe.html">返回首页</a></p>
                                        </div>
                                    </div>
                                   
                                    
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部栏位 -->
@endsection('footer')