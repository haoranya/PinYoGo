<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href="/css/shop.css" type="text/css" rel="stylesheet" />
  <link href="/css/Sellerber.css" type="text/css" rel="stylesheet" />
  <link href="/css/bkg_ui.css" type="text/css" rel="stylesheet" />
  <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <script src="/js/jquery-1.9.1.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="/js/jquery.cookie.js"></script>
  <script src="/js/shopFrame.js" type="text/javascript"></script>
  <script src="/js/Sellerber.js" type="text/javascript"></script>
  <script src="/js/layer/layer.js" type="text/javascript"></script>
  <script src="/js/laydate/laydate.js" type="text/javascript"></script>
  <script type="text/javascript" src="/js/proTree.js"></script>
  <script src="/js/jquery.easy-pie-chart.min.js"></script>
  <title>订单列表</title>
</head>

<body>
  <div class="margin" id="page_style">
    <div class="operation clearfix mb15 same_module cover_style p0" id="Order_form_style">
      <div class="type_title">购物产品比例</div>
      <div class="hide_style clearfix">

        @foreach($arr as $v)
        @if(count($data)!==0)      
        <div class="proportion">
          <div class="easy-pie-chart percentage" data-percent="{{$v['amount']/count($data)}}" data-color="#d63116">
            <span class="percent">{{$v['amount']/count($data)}}</span>%</div>
          <span class="name">{{$v['name']}}</span>
        </div>
        @endif
        @endforeach
      </div>

    </div>
    <!--列表展示-->
    <div class="h_products_list clearfix" id="Sellerber">
      <div class="Sellerber_left menu" id="menuBar">
        <div class="show_btn" id="rightArrow">
          <span></span>
        </div>
        <div class="side_title">
          <a title="隐藏" class="close_btn">
            <span></span>
          </a>
        </div>
        <div class="menu_style" id="menu_style">
          <div class="list_content">
            <div class="side_list">
              <div class="column_title">
                <h4 class="lighter smaller">订单类型</h4>
              </div>
              <div class="st_tree_style tree">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="list_Exhibition list_show padding15">
        <div class="operation clearfix mb15 searchs_style">
          <button class="btn button_btn btn-danger" type="button" onclick="">
            <i class="fa fa-trash-o"></i>&nbsp;删除</button>
          <span class="submenu">
          </span>
          <div class="search  clearfix">
            <label class="label_name">商品搜索：</label>
            <input class="laydate-icon col-xs-2 col-lg-2 form-control Select_Date" id="start" type="text">
            <span style=" float:left; padding:0px 10px; line-height:32px;">至</span>
            <input class="laydate-icon col-xs-2 col-lg-2 form-control Select_Date" id="end" type="text">
            <input name="" type="text" class="form-control col-xs-3 col-lg-4" />
            <button class="btn button_btn bg-deep-blue " onclick="" type="button">
              <i class="fa  fa-search"></i>&nbsp;搜索</button>
            <span>数量：3433件</span>
          </div>
        </div>
        <div class="datalist_show">
          <div class="datatable_height confirm">
            <table class="table table_list table_striped table-bordered" id="covar_list">
              <thead>
                <tr>
                  <th width="25px">
                    <label>
                      <input type="checkbox" class="ace">
                      <span class="lbl"></span>
                    </label>
                  </th>
                  <th width="120px">订单编号</th>
                  <th width="250px">产品名称</th>
                  <th width="100px">单价</th>
                  <th width="100px">优惠</th>
                  <th width="100px">订单时间</th>
                  <th width="180px">所属类型</th>
                  <th width="80px">数量</th>
                  <th width="70px">状态</th>
                  <th width="200px">操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $v)
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" class="ace">
                      <span class="lbl"></span>
                    </label>
                  </td>
                  <td>{{$v->order}}</td>
                  <td class="order_product_name">
                    {{$v->goods_name}}
                  </td>
                  <td>{{$v->price}}</td>
                  <td>{{$v->cheap}}</td>
                  <td>{{$v->created_at}}</td>
                  <td>{{$v->goods_type}}</td>
                  <td>{{$v->order_num}}</td>
                  <td class="td-status">
                    <span class="label label-success radius">{{$v->seller_state}}</span>
                  </td>
                  <td>
                    @if($v->seller_state=='已支付')
                    <a onClick="Delivery_stop(this,'10001',{{$v->id}})" href="javascript:;" title="发货" class="btn btn-xs btn-status">发货</a>
                    @elseif($v->seller_state=='未支付')
                    <a href="javascript:;" title="支付" class="btn btn-xs btn-status">前去支付</a>
                    @endif
                    <a title="订单详细" href="{{route('Admin_order_content')}}?id={{$v->id}}" class="btn btn-xs btn-info">详细</a>
                    <a style="cursor:pointer" onclick='if(confirm("你确认要删除吗？")){location.href="{{route("Admin_order_del")}}?id={{$v->id}}"}' class="btn btn-danger btn-xs">删除</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--发货-->
  <div id="Delivery_stop" style=" display:none">
    <div class="padding15">
      <div class="content_style">
        <div class="form-group">
          <label class="col-sm-2 control-label no-padding-right" for="form-field-1">快递公司 </label>
          <div class="col-sm-9">
            <select class="form-control col-xs-8 col-sm-8 col-md-8" id="form-field-select-1">
              <option value="">--选择快递--</option>
              <option value="天天快递">天天快递</option>
              <option value="圆通快递">圆通快递</option>
              <option value="中通快递">中通快递</option>
              <option value="顺丰快递">顺丰快递</option>
              <option value="申通快递">申通快递</option>
              <option value="邮政EMS ">邮政EMS </option>
              <option value="邮政小包">邮政小包</option>
              <option value="韵达快递">韵达快递</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 快递号 </label>
          <div class="col-xs-8 col-sm-8 col-md-8 col-lg-9">
            <input type="text" id="form-field-1" placeholder="快递号" class="col-xs-10 col-sm-8 col-xs-8" style="margin-left:0px;">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label no-padding-right" for="form-field-1">货到付款 </label>
          <div class="col-sm-9">
            <label class="col-sm-2 " style="display: block; margin-top:6px">
              <input name="checkbox" type="checkbox" class="ace" id="checkbox">
              <span class="lbl"></span>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<script type="text/javascript">
  //设置内页框架布局
  $(function () {
    $("#Sellerber").frame({
      float: 'left',
      color_btn: '.skin_select',
      Sellerber_menu: '.list_content',
      page_content: '.list_show',//内容
      datalist: ".datatable_height",//数据列表高度取值
      header: 65,//顶部高度
      mwidth: 200,//菜单栏宽度
      minStatue: true,

    });
  });
  //后台传入的 标题列表


  var url = "{{route('Admin_order_ajax')}}";

  $.ajax({

    type: 'GET',
    url: url,
    dataType: 'json',
    success: function (data) {

      var str = "";

      var arr = [];
      for (var i = 0; i < data.length; i++) {
        arr[i] = str = eval('(' + data[i] + ')');
      }
      $(".tree").ProTree({
        arr: arr,//数据
        simIcon: "fa fa-file-text-o",//单个标题字体图标 不传默认glyphicon-file
        mouIconOpen: "fa fa-folder-open",//含多个标题的打开字体图标  不传默认glyphicon-folder-open
        mouIconClose: "fa fa-folder",//含多个标题的关闭的字体图标  不传默认glyphicon-folder-close

      })
    }

  })


  /******时间设置*******/
  var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    // min: laydate.now(), //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    choose: function (datas) {
      end.min = datas; //开始日选好后，重置结束日的最小日期
      end.start = datas //将结束日的初始值设定为开始日
    }
  };
  var end = {
    elem: '#end',
    format: 'YYYY-MM-DD',
    //min: laydate.now(),
    max: '2099-06-16',
    istime: true,
    istoday: false,
    choose: function (datas) {
      start.max = datas; //结束日选好后，重置开始日的最大日期
    }
  };
  laydate(start);
  laydate(end);
  /*订单-删除*/
  function Order_form_del(obj, id) {
    layer.confirm('确认要删除吗？', function (index) {
      $(obj).parents("tr").remove();
      layer.msg('已删除!', { icon: 1, time: 1000 });
    });
  }
  /**发货**/
  function Delivery_stop(obj, id, order_id) {
    layer.open({
      type: 1,
      title: '发货',
      maxmin: true,
      shadeClose: false,
      area: ['500px', ''],
      content: $('#Delivery_stop'),
      btn: ['确定', '取消'],
      yes: function (index, layero) {
        if ($('#form-field-1').val() == "") {
          layer.alert('快递号不能为空！', {
            title: '提示框',
            icon: 0,
          })

        }else if($("#form-field-select-1").val()==''){

          layer.alert('快递不能为空！', {
            title: '提示框',
            icon: 0,
          })

        } else {
          layer.confirm('提交成功！', function (index) {

            var express_number = $("#form-field-1").val();

            var express = $("#form-field-select-1").val();

              var url = "{{route('Admin_order_send')}}";

              $.ajax({

                type: 'GET',
                url: url,
                data: { 'order_id': order_id,'express':express,'express_number':express_number },
                dataType: 'json',
                success: function (data) {

                  if (data == 1) {

                    $(obj).parents("tr").find(".td-manage").prepend('<a style=" display:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="已发货"><i class="fa fa-cubes bigger-120"></i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已发货</span>');
                    $(obj).remove();
                    layer.msg('已发货!', { icon: 6, time: 1000 });


                  }


                }

              })

          });
          layer.close(index);
        }

      }
    })
  };
  var oldie = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());
  $('.easy-pie-chart.percentage').each(function () {
    $(this).easyPieChart({
      barColor: $(this).data('color'),
      trackColor: '#EEEEEE',
      scaleColor: false,
      lineCap: 'butt',
      lineWidth: 10,
      animate: oldie ? false : 1000,
      size: 103
    }).css('color', $(this).data('color'));
  });
</script>