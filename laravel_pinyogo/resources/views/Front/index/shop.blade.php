@extends("Front/layouts/footer")
 @section('footer')
  @extends("Front/layouts/head")
	 @section('head')
	 @endsection('head')
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/widget/jquery.autocomplete.js"></script>
<script type="text/javascript" src="js/widget/nav.js"></script>
<script type="text/javascript" src="js/pages/seckill-index.js"></script>
<script type="text/javascript" src="js/pages/shop.js"></script>
<script>
	   $(function(){
		   $("#code").hover(function(){
			   $(".erweima").show();
		   },function(){
			   $(".erweima").hide();
		   });
	   })
	</script>
</body>

    <div class="py-container shop">
        <!--header-->
        <div class="shop-name">红袖官方旗舰店</div>

        <div class="shop-logo">
            <div class="fl logo-img">
                <img src="img/_/shop-logo.png" />
            </div>
            <div class="shop-vip">
                <div class="pay">
                    <img src="img/_/car.png" alt="">
                    <span>
                         全场免运费<br />
                         货到付款
                    </span>
                </div>
                <div class="vip">
                    会员权益<br/>
                    VIP PRIVILEGE
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="head-nav" id="headnav-fixed">
            <div class="sui-navbar">
                <div class="navbar-inner">
                    <ul class="sui-nav ">
                        <li><a href="#">首页</a></li>
                        <li id="li-1" class="all-list">全部分类<span></span></li>
                        <li  class="active"><a href="#tab-one" data-toggle="tab">热卖爆款</a></li>
                        <li><a href="#tab-two" data-toggle="tab">秋装新品</a></li>
                        <li><a href="#tab-three" data-toggle="tab">连衣裙</a></li>
                        <li><a href="#tab-four">T恤</a></li>
                        <li><a href="#tab-five">衬衫雪纺</a></li>
                        <li><a href="#tab-six">半身裙</a></li>
                        <li><a href="#tab-seven">裤装</a></li>
                        <li><a href="#tab-eight">商场同款</a></li>
                    </ul>

                    <form class="sui-form sui-form pull-right">
                        <input type="text" placeholder="连衣裙...">
                        <button class="sui-btn">搜索</button>
                    </form>
                    <div class="clearfix"></div>
                    <!--下拉的菜单-->
                    <div id="box-1" class="hidden-box hidden-loc-index">
                        <ul id="listall">
                            <li>热卖爆款</li>
                            <li>今日推荐</li>
                            <li>秋装新品</li>
                            <li>T恤</li>
                            <li>连衣裙</li>
                            <li>衬衫雪纺</li>
                            <li>半身裙</li>
                            
                        </ul>
                    </div>
                    <!--下拉的菜单end-->
                </div>
            </div>
        </div>

        <div class="banner">
            <img src="img/_/shop-intro.png" alt="">
        </div>

        <div class="default-list">
            <div class="title">
                <h1>Must have+</h1>
                <h2>畅销夏日装备</h2>
            </div>
            <div class="goods-list">
                <ul class="yui3-g" id="goods-list">
                    <li class="yui3-u-1-4">
                        <div class="list-wrap">
                            <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                            <div class="operate">
                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                            </div>
                        </div>
                    </li >
                     <li class="yui3-u-1-4">
                        <div class="list-wrap">
                            <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                            <div class="operate">
                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                            </div>
                        </div>
                    </li >
                     <li class="yui3-u-1-4">
                        <div class="list-wrap">
                            <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                            <div class="operate">
                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                            </div>
                        </div>
                    </li >
                     <li class="yui3-u-1-4">
                        <div class="list-wrap">
                            <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                            <div class="operate">
                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                            </div>
                        </div>
                    </li >
                    <li class="yui3-u-1-4">
                        <div class="list-wrap">
                            <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                            <div class="operate">
                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                            </div>
                        </div>
                    </li >
                     <li class="yui3-u-1-4">
                        <div class="list-wrap">
                            <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                            <div class="operate">
                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                            </div>
                        </div>
                    </li >
                     <li class="yui3-u-1-4">
                        <div class="list-wrap">
                            <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                            <div class="operate">
                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                            </div>
                        </div>
                    </li >
                     <li class="yui3-u-1-4">
                        <div class="list-wrap">
                            <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                            <div class="operate">
                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                            </div>
                        </div>
                    </li >
                </ul>
            </div>
            <div class="shop-part">
                <img src="img/_/shop-part.png" alt="">
            </div>
            <!--tab lists-->
            <div class="tab-content">
                <div class="title">
                    <h1>All Best+</h1>
                    <h2>全部新品</h2>
                </div>
                <div id="tab-one" class="tab-pane active">
                    <ul class="yui3-g" id="tab-list">
                        <li class="yui3-u-1-4">
                            <div class="list-wrap" >
                                <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                                <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div><div class='cu'><em><span>促</span>满一件可参加超值换购</em></div>
                                <div class="operate">
                                    <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                                </div>
                            </div>
                        </li >
                         <li class="yui3-u-1-4">
                            <div class="list-wrap" >
                                <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                                <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div><div class='cu'><em><span>促</span>满一件可参加超值换购</em></div>
                                <div class="operate">
                                    <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                                </div>
                            </div>
                        </li >
                         <li class="yui3-u-1-4">
                            <div class="list-wrap" >
                                <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                                <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div><div class='cu'><em><span>促</span>满一件可参加超值换购</em></div>
                                <div class="operate">
                                    <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                                </div>
                            </div>
                        </li >
                         <li class="yui3-u-1-4">
                            <div class="list-wrap" >
                                <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                                <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div><div class='cu'><em><span>促</span>满一件可参加超值换购</em></div>
                                <div class="operate">
                                    <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                                </div>
                            </div>
                        </li >
                        <li class="yui3-u-1-4">
                            <div class="list-wrap" >
                                <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                                <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div><div class='cu'><em><span>促</span>满一件可参加超值换购</em></div>
                                <div class="operate">
                                    <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                                </div>
                            </div>
                        </li >
                         <li class="yui3-u-1-4">
                            <div class="list-wrap" >
                                <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                                <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div><div class='cu'><em><span>促</span>满一件可参加超值换购</em></div>
                                <div class="operate">
                                    <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                                </div>
                            </div>
                        </li >
                         <li class="yui3-u-1-4">
                            <div class="list-wrap" >
                                <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                                <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div><div class='cu'><em><span>促</span>满一件可参加超值换购</em></div>
                                <div class="operate">
                                    <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                                </div>
                            </div>
                        </li >
                         <li class="yui3-u-1-4">
                            <div class="list-wrap" >
                                <div class="p-img"><img src="img/_/t.jpg" alt=''></div>
                                <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div><div class='cu'><em><span>促</span>满一件可参加超值换购</em></div>
                                <div class="operate">
                                    <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                    <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                                </div>
                            </div>
                        </li >
                    </ul>
                </div>
                <div id="tab-two" class="tab-pane">2</div>
                <div id="tab-three" class="tab-pane">3</div>
            </div>
            <!--tab list end-->
        </div>


        <!--回到顶部-->
        <div class="cd-top">
            <div class="top">
                <img src="img/_/gotop.png" />
                <b>TOP</b>
            </div>
            <div class="code" id="code">
                <span><img src="img/_/code.png"/></span>
            </div>
            <div class="erweima">
                <img src="img/_/erweima.jpg" alt="">
                <s></s>
            </div>
        </div>
    </div>

    <!-- 底部栏位 -->
 @endsection('footer')