<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artical_type;

use App\Models\Artical;

class Manager_articalController extends Controller
{
    function artical_list(Request $req){

        $articals = Artical::paginate(2);

        $artical_arr = [];

        foreach($articals as $artical){

            $artical_type = (Artical_type::where('id',$artical->type)->first())['type_name'];

            $artical->artical_type = $artical_type;

            $artical_arr [] =$artical;

        }

        return view("Manager.artical.artical_list",['artical_arr'=>$artical_arr,'articals'=>$articals,'req'=>$req]);

    }

    function artical_add(){

        $artical_types = Artical_type::get();

        return view("Manager.artical.artical_add",['artical_types'=>$artical_types]);

    }

    function artical_doadd(Request $req){

        if($req->content==null){

            return back()->withInput()->with('error_content','内容不可以为空');

        }

        $artical = new Artical;

        $artical->fill($req->all());

        $artical->save();

        return "<script>alert('文章添加成功');location.href='Manager_artical_list';</script>";

    }

    function artical_edit(){

        $artical_types = Artical_type::get();

        $id = $_GET['id'];

        $artical_info = Artical::where('id',$id)->first();

        return view("Manager.artical.artical_edit",['artical_types'=>$artical_types,'artical_info'=>$artical_info]);

    }

    function artical_update(Request $req){

        $id = $_GET['id'];

        $num = Artical::where('id',$id)->update(['title'=>$req->title,'sort'=>$req->sort,'desc'=>$req->desc,'type'=>$req->type,'content'=>$req->content]);

        if($num==1){

         return "<script>alert('文章修改成功');location.href='Manager_artical_list';</script>";

       }

    }

    function artical_del(){

        $id= $_GET['id'];

        $num = Artical::where('id',$id)->delete();

        if($num==1){

            return "<script>alert('文章删除成功');location.href='Manager_artical_list';</script>";

        }

    }

    function artical_page(Request $req){

        $artical_types = Artical_type::paginate(2);

        return view("Manager.artical.artical_page",['req'=>$req,'artical_types'=>$artical_types]);               

    }

    function artical_type_add(Request $req){

        if($req->type_desc==null){

            $req->type_desc='暂无描述';

        }

        $data = Artical_type::where('type_name',$req->type_name)->first();
        
        if(!$data){

            $num = Artical_type::insert(['type_name'=>$req->type_name,'type_desc'=>$req->type_desc]);

            if($num==1){
                
                return "<script>alert('文章分类添加成功');location.href='Manager_artical_page';</script>";
            
            }

        }else{

             return back()->withInput()->with('error_type','此分类已经存在');

        }
    }

    function artical_type_update(Request $req){

        $type_name = $req->type_name;

        $type_desc = $req->type_desc;

        $type_id = $req->type_id;

        $data = Artical_type::where('type_name',$type_name)->where('id','!=',$type_id)->first();

        if(!$data){

            $num = Artical_type::where('id',$type_id)->update(['type_name'=>$type_name,'type_desc'=>$type_desc]);

            if($num==1){

                return "<script>alert('文章分类修改成功');location.href='Manager_artical_page';</script>";

            }

        }else{

            return back()->withInput()->with('error_type','此分类已经存在');

        }

    }

    function artical_type_del(){

        $type_id = $_GET['id'];

        Artical::where('type',$type_id)->delete();

        Artical_type::where('id',$type_id)->delete();

        return "<script>alert('文章分类删除成功');location.href='Manager_artical_page';</script>";

    }
}
