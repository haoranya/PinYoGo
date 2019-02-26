<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seckill;

use App\Models\Good;

use App\Http\Requests\SeckillRequest;

use DB;

use Storage;

class Admin_skillController extends Controller
{
    function goods_skill(Request $req){

        $seckill = DB::table('seckills')
        ->leftjoin('goods_images', 'goods_images.goods_id', '=', 'seckills.goods_id')
        ->select('goods_images.logo','seckills.stock_num','goods_images.imgs','seckills.seckill','seckills.start','seckills.over','seckills.title','seckills.goods_id','seckills.id')
        ->where('seckills.admin_id',session()->get('admin_id'))
        ->paginate(1);
      
        

        return view('Admin.skill.skill_page',['seckill'=>$seckill,'req'=>$req]);

    }

    function seckill_start(SeckillRequest $req){

       $id = $req->seckill_id;

       $goods_id = $req->goods_id;

       $goods_info = Good::find($goods_id);

       if($goods_info->goods_state!='审核通过'){

        return "<script>if(confirm('此商品{{$goods_info->goods_state}},请等待审核通过?')){location.href='Admin_goods_skill';}else{location.href='Admin_goods_skill'}</script>";

       }

       $title = $req->title;

       $start = $req->start;

       $over = $req->over;

       $date = date("Y-m-d");

       if($over<$date){

        return back()->withInput()->with('error_over','结束时间应大于等于今天的日期');

       }else if($over<$start){

        return back()->withInput()->with('error_over','结束时间应大于等于开始的日期');

       }

       Seckill::where('id',$id)->update(['seckill'=>'开始','start'=>$start,'over'=>$over,'title'=>$title]);

       return "<script>if(confirm('开启成功,是否继续操作?')){location.href='Admin_goods_skill';}else{location.href='Admin_goods_skill'}</script>";

    }

    function seckill_close(){

        $id = $_GET['seckill_id'];

        Seckill::where('id',$id)->update(['seckill'=>'等待','start'=>null,'over'=>null,'title'=>'']);

        return 1;

    }
}
