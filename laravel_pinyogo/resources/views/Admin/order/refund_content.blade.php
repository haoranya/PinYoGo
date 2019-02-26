<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href="css/shop.css" type="text/css" rel="stylesheet" />
  <link href="css/Sellerber.css" type="text/css" rel="stylesheet" />
  <link href="css/bkg_ui.css" type="text/css" rel="stylesheet" />
  <link href="font/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
  <script src="js/Sellerber.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/jquery.cookie.js"></script>
  <script src="js/shopFrame.js" type="text/javascript"></script>
  <script src="js/layer/layer.js" type="text/javascript"></script>
  <script src="js/laydate/laydate.js" type="text/javascript"></script>
  <script src="js/dist/echarts.js" type="text/javascript"></script>
  <!--[if lt IE 9]>
<script src="js/html5shiv.js" type="text/javascript"></script>
<script src="js/respond.min.js"></script>
<script src="js/css3-mediaqueries.js"  type="text/javascript"></script>
  <![endif]-->
  <title>退款详细</title>
</head>

<body>
  <div class="margin" id="page_style">
    <div class="Refund_detailed">
      <div class="Numbering mb20">退款单编号:
        <b>{{$order_infos->express_number}}</b>
      </div>
      <div class="detailed_style">
        <!--退款信息-->
        <div class="Receiver_style">
          <div class="title_name">退款信息</div>
          <div class="Info_style clearfix padding">
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 退款人姓名： </label>
              <div class="o_content">{{$address->name}}</div>
            </div>
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 退款人电话： </label>
              <div class="o_content">{{$address->phone}}</div>
            </div>
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 订单转态： </label>
              <div class="o_content">{{$order_infos->seller_handle}}</div>
            </div>
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 退款方式：</label>
              <div class="o_content">银联</div>
            </div>
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 退款数量：</label>
              <div class="o_content">{{$orders->order_num}}件</div>
            </div>
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 快递名称：</label>
              <div class="o_content">{{$order_infos->express}}</div>
            </div>
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 快递单号：</label>
              <div class="o_content">{{$order_infos->express_number}}</div>
            </div>
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 退款账户：</label>
              <div class="o_content">招商储蓄卡</div>
            </div>
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 退款账号：</label>
              <div class="o_content">345678*****5678</div>
            </div>
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 退款金额：</label>
              <div class="o_content">{{$goods->price*$orders->order_num}}元</div>
            </div>
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 退款日期：</label>
              <div class="o_content">{{$order_infos->updated_at}}</div>
            </div>
            <div class="col-xs-3">
              <label class="label_name" for="form-field-2"> 状态：</label>
              <div class="o_content">{{$order_infos->seller_state}}</div>
            </div>
          </div>
        </div>
        <div class="Receiver_style">
          <div class="title_name">退款说明</div>
          <div class="reund_content padding">
            {{$orders->order_desc}}
          </div>
        </div>

        <!--产品信息-->
        <div class="product_style">
          <div class="title_name">产品信息</div>
          <div class="Info_style clearfix">
            <div class="product_info clearfix">
              <a href="#" class="img_link">
                <img src="{{Storage::url($images->logo)}}">
              </a>
              <span>
                <a href="#" class="name_link">{{$goods->desc}}</a><br>
                <b>{{$goods->goods_name}}</b>
                @foreach($specs as $spec)
                <p>{{$spec->attr_name}}：{{$spec->spec}}</p>
                @endforeach
                <p>数量：{{$orders->order_num}}件</p>
                <p>价格：
                  <b class="price">
                    <i>￥</i>{{$goods->price}}</b>
                </p>
                <p class="status">未退款</p>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>