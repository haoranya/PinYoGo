<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;

use App\Models\Order_info;

use App\Models\Good;

use App\Models\Goods_type;

use App\Models\Address;

use App\Models\Goods_image;

use App\Models\spec;

use App\Models\Attribute;

use App\Models\User;

use DB;

use Storage;

class Admin_orderController extends Controller
{
    function order_page(){
        $admin_id = session()->get('admin_id');
        $data = DB::table('orders')
        ->leftjoin('order_infos','orders.id','=','order_infos.order_id')
        ->leftjoin('goods','orders.goods_id','=','goods.id')
        ->leftjoin('goods_types','goods.cat_one_id','=','goods_types.id')
        ->select('orders.id','orders.goods_id','orders.created_at','orders.order','orders.order_num','order_infos.seller_state','order_infos.order_area',
                'order_infos.cheap','goods.goods_name','goods.cat_one_id','goods.cat_two_id','goods.cat_three_id','goods.brand_id','goods.price','goods_types.goods_type')
        ->where('order_infos.buyer_state','!=','待支付')
        ->where('orders.shop_id',$admin_id)
        ->get();
      
        $orders = DB::select("select count(goods.cat_one_id) as num ,goods.cat_one_id from orders left join goods on orders.goods_id = goods.id left join
        goods_types on goods_types.id = goods.cat_one_id where orders.shop_id={$admin_id} group by goods.cat_one_id");
     
        $types = Goods_type::where('level',1)->get();
   
        $arr = [];

        $state = 0;
   
       foreach($types as $k=>$type){
   
           foreach($orders as $kk=>$order){
                
               if($type->id==$order->cat_one_id){
   
                   $id = $k+1;
   
                   $arr[]=['id'=>$type->id,'name'=>$type->goods_type,'amount'=>$order->num,'pid'=>$type->parent_id];  

                   $state = 1;
               }

           }

           if($state == 0){

               $id = $k+1;

               $arr[]=['id'=>$type->id,'name'=>$type->goods_type,'amount'=>0,'pid'=>$type->parent_id];

           }else{

                $state = 0;

                continue ;

           }

       }    
        
       return view("Admin.order.order_page",['data'=>$data,'arr'=>$arr]);

        
    }

    function order_ajax(){
        $admin_id = session()->get('admin_id');

        $orders = DB::select("select count(goods.cat_one_id) as num ,goods.cat_one_id from orders left join goods on orders.goods_id = goods.id left join
        goods_types on goods_types.id = goods.cat_one_id where orders.shop_id={$admin_id} group by goods.cat_one_id");
   
        $types = Goods_type::where('level',1)->where('admin_id',$admin_id)->get();

        $arr = [];

        $state = 0;

       foreach($types as $k=>$type){
   
        foreach($orders as $kk=>$order){
             
            if($type->id==$order->cat_one_id){

                $id = $k+1;
   
                $arr[]="{id:$type->id,name:'$type->goods_type',amount: $order->num,pid:$type->parent_id}";

                $state = 1;     
            }

        }

        if($state == 0){

            $id = $k+1;
   
                   $arr[]="{id:$type->id,name:'$type->goods_type',amount:0,pid:$type->parent_id}";

        }else{

             $state = 0;

             continue ;

        }

        

    }
        
       return  $arr;

    }

    function order_del(){

        $id = $_GET['id'];

        $order_info = Order_info::where('order_id',$id)->first();   

        dd($order_info);

        if($order_info['buyer_state']=='已收货'||$order_info['buyer_state']=='待评价'||$order_info['buyer_state']=='已评价'){

            if($order_info->seller_state=='已支付'){

                Order::where('id',$id)->delete();

                Order_info::where('order_id',$id)->delete();

                return "<script>alert('删除成功');location.href='Admin_order_page'</script>";

            }else{

                return "<script>alert('商家没有支付{{$order_info->seller_state}},不可以删除');location.href='Admin_order_page'</script>";

            }

        }else{

            return "<script>alert('此订单状态是{{$order_info['buyer_state']}},不可以删除');location.href='Admin_order_page'</script>";

        }

    }

    function order_content(){

        $id = $_GET['id'];

        $order = Order::where('id',$id)->first();

        $order_spec = $order->spec_id;

        $order_spec_arr = explode('-',$order_spec);

        $spec_arr = [];

        array_pop($order_spec_arr);

        foreach($order_spec_arr as $spec){

            $spec_info = Spec::where('id',$spec)->first();

            $attr_info = Attribute::where('id',$spec_info['attribute_id'])->first();

            $spec_info['attr_name']=$attr_info['attribute'];

            $spec_arr [] =$spec_info;
        
        }

        $goods_id = $order->goods_id;

        $address = Address::where('user_id',$order->user_id)->first();

        $order_info = Order_info::where('order_id',$id)->first();

        $goods = Good::where('id',$goods_id)->first();

        $goods_image = Goods_image::where('goods_id',$goods_id)->first();
        
        return view('Admin.order.order_content',['order'=>$order,'order_info'=>$order_info,'goods'=>$goods,'address'=>$address,'goods_image'=>$goods_image,'spec_arr'=>$spec_arr]);

    }

    function order_send(){

        $order_id = $_GET['order_id'];

        $express = $_GET['express'];

        $express_number = $_GET['express_number'];

        $updated_at = date('Y-m-d h:i:s');

        Order_info::where('order_id',$order_id)->update(['updated_at'=>$updated_at,'buyer_state'=>'待收货','seller_state'=>'已发货','express'=>$express,'express_number'=>$express_number]);

        return 1;
    }

    function refund_page(){

        $admin_id = session()->get('admin_id');

        $refund_orders = DB::table('orders')
        ->leftjoin('order_infos','orders.id','=','order_infos.order_id')
        ->leftjoin('goods','orders.goods_id','=','goods.id')
        ->select('orders.updated_at','orders.id','orders.order','orders.order_num','orders.order_desc','order_infos.express','order_infos.seller_state','order_infos.seller_handle','goods.goods_name','goods.desc','goods.price','goods.seckill_state')
        ->where('buyer_state','!=','未支付')
        ->where('buyer_handle','!=','正常')
        ->where('goods.shop_id',$admin_id)
        ->paginate(2);

        // dd($refund_orders);
        return view('Admin.order.refund_page',['refund_orders'=>$refund_orders]);

    }

    function refund_content(){

        $order_id = $_GET['id'];

        $orders = Order::where('id',$order_id)->first();

        $order_infos = Order_info::where('order_id',$order_id)->first();

        $goods_id = $orders->goods_id;

        $goods = Good::where('id',$goods_id)->first();

        $images = Goods_image::where('goods_id',$goods_id)->first();

        $user_id = $orders->user_id;

        $address = Address::where('user_id',$user_id)->first();

        $spec_id = $orders->spec_id;

        $spec_arr = explode('-',$spec_id);
        $specs = [];
        foreach($spec_arr as $spec){

            $spec_info = Spec::where('id',$spec)->first();

            $attr_id = $spec_info->attribute_id;

            $attr_info = Attribute::where('id',$attr_id)->first();

            $spec_info['attr_name']=$attr_info->attribute;

            $specs [] =$spec_info;

        }

        // dd($specs);

        return view('Admin.order.refund_content',['orders'=>$orders,'order_infos'=>$order_infos,'goods'=>$goods,'images'=>$images,'address'=>$address,'specs'=>$specs]);

    }
}
