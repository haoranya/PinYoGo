<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yansongda\Pay\Pay;
//下载依赖包yansongda/pay

use App\Models\Order;

use App\Models\Order_info;

class WxpayController extends Controller
{
   
    protected $config = [

        'app_id' => 'wx426b3015555a46be',
        'mch_id' => '1900009851',
        'key' => '8934e7d15453e97507ef794cf7b0519d',
        // 支付成功后通知的地址
        'notify_url' => 'http://t22h650766.51mypc.cn:42616/wxpay_notify',
        ];

    //调用微信接口进行支付

    public function pay(){

        //接收订单号

        $order_id = $_GET['order_id'];

        $sn = $_GET['sn'];

        // $price = $_GET['price'];


        $price = 0.01;

        $order = [

            'out_trade_no' => $sn,
            'total_fee' => $price*100, // **单位：分**
            'body' => '充值'.$price."分",

        ];

        // 调用接口
        $pay = Pay::wechat($this->config)->scan($order);

        if($pay->return_code=="SUCCESS"&&$pay->result_code=="SUCCESS"){

             //加载视图把支付码的字符串传递到页面
                
                return view("Front.wxpay.wxpay",[

                    'code'=>$pay->code_url,

                    'sn'=>$sn,

                    'price'=>$price,

                    'order_id'=>$order_id,

                ]);
            
               }else{

                    echo 1;

                     die();

            }

    }

    //接收支付消息

    function notify(){

        
        // //由于微信是在后台通知的所以看不到，可以写进日志里面进行查看

        //船舰日志对象


        $pay = Pay::wechat($this->config);

       

        try{
            
               
            //php默认只能接收$_GET $_POST 但一些特殊的数据不可以

            //如：json  xml数据

            //微信发送的通知是 xml  所以无法使用$_GET或者$_POST接收

            //但是可以使用php:://input来接受
            
            $data = $pay->verify(); // 是的，验签就这么简单！

            if($data['result_code'] == 'SUCCESS' && $data['return_code'] == 'SUCCESS'){

                //更新订单的状态

                $sn = $data['out_trade_no'];

                $order_id = (Order::where('order',$sn)->select('id')->first())->id;

                Order_info::where('order_id',$order_id)->update(['buyer_state'=>'已支付','pay_style'=>'微信支付']);

            }


        }catch (Exception $e){

            var_dump($e->getMessage());

        }

        $pay->success()->send();

    }


}
