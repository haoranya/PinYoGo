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
                            <span class="safe"><a href="#">退出登录 </a></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="list-items">
                        <dl>
							<dt><i>·</i> 订单中心</dt>
							<dd ><a href="{{ route('Front_home_index') }}"  class="list-active" >我的订单</a></dd>
							<dd><a href="{{ route('Front_home_order_pay') }}" >待付款</a></dd>
							<dd><a href="{{ route('Front_home_order_send') }}"  >待发货</a></dd>
							<dd><a href="{{ route('Front_home_order_receive') }}" >待收货</a></dd>
							<dd><a href="{{ route('Front_home_order_evaluate') }}" >待评价</a></dd>
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
                <div class="yui3-u-5-6 order-pay">
                    <div class="body">
                        <div class="table-title">
                            <table class="sui-table  order-table">
                                <tr>
                                    <thead>
                                        <th width="35%">宝贝</th>
                                        <th width="5%">单价</th>
                                        <th width="5%">数量</th>
                                        <th width="8%">商品操作</th>
                                        <th width="10%">实付款</th>
                                        <th width="10%">交易状态</th>
                                        <th width="10%">交易操作</th>
                                    </thead>
                                </tr>
                            </table>
                        </div>
                        <div class="order-detail">
                            <div class="orders">
								<!--order1-->
                             @foreach($order_arr as $order)
                                <div class="choose-title">
                                    <label data-toggle="checkbox" class="checkbox-pretty ">
                                           <input type="checkbox" checked="checked"><span>{{$order->created_at}}　订单编号：{{$order->order}}  店铺：{{$order->shop}} </span>
                                     </label>
									  <a class="sui-btn btn-info share-btn">分享</a>
                                </div>
                                <table class="sui-table table-bordered order-datatable">
                                    <tbody>
                                        <tr>
                                            <td width="35%">
                                                <div class="typographic"><img src="img/goods.png" />
                                                    <a href="Front_item?goods_id={{$order->goods_id}}" class="block-text">包邮  {{$order->goods_name}}</a>
                                                    <span class="guige">规格：{{$order->info}}</span>
                                                </div>
                                            </td>
                                            <td width="5%" class="center">
                                                <ul class="unstyled">
                                                    <li>¥{{$order->price}}.00</li>
                                                </ul>
                                            </td>
                                            <td width="5%" class="center">{{$order->order_num}}</td>
                                            <td width="8%" class="center">
                                               
                                            </td>
                                            <td width="10%" class="center" >
                                                <ul class="unstyled">
                                                    <li>¥{{$order->order_num*$order->price}}.00</li>
                                                    <li>（含运费：￥0.00）</li>
                                                </ul>
                                            </td>
                                            <td width="10%" class="center">
                                                <ul class="unstyled">
                                                    <li>买家{{$order->buyer_state}}</li>
                                                    <li><a href="Front_home_orderDetail?id={{$order->id}}" class="btn">订单详情 </a></li>
                                                </ul>
                                            </td>
                                            <td width="10%" class="center">
                                                <ul class="unstyled">
                                                   @if($order->buyer_state=='待支付')
													<li><a href="pay?order_id={{$order->id}}&price={{$order->order_num*$order->price}}&sn={{$order->order}}" class="sui-btn btn-info">立即付款</a></li>
                                                    <li><a href="Front_refund_order?id={{$order->id}}" class="sui-btn btn-danger">取消订单</a></li>
                                                   @elseif($order->buyer_state=='已支付'&&($order->seller_state=='未支付'||$order->express=='未发货')&&$order->buyer_handle=='正常')
                                                   <li><a href="Front_pay_order?id={{$order->id}}" class="sui-btn btn-info">提醒发货</a></li>
                                                   <li><a href="go_back?id={{$order->id}}" class="sui-btn btn-danger">退款</a></li>                                                   
                                                   @elseif($order->express=='已发货')
                                                   <li><a href="Front_pay_order?id={{$order->id}}" class="sui-btn btn-info">确认收货</a></li> 
                                                   @elseif($order->buyer_handle=='退款'&&$order->seller_handle=='待退款')
                                                   <li><a href="Front_pay_order?id={{$order->id}}" class="sui-btn btn-info">提醒退款</a></li>                                                   
                                                   <li><p style="color:red;">请安心等待退款</p></li>  
                                                   @elseif($order->buyer_handle=='退款'&&$order->seller_handle=='已退款')
                                                   <li><a href="Front_refund_order?id={{$order->id}}" class="sui-btn btn-info">删除记录</a></li>                                                   
                                                   <li><p style="color:skyblue;">退款成功</p></li>                                                                                                 
                                                   @endif
                                                
                                                </ul>
                                            </td>
                                        </tr>
                                        

                                    </tbody>
                                </table>
                             @endforeach
                            </div>
                            <div class="choose-order">
                                <div class="sui-pagination pagination-large top-pages">
                                <div style="width:100%;text-align:center;">{{ $orders->appends($req->all())->links() }}</div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>

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