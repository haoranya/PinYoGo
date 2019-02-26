@extends("Front/layouts/footer")
@section("footer")
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>我的购物车</title>

    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-cart.css" />
</head>
<script type="text/javascript" src="/js/plugins/jquery/jquery.min.js"></script>

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
			<div class="fl logo"><span class="title">购物车</span></div>
			<div class="fr search">
				<form class="sui-form form-inline">
					<div class="input-append">
						<input type="text" type="text" class="input-error input-xxlarge" placeholder="品优购自营" />
						<button class="sui-btn btn-xlarge btn-danger" type="button">搜索</button>
					</div>
				</form>
			</div>
		</div>
		<!--All goods-->
		<div class="allgoods">
			<h4>全部商品<span>11</span></h4>
			<div class="cart-main">
				<div class="yui3-g cart-th">
					<div class="yui3-u-1-4">全部</div>
					<div class="yui3-u-1-4">商品</div>
					<div class="yui3-u-1-8">单价（元）</div>
					<div class="yui3-u-1-8">数量</div>
					<div class="yui3-u-1-8">小计（元）</div>
					<div class="yui3-u-1-8">操作</div>
				</div>
				<div class="cart-item-list">
	
					<div class="cart-body">

					@foreach($car_arr as $k=>$car)						
						<div class="cart-list">
							<ul class="goods-list yui3-g">
								<li class="yui3-u-1-24">
									<input type="checkbox" class="checkbox" id="checkbox{{$k}}" car="{{$car->id}}"/>
								</li>
								<li class="yui3-u-11-24">
									<div class="good-item">
										<div class="item-img"><img src="{{Storage::url($car->goods_image->logo)}}" /></div>
										<div class="item-msg"> 品牌-{{$car->goods_brand}} 商品名-{{$car->goods_info->goods_name}} {{$car->attr_spec}}</div>
									</div>
								</li>
								
								<li class="yui3-u-1-8"><span class="price">￥{{$car->price}}</span></li>
								<li class="yui3-u-1-8">
									<a href="javascript:void(0)" onclick="reduce({{$k}},{{$car->price}},{{session()->get('id')}},{{$car->id}})" class="increment mins">-</a>
									
									<input autocomplete="off" type="text" name="num{{$k}}{{session()->get('id')}}{{$car->id}}" value="" car="{{$car->id}}" minnum="1" class="itxt" />
								
									<a href="javascript:void(0)" onclick="add({{$k}},{{$car->price}},{{session()->get('id')}},{{$car->id}},{{$car->all_number}})" class="increment plus">+</a>
								</li>
								<li class="yui3-u-1-8"><span class="sum" id="count{{$k}}"></span></li>
								<li class="yui3-u-1-8">		
									<a style="cursor:pointer;"  onclick="if(confirm('确定要删除么?')){location.href='Front_del_cart?id={{$car->id}}'}">删除</a><br />
									<a style="cursor:pointer;"  onclick="if(confirm('确定要移动么?')){location.href='Front_move_cart?id={{$car->id}}&type=car'}">移到我的关注</a>
								</li>
							</ul>
						</div>
						<script>
								
									if(window.localStorage.getItem('num{{$k}}{{session()->get("id")}}{{$car->id}}')!=null){
								
									     var num = window.localStorage.getItem('num{{$k}}{{session()->get("id")}}{{$car->id}}');
								
									}else{
								
									     var num='{{$car->number}}';
								
									}
								
										$("input[name='num{{$k}}{{session()->get('id')}}{{$car->id}}']").val(num);

										var money = '{{$car->price}}';
									
										var count = money*num;
										
										$("#count{{$k}}").html("￥"+count);

										$("#checkbox{{$k}}").val(count);

										$("input[name='num{{$k}}']").blur(function(){

											var count_money =0;//总结

											var number = $(this).val();

											var key = 'num{{$k}}{{session()->get("id")}}{{$car->id}}';

											if(number<0){

												alert('不可以为负数');

												var number = window.localStorage.getItem(key);

											}else if(number>10){

												alert('最多为十个');

												var number = window.localStorage.getItem(key);


											}else{

											   var number = $(this).val();

											}

											window.localStorage.setItem(key,number);

											var value =  window.localStorage.getItem(key);

											$("input[name='num{{$k}}']").val(value);

											$("#count{{$k}}").html('￥'+value*money);

											$("#checkbox{{$k}}").val(value*money);

											//总结
											$("input[type=checkbox]:checked").each(function(){

                                              count_money+=Number($(this).val());
        
                                            })

                                               $(".summoney").html('￥'+count_money);

										})

						</script>
					@endforeach

					</div>
				</div>
			</div>
			<div class="cart-tool">
				<div class="select-all">
					<input type="checkbox" name="" id="choose" value="" />
					<span>全选</span>
				</div>
				<div class="option">
					<a href="#none">清除下柜商品</a>
				</div>
				<div class="toolbar">
					<div class="chosed">已选择<span id="fate">0</span>件商品</div>
					<div class="sumprice">
						<span><em>总价（不含运费） ：</em><i class="summoney">¥0</i></span>
						<span><em>已节省：</em><i>-¥20.00</i></span>
					</div>
					<div class="sumbtn">
						<a style="cursor:pointer;" class="sum-btn" onclick="decide()">结算</a>
					</div>
				</div>
			</div>
			<script>
			
					function decide(){

						if($("input[type=checkbox]:checked").length!=0){
							var car_id  = '';
							$("input[type=checkbox]:checked").each(function(){

								car_id += $(this).attr('car')+",";

							})

							var car_num ='';
							$(".itxt").each(function(){

								car_num += $(this).attr('car')+"-"+$(this).val()+",";

							});

							var url = 'Front_set_pay';
							$.ajax({
								type:'GET',
								url:url,
								data:{'car_num':car_num},
								dataType:'json',
								success:function(data){

									if(data==1){

										location.href = 'Front_getOrderInfo?car_id='+car_id;

									}

								}
							})

						}else{

							alert("请选择你要支付的商品");

						}

					}
			
			</script>
			<div class="clearfix"></div>
			<div class="deled">
				<span>已删除商品，您可以重新购买或加关注：</span>
			  @foreach($del_car as $info)
				<div class="cart-list del">
					<ul class="goods-list yui3-g">
						<li class="yui3-u-1-2">
							<div class="good-item">
								<div class="item-msg">{{$info->info}}</div>
							</div>
						</li>
						<li class="yui3-u-1-6"><span class="price">{{$info->price}}</span></li>
						<li class="yui3-u-1-6">
							<span class="number">1</span>
						</li>
						<li class="yui3-u-1-8">
							<a style="cursor:pointer;" onclick="if(confirm('确定重新购买?')){location.href='Front_readd_cart?id={{$info->id}}'}">重新购买</a>
							<a style="cursor:pointer;" onclick="if(confirm('确定要移动么?')){location.href='Front_move_cart?id={{$info->id}}&type=del_car'}">移到我的关注</a>
							<a style="cursor:pointer;"  onclick="if(confirm('确定要删除么?')){location.href='Front_del_delcart?id={{$info->id}}'}">删除</a><br />
						</li>
					</ul>
				</div>
			  @endforeach
			</div>
			<div class="liked">
				<ul class="sui-nav nav-tabs">
					<li class="active">
						<a href="#index" data-toggle="tab">猜你喜欢</a>
					</li>
					<li>
						<a href="#profile" data-toggle="tab">特惠换购</a>
					</li>
				</ul>
				<div class="clearfix"></div>
				<div class="tab-content">
					<div id="index" class="tab-pane active">
						<div id="myCarousel" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
							<div class="carousel-inner">
								<div class="active item">
									<ul>
										<li>
											<img src="img/like1.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="img/like2.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="img/like3.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="img/like4.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
									</ul>
								</div>
								<div class="item">
									<ul>
										<li>
											<img src="img/like1.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="img/like2.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="img/like3.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<li>
											<img src="img/like4.png" />
											<div class="intro">
												<i>Apple苹果iPhone 6s (A1699)</i>
											</div>
											<div class="money">
												<span>$29.00</span>
											</div>
											<div class="incar">
												<a href="#" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<a href="#myCarousel" data-slide="prev" class="carousel-control left">‹</a>
							<a href="#myCarousel" data-slide="next" class="carousel-control right">›</a>
						</div>
					</div>
					<div id="profile" class="tab-pane">
						<p>特惠选购</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 底部栏位 -->
	<script src="/js/car.js"></script>
<!--页面底部END-->
@endsection('footer')