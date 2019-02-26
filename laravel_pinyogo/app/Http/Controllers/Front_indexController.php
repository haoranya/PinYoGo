<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Libs\Qrcode;

use App\Models\Goods_type;

use App\Models\Seckill;

use App\Models\Good;

use App\Models\Goods_image;

use App\Models\Attribute;

use App\Models\Spec;

use App\Models\Ad;

use App\Models\Ad_group;

use App\Models\Ad_type;

use App\Models\Car;

use App\Models\Del_car;

use App\Models\Brand;

use App\Models\City;

use App\Models\Address;

use App\Models\Attr_spec;

use App\Models\Order;

use App\Models\Order_info;

use Storage;

use DB;

class Front_indexController extends Controller
{

    function qrcode(){

        Qrcode::qrcode();
 
     }
 

    function index(){

        // dd(session()->get('id'));

        $level_ones = Goods_type::where('level',1)->get();

        $goods_types = [];

        foreach($level_ones as $k=>$level_one){

            $level_one_id = $level_one->id;

            $level_twos = Goods_type::where('parent_id',$level_one_id)->get();

            $level_one->level_twos = $level_twos;

            foreach($level_twos as $kk=>$level_two){

                $level_two_id = $level_two->id;
                if($kk==0){

                $goods = Good::where('cat_two_id',$level_two_id)->where('seckill_state','!=','秒杀')->where('goods_state','审核通过')->orderBy('see_num', 'desc')->paginate(4);

                }else{

                $goods = Good::where('cat_two_id',$level_two_id)->where('seckill_state','!=','秒杀')->where('goods_state','审核通过')->orderBy('see_num', 'desc')->paginate(5);

                }
                $start = ($k*3);
                
                $ads = DB::table('Ads')->leftjoin('ad_types','ads.ad_type_id','=','ad_types.id')->leftjoin('ad_groups','ad_types.group_id','=','ad_groups.id')
                                       ->where('ads.ad_state','有效')->where('ad_types.ad_type','首页楼层轮播')->where('ad_groups.group','首页广告')
                                       ->select('ads.id','ads.ad_title','ads.url','ads.ad_logo','ad_types.ad_type','ad_groups.group')
                                       ->skip($start)->take(3)->get();
               
                foreach($goods as $good){
    
                    $goods_image = Goods_image::where('goods_id',$good->id)->first();
    
                    $good->image = $goods_image;
    
                }
    
                $level_two->goods = $goods;

                $level_two->ads = $ads;

                $level_threes = Goods_type::where('parent_id',$level_two_id)->get();

                $level_two->level_threes = $level_threes;

            }

            $goods_types[]=$level_one;

        }

            // dd($goods_types);
       
        return view("Front.index.index",['goods_types'=>$goods_types]);

    }

    function cart(){

        $cars = Car::where('user_id',session()->get('id'))->get();
       
        $car_arr = [];
        if($cars){
        foreach($cars as $car){

            $spec_id = $car->spec_id;
            // dd($spec_id);
            $number = (Attr_spec::where('spec_id',$spec_id)->select('number')->first())->number;
            // dd($number);
            $car->all_number = $number;

            $goods_id = $car->goods_id;

            $goods_info = Good::where('id',$goods_id)->first();

            $brand_id = $goods_info->brand_id;

            $goods_image = Goods_image::where('goods_id',$goods_id)->first();

            $goods_brand = (Brand::where('id',$brand_id)->first())->brand;

            $spec_arr = explode('-',$spec_id);

            array_pop($spec_arr);

            $spec_str = '';

            foreach($spec_arr as $spec){

                $spec_info = Spec::where('id',$spec)->first();

                $spec_name = $spec_info->spec;

                $attr_id = $spec_info->attribute_id;

                $attr_name = (Attribute::where('id',$attr_id)->first())->attribute;

                $spec_str.=$attr_name.'-'.$spec_name.',';

            }

             $car->attr_spec = $spec_str;

             $car->goods_info=$goods_info;

             $car->goods_image = $goods_image;

             $car->goods_brand = $goods_brand;
             
            $car_arr[]=$car;

        }
    }
        
        //删除的商品

        $del_car = Del_car::where('user_id',session()->get('id'))->orderBy('id','desc')->paginate(3);

        return view("Front.index.cart",['car_arr'=>$car_arr,'del_car'=>$del_car]);

    }

    function cooperation(){

        return view("Front.index.cooperation");

    }

