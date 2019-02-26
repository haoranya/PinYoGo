<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Good;

use App\Models\Goods_type;

use App\Models\Admin;

class Manager_goodsController extends Controller
{
    function goods_agree(Request $req){

        $goods = Good::paginate(2);

        $goods_arr = [];

        foreach($goods as $good){

            $cat_one_id = $good->cat_one_id;
            $cat_two_id = $good->cat_two_id;
            $cat_three_id = $good->cat_three_id;

            $cat_one_name = (Goods_type::where('id',$cat_one_id)->select('goods_type')->first())['goods_type'];
            $cat_two_name = (Goods_type::where('id',$cat_two_id)->select('goods_type')->first())['goods_type'];
            $cat_three_name = (Goods_type::where('id',$cat_three_id)->select('goods_type')->first())['goods_type'];

            $good->cat_one_name = $cat_one_name;
            $good->cat_two_name = $cat_two_name;
            $good->cat_three_name = $cat_three_name;

            $goods_arr [] = $good;

        }
        
        return view("Manager.goods.goods_agree",['goods_info'=>$goods,'req'=>$req,'goods_arr'=>$goods_arr]);

    }

    function goods_ok(){

        $goods_id = $_GET['id'];
        
        $shop_id = (Good::where('id',$goods_id)->select('shop_id')->first())->shop_id;

        $shop_state = (Admin::where('id',$shop_id)->select('shop_state')->first())->shop_state;

        if($shop_state=='审核成功'){

            $num = Good::where('id',$goods_id)->update(['goods_state'=>'审核通过']);

            if($num==1){
    
                return "<script>alert('通过成功');location.href='Manager_goods_agree';</script>";
    
            }

        }else{

            return "<script>alert('通过失败,此商品的店铺未通过审核');location.href='Manager_goods_agree';</script>";

        }

       

    }

    function goods_no(){

        $goods_id = $_GET['id'];

        $shop_id = (Good::where('id',$goods_id)->select('shop_id')->first())->shop_id;

        $shop_state = (Admin::where('id',$shop_id)->select('shop_state')->first())->shop_state;

        if($shop_state=='审核成功'){

            $num = Good::where('id',$goods_id)->update(['goods_state'=>'已驳回']);

            if($num==1){
    
                return "<script>alert('驳回成功');location.href='Manager_goods_agree';</script>";
    
            }

        }else{


            return "<script>alert('驳回失败,此商品的店铺未通过审核');location.href='Manager_goods_agree';</script>";

        }

      

    }
}
