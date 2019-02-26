<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;

use App\Models\Order_info;

use App\Models\Attr_spec;

class Front_orderController extends Controller
{
    function refund_order(){

        $order_id = $_GET['id'];
    
        $order = Order::where('id',$order_id)->first();

        $order_info = Order_info::where('order_id',$order_id)->first();

        if($order_info->buyer_state=='待支付'||$order_info->seller_handle=='已退款'){

            Attr_spec::where('spec_id',$order->spec_id)->increment('number',$order->order_num);

            Order::where('id',$order_id)->delete();

            Order_info::where('order_id',$order_id)->delete();

            return "<script>alert('操作成功！！！');location.href='Front_home_index'</script>";

        }else{

            return "<script>alert('您已经支付,请安心等待发货')!location.href='Front_home_index'</script>";

        }

    }

    function pay_order(){

        $order_id = $_GET['id'];

       

    }

    function order_info(){

        $order_id = $_GET['order_id'];

        $data = (Order_info::where('order_id',$order_id)->select('buyer_state')->first())->buyer_state;

        if($data=='已支付'){

            return 1;

        }else{

            return 0;

        }
    
    }

    function pay_success(){

        $pay_style = $_GET['pay_style'];

        $price = $_GET['price'];

        return view("Front.paysuccess",['pay_style'=>$pay_style,'price'=>$price]);


    }

    function go_back(){

        $order_id = $_GET['id'];

        $order_info = Order_info::where('order_id',$order_id)->first();

        if($order_info->buyer_state=='已支付'&&$order_info->express=='未发货'){

            $order_info::where('order_id',$order_id)->update(['buyer_handle'=>'退款','seller_handle'=>'待退款']);

            return "<script>alert('您已经发起退款,请安心等待处理');location.href='Front_home_index'</script>";

        }
    }
}