    function getOrderinfo(){

        $car_id = $_GET['car_id'];

        $car_id_arr = explode(',',$car_id);

        array_pop($car_id_arr);

        $car_info_arr = [];

        foreach($car_id_arr as $id){

            $car_info = Car::where('id',$id)->first();

            $goods_name = (Good::where('id',$car_info->goods_id)->select('goods_name')->first())->goods_name;

            $car_info->goods_name = $goods_name;

            $goods_img = (Goods_image::where('goods_id',$car_info->goods_id)->select('logo')->first())->logo;

            $car_info->goods_img = $goods_img;

            $spec_id = $car_info->spec_id;

            $number = (Attr_spec::where('spec_id',$spec_id)->select('number')->first())->number;

            $car_info->all_number = $number;

            $spec_id_arr = explode('-',$spec_id);

            array_pop($spec_id_arr);

            $info = '';

            foreach($spec_id_arr as $spec){

                $spec_info = Spec::where('id',$spec)->first();

                $spec_name = $spec_info->spec;

                $attr_id = $spec_info->attribute_id;

                $attr_name = (Attribute::where('id',$attr_id)->select('attribute')->first())->attribute;

                $info .= $attr_name."-".$spec_name.",";

            }

            $car_info->info = $info;

            $car_info_arr[] = $car_info;

        }

        $city = City::where('level',0)->get();
        
        $address = Address::where('user_id',session()->get('id'))->get();

        $now_address = Address::where('user_id',session()->get('id'))->where('address_state','默认')->first();

        return view("Front.index.getOrderinfo",['city'=>$city,'address'=>$address,'car_info_arr'=>$car_info_arr,'now_address'=>$now_address]);

    }

    function home_index(Request $req){

        $orders = DB::table('orders')
        ->leftjoin('order_infos','order_infos.order_id','=','orders.id')
        ->leftjoin('attr_specs','attr_specs.spec_id','=','orders.spec_id')
        ->leftjoin('goods','goods.id','=','orders.goods_id')
        ->leftjoin('admins','admins.id','=','goods.shop_id')
        ->where('user_id',session()->get('id'))
        
        ->select('orders.id','orders.order','orders.spec_id','orders.goods_id','orders.order_num','orders.order_desc','goods.goods_name','admins.shop',
        'order_infos.buyer_state','order_infos.seller_state','order_infos.seller_handle','order_infos.buyer_handle',
        'order_infos.cheap','order_infos.express','order_infos.express_number','order_infos.order_area','order_infos.created_at','attr_specs.price')
        ->paginate(5);
        $order_arr = [];
        foreach($orders as $order){

            $spec_id = $order->spec_id;

            $spec_id_arr = explode('-',$spec_id);
            array_pop($spec_id_arr);

            $info = '';

            foreach($spec_id_arr as $spec){

                $spec_info = Spec::where('id',$spec)->select('spec','attribute_id')->first();

                $spec_name = $spec_info->spec;

                $attr_name = (Attribute::where('id',$spec_info->attribute_id)->select('attribute')->first())->attribute;


                $info.=$attr_name."->".$spec_name.",";

            }
            $order->info = $info;

            $order_arr[] = $order;
        }
        // dd($order_arr);
        return view("Front.index.home_index",['order_arr'=>$order_arr,'orders'=>$orders,'req'=>$req]);

    }

    function home_order_evaluate(){

        return view("Front.index.home_order_evaluate");

    }

    function home_order_pay(){

        return view("Front.index.home_order_pay");

    }

    function home_order_receive(){

        return view("Front.index.home_order_receive");

    }

    function home_order_send(){

        return view("Front.index.home_order_send");

    }

    function home_orderDetail(){

        $order_id = $_GET['id'];

        $order = Order::where('id',$order_id)->first();

        $order_info = Order_info::where('order_id',$order_id)->first();

        $address = Address::where('user_id',session()->get('id'))->where('address_state','默认')->first();

        $spec_id = $order->spec_id;

        $spec_id_arr = explode('-',$spec_id);

        array_pop($spec_id_arr);

        $info = '';

        foreach($spec_id_arr as $spec){

            $spec_info = Spec::where('id',$spec)->select('spec','attribute_id')->first();

            $spec_name = $spec_info->spec;

            $attr_name = (Attribute::where('id',$spec_info->attribute_id)->select('attribute')->first())->attribute;

            $info.=$attr_name."->".$spec_name.",";

        }

        $goods_name = (Good::where('id',$order->goods_id)->select('goods_name')->first())->goods_name;

        $attr_spec = Attr_spec::where('spec_id',$spec_id)->first();

        return view("Front.index.home_orderDetail",['order'=>$order,'order_info'=>$order_info,'address'=>$address,'info'=>$info,'goods_name'=>$goods_name,'attr_spec'=>$attr_spec]);

    }

    function home_person_collect(){

        return view("Front.index.home_person_collect");

    }

