<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AdRequest;

use App\Http\Requests\Ad_updateRequest;

use App\Models\Ad_type;

use App\Models\Ad_group;

use App\Models\Ad;

use Storage;

class Admin_adController extends Controller
{
    function ad_page(Request $req){

        $ad_groups = Ad_group::get();

        $ads = Ad::where('admin_id',session()->get('admin_id'))->paginate(2);

        return view("Admin.ad.ad",['group'=>$ad_groups,'ads'=>$ads,'req'=>$req]);

    }

    function ad_add(AdRequest $req){

        $ad = new Ad;

        $ad_type_id = $req->ad_type_id;

        $ad_title = $req->ad_title;

        $ad_info = Ad::where('ad_type_id',$ad_type_id)->where('ad_title',$ad_title)->first();

        if($ad_info!=null){

            return back()->withInput()->with('error_ad','此分类下广告已经存在');

        }else{

            $date = date("Y-m-d");

            if($req->has('ad_logo')&&$req->ad_logo->isValid()){
    
                $ad_dir = $req->ad_logo->store('ad_'.$date);
    
            }
    
            $ad->fill($req->all());
    
            $ad->ad_logo=$ad_dir;

            $ad->admin_id = session()->get('admin_id');
    
            $ad->save();
    
            return "<script>if(confirm('广告添加成功,是否继续添加?')){location.href='Admin_ad_page';}else{location.href='Admin_ad_page'}</script>";

        }
    }

    function ad_edit(){

        $ad_groups = Ad_group::get();

        $id = $_GET['id'];

        $ad = Ad::where('id',$id)->first();

        $ad_type_id = $ad->ad_type_id;

        $group_id  = (Ad_type::where('id',$ad_type_id)->select('group_id')->first())['group_id'];

        return view('Admin.ad.ad_edit',['ad_groups'=>$ad_groups,'ad'=>$ad,'group_id'=>$group_id]);

    }

    function ad_update(Ad_updateRequest $req){

        $id = $_GET['id'];

        $ad = Ad::find($id);

        $ad_dir = $ad->ad_logo;

        if($req->ad_logo!=null){

            Storage::delete($ad->ad_logo);

            $date = date("Y-m-d");

            if($req->has('ad_logo')&&$req->ad_logo->isValid()){
    
                $ad_dir = $req->ad_logo->store('ad_'.$date);
    
            }

        }

        Ad::where('id',$id)->update(['ad_title'=>$req->ad_title,'ad_type_id'=>$req->ad_type_id,'url'=>$req->url,'ad_logo'=>$ad_dir]);

        return "<script>if(confirm('广告更新成功,是否继续更新?')){location.href='Admin_ad_page';}else{location.href='Admin_ad_page'}</script>";

    }

    function ad_del(){

        $ad = Ad::where('id',$_GET['id'])->first();

        Storage::delete($ad->ad_logo);

        Ad::where('id',$_GET['id'])->delete();

        return "<script>if(confirm('广告删除成功,是否继续删除?')){location.href='Admin_ad_page';}else{location.href='Admin_ad_page'}</script>";

    }

    function ad_get_type(){

        $ad_types = Ad_type::where('group_id',$_GET['group_id'])->get();

        return $ad_types;

    }
}
