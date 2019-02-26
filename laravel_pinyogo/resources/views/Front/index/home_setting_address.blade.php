@extends("Front/layouts/footer")
 @section('footer')
  @extends("Front/layouts/head")
	 @section('head')
	 @endsection('head')
<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="js/widget/nav.js"></script>
<script type="text/javascript" src="pages/userInfo/distpicker.data.js"></script>
<script type="text/javascript" src="pages/userInfo/distpicker.js"></script>
<script type="text/javascript" src="pages/userInfo/main.js"></script>
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
                    <div class="body userAddress">
                        <div class="address-title">
                            <span class="title">地址管理</span>
                            <a data-toggle="modal" data-target=".edit" data-keyboard="false"   class="sui-btn  btn-info add-new">添加新地址</a>
                            <span class="clearfix"></span>
                        </div>
                        <div class="address-detail">
                            <table class="sui-table table-bordered">
                                <thead>
                                    <tr>
                                        <th>姓名</th>
                                        <th>地址</th>
                                        <th>联系电话</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($address as $addr)
                                    <tr>
                                        <td>{{$addr->name}}</td>
                                        <td>{{$addr->province}} {{$addr->city}} {{$addr->county}} {{$addr->address_name}}</td>
                                        <td>{{$addr->phone}}</td>
                                        <td>
                                            <a href="Front_edit_address?id={{$addr->id}}">编辑</a>
                                            <a href="Front_del_address?id={{$addr->id}}&home='true'">删除</a>
                                         @if($addr->address_state=='非默认')
                                            <a href="Front_set_address?id={{$addr->id}}&home='true'">设为默认</a>
                                         @endif
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>    
                            </table>                          
                        </div>
                        <!--新增地址弹出层-->
                         <div  tabindex="-1" role="dialog" data-hasfoot="false" class="sui-modal hide fade edit" style="width:580px;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close">×</button>
                                        <h4 id="myModalLabel" class="modal-title">新增地址</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="Front_add_address" method="post" class="sui-form form-horizontal">

                                            {{csrf_field()}}
                                            <input type="hidden" name="home" value="true">
                                            <div class="control-group">
                                            <label class="control-label">收货人：</label>
                                            <div class="controls">
                                                <input type="text" name="name" class="input-medium">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">所在地区：</label>
                                            <div class="controls">
                                                <div data-toggle="distpicker">
                                                <div class="form-group area">
                                                    <select class="form-control" name="province" id="province1"></select>
                                                </div>
                                                <div class="form-group area">
                                                    <select class="form-control" name="city" id="city1"></select>
                                                </div>
                                                <div class="form-group area">
                                                    <select class="form-control" name="county" id="district1"></select>
                                                </div>
                                            </div>
                                            </div>									 
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">详细地址：</label>
                                            <div class="controls">
                                                <input type="text" name="address_name" class="input-large">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">联系电话：</label>
                                            <div class="controls">
                                                <input type="text" name="phone" class="input-medium">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">邮政编码：</label>
                                            <div class="controls">
                                                <input type="text" name="zip_code" class="input-medium">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部栏位 -->
@endsection('footer')