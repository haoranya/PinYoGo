<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Car;

use App\Models\Del_car;

use App\Models\Spec;

use App\Models\Attribute;

use App\Models\Good;

use App\Models\Collect;

class Front_cartController extends Controller
{
    function add_cart(Request $req){

        $car = new Car;

        $car->fill($req->all());
      
        $car->price = $req->price;

        $car->save();

        return "<script>alert('添加成功');location.href='Front_cart';</script>";

    }

    function del_cart(){

        $id = $_GET['id'];

        $car = Car::where('id',$id)->first();

        $spec_id = $car->spec_id;

        $goods_id = $car->goods_id;

        $goods_info = Good::where('id',$goods_id)->select('price','goods_name')->first();

        $goods_name = $goods_info->goods_name;

        $price = $car->price;

        $spec_arr = explode('-',$spec_id);

        array_pop($spec_arr);

        $info = $goods_name.", ";

        foreach($spec_arr as $spec){

            $spec_info = Spec::where('id',$spec)->first();

            $spec_name = $spec_info->spec;

            $attribute_id = $spec_info->attribute_id;

            $attribute_info = Attribute::where('id',$attribute_id)->first();

            $attribute_name = $attribute_info->attribute;

            $info.=$attribute_name."-".$spec_name.",";

        }

        Del_car::insert(['goods_id'=>$goods_id,'user_id'=>session()->get('id'),'spec_id'=>$spec_id,'info'=>$info,'price'=>$price]);

        Car::where('id',$id)->delete();

        return "<script> alert('删除成功');location.href='Front_cart';</script>";

    }

    function move_cart(){

        $type = $_GET['type'];

        $id = $_GET['id'];
     
        if($type=='car'){
          
            $info = Car::where('id',$id)->first();

            Car::where('id',$id)->delete();

        }else{
            
            $info = Del_car::where('id',$id)->first();

            Del_car::where('id',$id)->delete();
            
        }

        Collect::insert(['goods_id'=>$info->goods_id,'user_id'=>$info->user_id,'spec_id'=>$info->spec_id,'number'=>1,'price'=>$info->price]);

        return "<script> alert('移动成功');location.href='Front_cart';</script>";

    }

    function readd_cart(){

        $id = $_GET['id'];

        $del_car = Del_car::where('id',$id)->first();

        Car::insert(['goods_id'=>$del_car->goods_id,'number'=>1,'user_id'=>session()->get('id'),'spec_id'=>$del_car->spec_id,'price'=>$del_car->price]);

        Del_car::where('id',$id)->delete();

        return "<script> alert('重新加入成功');location.href='Front_cart';</script>";

    }

    function del_delcart(){

        $id = $_GET['id'];

        Del_car::where('id',$id)->delete();

        return "<script> alert('删除成功');location.href='Front_cart';</script>";
        
    }

    function set_pay(){

        $car_nums = $_GET['car_num'];

        $car_num_arr = explode(',',$car_nums);

        array_pop($car_num_arr);

        foreach($car_num_arr as $car_num){

            $data = explode('-',$car_num);

            Car::where('id',$data['0'])->update(['number'=>$data[1]]);

        }

        return 1;

    }
}
