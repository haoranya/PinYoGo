@extends("Front/layouts/footer")
 @section('footer')
  @extends("Front/layouts/head")
	 @section('head')
	 @endsection('head')
<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
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
							<dd><a href="{{ route('Front_home_order_pay') }}" @if($order_info->buyer_state=='待支付') class="list-active" @endif >待付款</a></dd>
							<dd><a href="{{ route('Front_home_order_send') }}" @if($order_info->buyer_state=='已支付') class="list-active" @endif >待发货</a></dd>
							<dd><a href="{{ route('Front_home_order_receive') }}" @if($order_info->buyer_state=='待收货') class="list-active" @endif>待收货</a></dd>
							<dd><a href="{{ route('Front_home_order_evaluate') }}" @if($order_info->buyer_state=='待评价') class="list-active" @endif >待评价</a></dd>
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
                    <div class="body">
                        <div class="order-detail">
                            <h4>订单详情</h4>
                            <div class="order-bar">
                                <div class="sui-steps-round steps-round-auto steps-4">
                                    <div  @if($order_info->buyer_state=='待支付')class="todo"@else class="finished" @endif>
                                        <div class="wrap">
                                        <div class="round">1</div>
                                        <div class="bar"></div>
                                        </div>
                                        <label>
                                            <span>提交订单</span>
                                            <span>2016-06-27</span>
                                            <span>13:03:53</span>
                                        </label>
                                    </div>
                                    <div @if($order_info->buyer_state!='待支付') class="current" @else class="todo" @endif>
                                        <div class="wrap">
                                        <div class="round">2</div>
                                        <div class="bar"></div>
                                        </div>
                                        <label>
                                            <span>付款成功</span>
                                            <span>2016-06-27</span>
                                            <span>13:03:53</span>
                                        </label>
                                    </div>
                                    <div @if($order_info->seller_state=='已发货') class="current" @else class="todo" @endif>
                                        <div class="wrap">
                                        <div class="round">3</div>
                                        <div class="bar"></div>
                                        </div>
                                        <label>
                                            <span>发货</span>
                                            <span>2016-06-27</span>
                                            <span>13:03:53</span>
                                        </label>
                                    </div>
                                    <div  @if($order_info->buyer_state=='已收货')class="current"@else class="todo" @endif>
                                        <div class="wrap">
                                        <div class="round">4</div>
                                        <div class="bar"></div>
                                        </div>
                                        <label>
                                            <span>确认收货</span>
                                            <span>2016-06-27</span>
                                            <span>13:03:53</span>
                                        </label>
                                    </div>
                                    
                                    <div @if($order_info->buyer_state=='已评价') class="current" @else class="todo" @endif>
                                        <div class="wrap">
                                        <div class="round">5</div>
                                        </div>
                                        <label>
                                            <span>评价晒单</span>
                                            <span>2016-06-27</span>
                                            <span>13:03:53</span>
                                        </label>
                                    </div>
                                    </div>
                            </div>
                            <div class="order-state">
                                <p>当前订单状态：<span class="red">{{$order_info->buyer_state}}</span></p>
                                @if($order_info->buyer_state=='待收货')
                                <p>还剩06天00小时 自动确认收货</p>
                                @endif
                            </div>
                        </div>
                        <div class="order-info">
                            <h5>订单信息</h5>
                            <p>收货地址：{{$address->province}} {{$address->city}} {{$address->county}} {{$address->address_name}}  </p>
                            <p>订单单号：{{$order->order}}</p>
                            <p>下单时间：{{$order->created_at}}</p>
                            @if($order_info->buyer_state!="待支付")
                            <p>支付时间:{{$order_info->update_at}}</p>
                            @else
                            <p style="color:red;font-size:18px;">支付时间:请尽快完成支付</p>
                            @endif
                            @if($order_info->buyer_state!="待支付")
                            <p>支付方式：{{$order_info->pay_style}}</p>
                            @else
                            <p style="color:red;font-size:18px;">支付方式:请尽快完成支付</p>
                            @endif
                            @if($order_info->seller_state=='已发货')
                            <p>发货时间：{{$order_info->express_time}}</p>
                            @else
                            <p>发货：请耐心等待</p>
                            @endif
                        </div>
                        <div class="order-goods">
                            <table class="sui-table">
                                    <thead>
                                        <th class="center" >商品</th>
                                        <th class="center" >价格</th>
                                        <th class="center" >数量</th>
                                        <th class="center" >优惠</th>
                                        <th class="center" >状态</th>
                                    </thead>                                   
                             
                                <tbody>                               
                                    <tr>
                                        <td colspan="5">订单编号：{{$order->order}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="typographic"><img src="img/goods.png" />
                                                    <span>包邮 {{$goods_name}}</span>
                                                    <span class="guige">规格：{{$info}}</span>
                                                </div>
                                        </td>
                                        <td>
                                            <ul class="unstyled">
                                                    <li>¥{{$attr_spec->price}}.00</li>											
                                                </ul>
                                        </td>
                                        <td>{{$order->order_num}}</td>
                                        <td>优惠:{{$order_info->cheap}}</td>
                                        <td>{{$order_info->buyer_state}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="order-price">
                                <p>商品总金额：￥{{$attr_spec->price*$order->order_num}}</p>
                                <p>运费金额：，免费用</p>
                                <p>优惠：{{$order_info->cheap}}</p>
                                <h4 class="red">实际支付：￥{{$attr_spec->price*$order->order_num}}</h4>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!--猜你喜欢-->
                        <div class="like-title">
                            <div class="mt">
                                <span class="fl"><strong>热卖单品</strong></span>
                            </div>
                        </div>
                        <div class="like-list">
                            <ul class="yui3-g">
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="img/_/itemlike01.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>3699.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有6人评价</i>
                                        </div>
                                    </div>
                                </li>
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="img/_/itemlike02.png" />
                                        </div>
                                        <div class="attr">
                                            <em>Apple苹果iPhone 6s/6s Plus 16G 64G 128G</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>4388.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有700人评价</i>
                                        </div>
                                    </div>
                                </li>
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="img/_/itemlike03.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>4088.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有700人评价</i>
                                        </div>
                                    </div>
                                </li>
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="img/_/itemlike04.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>4088.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有700人评价</i>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部栏位 -->
@endsection('footer')