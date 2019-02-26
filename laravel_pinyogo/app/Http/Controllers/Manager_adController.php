<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Ad_typeRequest;

use App\Http\Requests\Ad_groupRequest;

use App\Models\Ad_type;

use App\Models\Ad_group;

use App\Models\Ad;

use Storage;

class Manager_adController extends Controller
{
    
    function ad_page(Request $req){

        $ad_groups = Ad_group::get();

        $ads = Ad::paginate(2);

        return view("Manager.ad.ad",['group'=>$ad_groups,'ads'=>$ads,'req'=>$req]);

    }

    function ad_get_type(){

        $ad_types = Ad_type::where('group_id',$_GET['group_id'])->get();

        return $ad_types;

    }

    function ad_type(Request $req){

        $ad_groups = Ad_group::get();

        $ad_types = Ad_type::paginate(2);

        foreach($ad_types as $v){

            $ad_group = Ad_group::where('id',$v['group_id'])->select(['group'])->first();

            $v['ad_group']=$ad_group['group'];
        }
        
        return view("Manager.ad.ad_type",['group'=>$ad_groups,'ad_types'=>$ad_types,'req'=>$req]);
        
    }

    function ad_add_type(Ad_typeRequest $req){

        $ad_type_obj = new Ad_type;

        $ad_type = $req->ad_type;

        $group_id = $req->group_id;

        $ad_type_info = Ad_type::where('group_id',$group_id)->where('ad_type',$ad_type)->first();

        if($ad_type_info){

            return back()->withInput()->with('error_ad_type','此分类已经存在');

        }

        $ad_type_obj->fill($req->all());

        $ad_type_obj->save();

        return "<script>if(confirm('广告类型添加成功,是否继续添加?')){location.href='Manager_ad_type';}else{location.href='Manager_ad_type'}</script>";

    }

    function ad_type_edit(){

        $ad_type_id = $_GET['id'];

        $ad_type_info = Ad_type::where('id',$ad_type_id)->first();

        $ad_groups = Ad_group::get();

        return view('Manager.ad.ad_type_edit',['ad_type_info'=>$ad_type_info,'ad_groups'=>$ad_groups]);

    }

    function ad_type_update(Ad_typeRequest $req){

        $ad_type = $req->ad_type;

        $group_id = $req->group_id;

        $ad_type_info = Ad_type::where('ad_type',$ad_type)->where('group_id',$group_id)->first();

        if($ad_type_info==null){

            Ad_type::where('id',$req->id)->update(['ad_type'=>$ad_type,'group_id'=>$group_id,'key'=>$req->key]);

        }else{

            return back()->withInput()->with('error_ad_type','此分组下已经存在这个分类');

        }

        return "<script>if(confirm('广告类型修改成功,是否继续修改?')){location.href='Manager_ad_type';}else{location.href='Manager_ad_type'}</script>";  
    }

    function ad_del_type(Request $req){

        $ads = Ad::where('ad_type_id',$req->id)->select(['ad_logo'])->get();

        foreach($ads as $v){

            Storage::delete($v['ad_logo']);

        }

        Ad_type::where('id',$req->id)->delete();

        Ad::where('ad_type_id',$req->id)->delete();

        return "<script>if(confirm('广告类型删除成功,是否继续添加?')){location.href='Manager_ad_type';}else{location.href='Manager_ad_type'}</script>";  

    }

    function ad_add_group(Ad_groupRequest $req){

        $ad_group = new Ad_group;

        $ad_group->fill($req->all());

        $ad_group->save();

        return "<script>if(confirm('分组添加成功,是否继续添加?')){location.href='Manager_ad_type';}else{location.href='Manager_ad_type'}</script>";

    }

    function ad_update_group(Request $req){

        $group_id = $req->group_id;

        $group = $req->group;

        if($group==null){

            return back()->withInput()->with('error_group','广告组名不能为空');

        }

        $group_info = Ad_group::where('group',$group)->first();

        if($group_info){

            return back()->withInput()->with('error_group','广告组名已经存在');

        }

        Ad_group::where('id',$group_id)->update(['group'=>$group]);

        return "<script>if(confirm('分组修改成功,是否继续修改?')){location.href='Manager_ad_type';}else{location.href='Manager_ad_type'}</script>";

    }

    function ad_del_group(Request $req){

        $group_id = $req->group_id;

        Ad_group::where('id',$group_id)->delete();

        $ad_type_id = Ad_type::where('group_id',$group_id)->select(['id'])->get();

        foreach($ad_type_id as $v){

            $ads = Ad::where('ad_type_id',$v['id'])->select(['ad_logo'])->get();

            foreach($ads as $vv){

                Storage::delete($vv['ad_logo']);

            }

            Ad::where('ad_type_id',$v['id'])->delete();

        }

        Ad_type::where('group_id',$group_id)->delete();

        return "<script>if(confirm('分组删除成功,是否继续删除?')){location.href='Manager_ad_type';}else{location.href='Manager_ad_type'}</script>";
    }

    function ad_list(Request $req){

        $ads = Ad::paginate(2);

        return view('Manager.ad.ad_list',['ads'=>$ads,'req'=>$req]);

    }

    function ad_start(){

       $id = $_GET['id'];

       $num = AD::where('id',$id)->update(['ad_state'=>'有效']);

       if($num==1){

        return "<script>alert('开启成功');location.href='Manager_ad_list';</script>";


       }

    }

    function ad_stop(){

       $id = $_GET['id'];   
       
       $num = AD::where('id',$id)->update(['ad_state'=>'无效']);

       if($num==1){

        return "<script>alert('屏蔽成功');location.href='Manager_ad_list';</script>";


       }

    }

}
