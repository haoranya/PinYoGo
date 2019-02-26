<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;

use App\Models\Good;

use App\Models\Attribute;

use App\Models\Spec;

use App\Models\Goods_image;

use Storage;

class Manager_shopController extends Controller
{
    function shop_agree(Request $req){

        $admin = Admin::paginate(1);

        return view("Manager.shop.shop_agree",['admin'=>$admin,'req'=>$req]);

    }

    function shop_start(){

        $id = $_GET['id'];

        Admin::where('id',$id)->update(['shop_state'=>'审核成功']);

        return "<script>alert('审核成功');location.href='Manager_shop_agree';</script>";

    }

    function shop_stop(){

        $id = $_GET['id'];
     
        Admin::where('id',$id)->update(['shop_state'=>'驳回']);
        
        return "<script>alert('驳回成功');location.href='Manager_shop_agree';</script>";
        
    }

    function shop_del(){

        $id = $_GET['id'];

        $goods = Good::where('shop_id',$id)->get();

        foreach($goods as $good){

            $attrs = Attribute::where('goods_id',$good->id)->get();
            
            foreach($attrs as $attr){

                Spec::where('attribute_id',$attr->id)->delete();

            }
            Attribute::where('goods_id',$good->id)->delete();

            $goods_images = Goods_image::where('goods_id',$good->id)->get();

            foreach($goods_images as $goods_image){

                $imgs = json_decode($goods_image->imgs);

                foreach($imgs as $img){

                    Storage::delete($img);

                    Storage::delete('big/'.$img);

                }

                Storage::delete($goods_image->logo);

                Storage::delete('big/'.$goods_image->logo);

            }

            Goods_image::where('goods_id',$good->id)->delete();

        }

        Good::where('shop_id',$id)->delete();

        Admin::where('id',$id)->delete();

        return "<script>alert('删除成功');location.href='Manager_shop_agree';</script>";

    }

}
