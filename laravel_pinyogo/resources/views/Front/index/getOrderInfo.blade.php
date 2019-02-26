@extends('Front/layouts/footer') @section('footer')
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>结算页</title>
	<script type="text/javascript" src="/js/plugins/jquery/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/webbase.css" />
	<link rel="stylesheet" type="text/css" href="css/pages-getOrderInfo.css" />
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
			<div class="fl logo">
				<span class="title">结算页</span>
			</div>
			<div class="fr search">
				<form class="sui-form form-inline">
					<div class="input-append">
						<input type="text" type="text" class="input-error input-xxlarge" placeholder="品优购自营" />
						<button class="sui-btn btn-xlarge btn-danger" type="button">搜索</button>
					</div>
				</form>
			</div>
		</div>
		<!--主内容-->
		<div class="checkout py-container">
			<div class="checkout-tit">
				<h4 class="tit-txt">填写并核对订单信息</h4>
			</div>
			<div class="checkout-steps">
				<!--收件人信息-->
				<div class="step-tit">
					<h5>收件人信息
						<span>
							<a data-toggle="modal" data-target=".edit" data-keyboard="false" class="newadd">新增收货地址</a>
						</span>
					</h5>
				</div>
				<div class="step-cont">
					<div class="addressInfo">
						<ul class="addr-detail">
							<li class="addr-item">
							 @foreach($address as $k=>$addr)
								<div>
									<div class="con name <?php if($addr->address_state=='默认') echo 'selected';?>">
										<a href="javascript:;">{{$addr->name}}
											<span title="点击取消选择">&nbsp;</a>
									</div>
									<div class="con address">{{$addr->name}} {{$addr->province}}{{$addr->city}}{{$addr->county}} {{$addr->address_name}}
										<span>{{$addr->phone}}</span>
										@if($addr->address_state=='非默认')
										<span class="base" onclick="set({{$addr->id}})">默认地址</span>
										@endif
										<span class="edittext">
											<a href="Front_edit_address?id={{$addr->id}}">编辑</a>&nbsp;&nbsp;
											<a href="Front_del_address?id={{$addr->id}}&home='false'">删除</a>
										</span>
									</div>
									<div class="clearfix"></div>
								</div>
							 @endforeach
							</li>


						</ul>
						<!--添加地址-->
						<div tabindex="-1" role="dialog" data-hasfoot="false" class="sui-modal hide fade edit">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close">×</button>
										<h4 id="myModalLabel" class="modal-title">添加收货地址</h4>
									</div>
									<div class="modal-body">
										<form action="{{route('Front_add_address')}}" method="post" class="sui-form form-horizontal">
											{{csrf_field()}}
											<div class="control-group">
												<label class="control-label">收货人：</label>
												<div class="controls">
													<input type="text" name="name" class="input-medium">
													@if($errors->has('name'))
													<span style="color:red;">{{$errors->first('name')}}</span>
													@endif
												</div>
											</div>

											<div class="control-group">
												<label class="control-label">联系电话：</label>
												<div class="controls">
													<input type="text" name="phone" class="input-medium">
													@if($errors->has('phone'))
													<span style="color:red;">{{$errors->first('phone')}}</span>
													@endif
												</div>
											</div>

											<div class="control-group">
												<label class="control-label">邮政编码：</label>
												<div class="controls">
													<input type="text" name="zip_code" class="input-medium">
													@if($errors->has('zip_code'))
													<span style="color:red;">{{$errors->first('zip_code')}}</span>
													@endif
												</div>
											</div>


											<div class="control-group">
												<label class="control-label">选择所在的地区</label>
												<div class="controls">
													<select name="province" id="edit_province">
														<option value="">请选择</option>
														@foreach($city as $province)
														<option value="{{$province->id}}">{{$province->name}}</option>
														@endforeach
													</select>

													<select name="city" id="edit_city">

													</select>

													<select name="county" id="edit_county">

													</select>
													@if($errors->has('province'))
													<span style="color:red;">{{$errors->first('province')}}</span>
													@elseif($errors->has('city'))
													<span style="color:red;">{{$errors->first('city')}}</span>
													@elseif($errors->has('county'))
													<span style="color:red;">{{$errors->first('county')}}</span>
													@endif
												</div>
											</div>

											<div class="control-group">
												<label class="control-label">详细地址：</label>
												<div class="controls">
													<input type="text" name="address_name" class="input-large">
													@if($errors->has('address_name'))
													<span style="color:red;">{{$errors->first('address_name')}}</span>
													@endif
												</div>
											</div>

									</div>

									<div class="modal-footer">
									<button type="submit" class="sui-btn btn-primary btn-large">确定</button>
									<button type="button" data-dismiss="modal" class="sui-btn btn-default btn-large">取消</button>
								   </div>

									</form>
								</div>
								
							</div>
						</div>
					</div>
					<!--确认地址-->
				</div>
				<div class="hr"></div>