    function home_person_footmark(){

        return view("Front.index.home_person_footmark");

    }

    function home_setting_address_complete(){

        return view("Front.index.home_setting_address_complete");

    }

    function home_setting_address_phone(){

        return view("Front.index.home_setting_address_phone");

    }

    function home_setting_address(){

        $address = Address::where('user_id',session()->get('id'))->get();

        return view("Front.index.home_setting_address",['address'=>$address]);

    }

    function home_setting_info(){

        return view("Front.index.home_setting_info");

    }

    function home_setting_safe(){

        return view("Front.index.home_setting_safe");

    }

    function item(){

        $goods_id = $_GET['goods_id'];

        $goods_info  = Good::where('id',$goods_id)->first();

        $goods_image = Goods_image::where('goods_id',$goods_id)->first();

        $goods_type = [];

        $goods_type['one']=Goods_type::where('id',$goods_info->cat_one_id)->first();
        $goods_type['two']=Goods_type::where('id',$goods_info->cat_two_id)->first();
        $goods_type['three']=Goods_type::where('id',$goods_info->cat_three_id)->first();

        $attribute_info = Attribute::where('goods_id',$goods_id)->get();

        $attribute_arr = [];

        foreach($attribute_info as $attribute){

            $spec_info = Spec::where('attribute_id',$attribute->id)->get();

            $attribute->spec_info = $spec_info;

            $attribute_arr[]=$attribute;

        }
        
        return view("Front.index.item",['goods_info'=>$goods_info,'goods_image'=>$goods_image,'attribute_arr'=>$attribute_arr,'goods_type'=>$goods_type]);

    }

    function pay(Request $req){
      
        foreach($req->car_id as $car_id){

            $order = date("Ymdhis").rand(10000000,99999999);

            $car_info = Car::where('id',$car_id)->first();

            $name = 'order_desc'.$car_id;

            $order_desc = $req->$name;

            if($order_desc==null){

                $order_desc = '暂无要求';

            }

            $shop_id = (Good::where('id',$car_info->goods_id)->select('shop_id')->first())->shop_id;

            $order_obj = new Order;
           
            $order_obj->order = $order;

            $order_obj->user_id = session()->get('id');

            $order_obj->goods_id = $car_info->goods_id;

            $order_obj->shop_id = $shop_id;

            $order_obj->order_num = $car_info->number;

            $order_obj->spec_id = $car_info->spec_id;

            $order_obj->order_desc = $order_desc;

            $order_obj->save();

            $order_id = $order_obj->id;

            Order_info::insert(['order_id'=>$order_id]);

            Attr_spec::where('spec_id',$car_info->spec_id)->decrement('number',$car_info->number);

            Car::where('id',$car_id)->delete();

        }

       

        return view("Front.index.pay");

    }

    function payfail(){

        return view("Front.index.payfail");

    }

    function paysuccess(){

        $pay_style = $_GET['pay_style'];

        $price = $_GET['price'];

        return view("Front.index.paysuccess",['pay_style'=>$pay_style,'price'=>$price]);

    }

    function sampling(){

        return view("Front.index.sampling");

    }

    function search(){


        return view("Front.index.search");

    }

    function seckill_item(){

        $goods_id = $_GET['goods_id'];

        $goods_info = Good::where('id',$goods_id)->first();

        $goods_image = Goods_image::where('goods_id',$goods_id)->first();

        $seckill_info = Seckill::where('goods_id',$goods_id)->first();

        $attributes = Attribute::where('goods_id',$goods_id)->get();

        $attribute_arr = [];

        foreach($attributes as $attribute){

            $specs = Spec::where('attribute_id',$attribute->id)->get();

            $attribute->specs = $specs;

            $attribute_arr [] = $attribute;

        }
      
        return view("Front.index.seckill_item",['goods_image'=>$goods_image,'goods_info'=>$goods_info,'seckill_info'=>$seckill_info,'attribute_arr'=>$attribute_arr]);

    }

    function seckill_index(){

        $seckills = Seckill::where('seckill','开始')->get();

        $seckill_arr = [];

        foreach($seckills as $seckill){

            $goods_id = $seckill->goods_id;

            $goods_image = Goods_image::where('goods_id',$goods_id)->first();

            $goods_info = Good::where('id',$goods_id)->first();

            $seckill->goods_info = $goods_info;

            $seckill->goods_image = $goods_image;

            $seckill_arr [] = $seckill;

        }

        return view("Front.index.seckill_index",['seckill_arr'=>$seckill_arr]);

    }

    function shop(){

        return view("Front.index.shop");

    }

    function success_cart(){

        return view("Front.index.success_cart");

    }



}