<form action="Front_pay" method="post">
			{{csrf_field()}}
			</div>
			<div class="hr"></div>
			<!--支付和送货-->
			<div class="payshipInfo">
				<div class="step-tit">
					<h5>支付方式</h5>
				</div>
				<div class="step-cont">
					<ul class="payType">
						<li class="selected">微信付款
							<span title="点击取消选择"></span>
						</li>
						<!-- <li>货到付款
							<span title="点击取消选择"></span>
						</li> -->
					</ul>
				</div>
				<div class="hr"></div>
				<div class="step-tit">
					<h5>送货清单</h5>
				</div>
				<div class="step-cont">

					<ul class="send-detail">
					@foreach($car_info_arr as $car_info)
					<p>订单要求:</p>
					<input type="text" name="order_desc{{$car_info->id}}" value="">
					<input type="hidden" name="car_id[]" value="{{$car_info->id}}">
					<li>
							<div class="sendGoods">

								<ul class="yui3-g">
									<li class="yui3-u-1-6">
										<span>
											<img src="{{Storage::url($car_info->goods_img)}}" />
										</span> 	
									</li>
									<li class="yui3-u-7-12">
										<div class="desc">{{$car_info->goods_name}} {{$car_info->info}}</div>
										<div class="seven">7天无理由退货</div>
									</li>
									<li class="yui3-u-1-12">
										<div class="price">￥{{$car_info->price}}</div>
									</li>
									<li class="yui3-u-1-12">
										<div class="num">X{{$car_info->number}}</div>
									</li>
									<li class="yui3-u-1-12">
										@if($car_info->number<$car_info->all_number)
										<div class="exit">有货</div>
										@else
										<div class="exit">货源不够最多购买{{$car_info->all_number}}</div>
										@endif
									</li>
								</ul>
							</div>
						</li>
					@endforeach
					</ul>
				</div>
				<div class="hr"></div>
			</div>
			<div class="linkInfo">
				<div class="step-tit">
					<h5>发票信息</h5>
				</div>
				<div class="step-cont">
					<span>普通发票（电子）</span>
					<span>个人</span>
					<span>明细</span>
				</div>
			</div>
			<div class="cardInfo">
				<div class="step-tit">
					<h5>使用优惠/抵用</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="order-summary">
		<div class="static fr">
			<div class="list">
				<span>
					<i class="number"><?php  $num = 0; foreach($car_info_arr as $car){  $num+=$car->number;  } echo $num;  ?></i>件商品，总商品金额</span>
				<em class="allprice">¥<?php  $price = 0; foreach($car_info_arr as $car){  $price+=($car->number*$car->price);  } echo $price;  ?></em>
			</div>
			<div class="list">
				<span>返现：</span>
				<em class="money">0.00</em>
			</div>
			<div class="list">
				<span>运费：</span>
				<em class="transport">0.00</em>
			</div>
		</div>
	</div>

	<div class="clearfix trade">
		<div class="fc-price">应付金额:
			<span class="price">¥<?php  $price = 0; foreach($car_info_arr as $car){  $price+=($car->number*$car->price);  } echo $price;  ?></span>
		</div>
		<div class="fc-receiverInfo">寄送至:{{$now_address->province}}{{$now_address->city}}{{$now_address->county}} {{$now_address->address_name}} 收货人：{{$now_address->name}} {{$now_address->phone}}</div>
	</div>
	<div class="submit">
		<input type="submit" class="sui-btn btn-danger btn-xlarge" value="提交订单">
	</div>
	</form>
	</div>

	<!-- 底部栏位 -->
	<script>
	    //新增
		$("#province").change(function () {

			var parent_id = $(this).val();

			var url = "{{route('Front_get_city')}}";

			if (parent_id != '') {

				$.ajax({

					type: 'GET',

					url: url,

					data: { 'parent_id': parent_id },

					dataType: 'json',

					success: function (data) {

						console.log(data);

						var html = '';

						for (var i = 0; i < data.length; i++) {

							html += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";

						}

						$("#city").html('');

						$("#county").html('');

						$("#city").append(html);



					}

				})

			} else {

				$("#city").html('');

				$("#county").html('');
			}

		})

		$("#city").change(function () {

			var parent_id = $(this).val();

			var url = "{{route('Front_get_city')}}";

			$.ajax({

				type: 'GET',

				url: url,

				data: { 'parent_id': parent_id },

				dataType: 'json',

				success: function (date) {

					var html = '';

					for (var i = 0; i < date.length; i++) {

						html += "<option value='" + date[i].id + "'>" + date[i].name + "</option>";

					}

					$("#county").html('');

					$("#county").append(html);

				}
			})

		})

		function set(id){

			var url = "{{route('Front_set_address')}}";

			$.ajax({

				type:'GET',
				url:url,
				data:{'id':id,'home':false},
				dataType:'json',
				success:function(data){

					if(data==1){

						location.reload();

					}

				}

			})

		}



		//修改

		$("#edit_province").change(function () {

			var parent_id = $(this).val();

			var url = "{{route('Front_get_city')}}";

			if (parent_id != '') {

				$.ajax({

					type: 'GET',

					url: url,

					data: { 'parent_id': parent_id },

					dataType: 'json',

					success: function (data) {

						console.log(data);

						var html = '';

						for (var i = 0; i < data.length; i++) {

							html += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";

						}

						$("#edit_city").html('');

						$("#edit_county").html('');

						$("#edit_city").append(html);



					}

				})

			} else {

				$("#edit_city").html('');

				$("#edit_county").html('');
			}

		})

		$("#edit_city").change(function () {

			var parent_id = $(this).val();

			var url = "{{route('Front_get_city')}}";

			$.ajax({

				type: 'GET',

				url: url,

				data: { 'parent_id': parent_id },

				dataType: 'json',

				success: function (date) {

					var html = '';

					for (var i = 0; i < date.length; i++) {

						html += "<option value='" + date[i].id + "'>" + date[i].name + "</option>";

					}

					$("#edit_county").html('');

					$("#edit_county").append(html);

				}
			})

		})

		function edit(id){

			var url = "{{route('Front_edit_address')}}";

				$.ajax({

				type: 'GET',

				url: url,

				data: { 'id': id },

				dataType: 'json',

				success: function (date) {

					console.log(date);

				}

		})
	}



	</script> @endsection('footer')