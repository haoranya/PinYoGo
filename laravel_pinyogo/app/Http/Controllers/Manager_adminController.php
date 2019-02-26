<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Manager;

use App\Models\Power;

use App\Models\Privates;

use DB;

class Manager_adminController extends Controller
{
    function admin_list(Request $req){

        $managers = Manager::paginate(2);

        $manager_arr = [];

        foreach($managers as $manager){

            $power = Power::where('manager_id',$manager->id)->first();

            $manager->power = $power->power;

            $manager->power_id = $power->id;

            $manager_arr [] = $manager;

        }

        //查询所有的权限

        $privates  = Privates::get();

        return view("Manager.admin.admin_list",['managers'=>$managers,'manager_arr'=>$manager_arr,'req'=>$req,'privates'=>$privates]);

    }

    function admin_start(){

        $manager_id = $_GET['manager_id'];

        Manager::where('id',$manager_id)->update(['state'=>'已启用']);

        return 1;

    }

    function admin_stop(){

        $manager_id = $_GET['manager_id'];

        Manager::where('id',$manager_id)->update(['state'=>'已停用']);

        return 1;        
     
    }

    function admin_del(){

        $manager_id = $_GET['manager_id']; 
        
        Manager::where('id',$manager_id)->delete();

        Power::where('manager_id',$manager_id)->delete();

        return 1;

    }

    function admin_add(Request $req){

            $manager = new Manager;

            $manager->fill($req->all());

            $manager->password = md5($req->password);

            $manager->save();

            $manager_id = $manager->id;

            Power::insert(['manager_id'=>$manager_id,'private_id'=>$req->power]);

            return "<script>alert('添加成功');location.href='Manager_admin_list';</script>";

    }

    function admin_edit(){

        //查询所有的权限

        $manager_id = $_GET['id'];

        $private_id = (Power::where('manager_id',$manager_id)->select('private_id')->first())['private_id'];

        $privates  = Privates::get();

        return view("Manager.admin.admin_edit",['privates'=>$privates,'private_id'=>$private_id,'manager_id'=>$manager_id]);

    }

    function admin_update(Request $req){

        $manager_id = $_GET['manager_id'];

        Power::where('manager_id',$manager_id)->update(['private_id'=>$req->power]);

        return "<script>alert('修改成功');location.href='Manager_admin_list';</script>";

    }

    function admin_power(){

        //查询所有的权限

        $privates = Privates::get();
        $private_arr = [];
        foreach($privates as $private){

            $manager_id_arr = Power::where('private_id',$private->id)->select('manager_id')->get();
            $manager_arr=[];
            foreach($manager_id_arr as $manager_id){

                $manager = (Manager::where('id',$manager_id->manager_id)->select('manager')->first())['manager'];

                $private->manager = $manager;

                $manager_arr[]=$manager;

            }

            $private->manager = $manager_arr;

            $private_arr[]=$private;

        }

        return view("Manager.admin.admin_power",['private_arr'=>$private_arr]);  

    }

    function admin_power_add(){

        return view("Manager.admin.admin_power_add");

    }

    function admin_power_doadd(Request $req){

        $power_name = $req->private_name;

        $private = $req->private;

        $data=Privates::where('power_name',$power_name)->first();

        if(!$data){

            $num = Privates::insert(['power_name'=>$power_name,'private'=>$private]);

            if($num==1){

                return "<script>alert('权限添加成功');location.href='Manager_admin_power';</script>";

            }

        }else{

            return back()->withInput()->with('error_private','此权限名称已经存在');

        }

    }

    function admin_power_edit(){

        $private_id = $_GET['id'];

        $private = Privates::where('id',$private_id)->first();

        $private_str = $private->private;

        if($private_str!==null){

            $private_arr = explode(',',$private_str);

            array_pop($private_arr); 

        }else{

            $private_arr=false;

        }

        return view("Manager.admin.admin_power_edit",['private'=>$private,'private_arr'=>$private_arr]);

    }

    function admin_power_update(Request $req){

        $id = $req->id;

        $power_name = $req->private_name;

        $private = $req->private;

        $data = Privates::where('power_name',$power_name)->where('id','!=',$id)->first();

        if(!$data){

            $num = Privates::where('id',$id)->update(['power_name'=>$power_name,'private'=>$private]);
            if($num==1){
            return  "<script>alert('权限修改成功');location.href='Manager_admin_power';</script>";
            }
        }else{

            return back()->withInput()->with('error_private','此权限名称已经存在');

        }

    }

    function admin_power_del(){

        $private_id = $_GET['id'];

        $power_info = Power::where('private_id',$private_id)->get();

        foreach($power_info as $power){

            Manager::where('id',$power->manager_id)->delete();

        }

        Power::where('private_id',$private_id)->delete();

        Privates::where('id',$private_id)->delete();

        return "<script>alert('权限删除成功');location.href='Manager_admin_power';</script>";

    }

    function admin_info(){

        $id = session()->get('manager_id');

        if(!$id){

            $id = 1;

        }

        $manager_info = Manager::where('id',$id)->first();

        $private_id = (Power::where('manager_id',$id)->select('private_id')->first())->private_id;

        $private = (Privates::where('id',$private_id)->select('power_name')->first())->power_name;

        return view("Manager.admin.admin_info",['manager_info'=>$manager_info,'private'=>$private]);

    }

    function admin_info_update(Request $req){

       $manager_id = $req->manager_id;

       $num = DB::table('managers')->where('id',$manager_id)->update(['manager'=>$req->manager,'age'=>$req->age,'qq'=>$req->qq,'email'=>$req->email,'phone'=>$req->phone,'sex'=>$req->sex]);

       if($num==1){

        return "<script>alert('修改成功');location.href='Manager_admin_info';</script>";

       }

    }

    function admin_password_update(Request $req){

        $manager_id = $req->manager_id;

        $old_pass = md5($req->old_pass);

        $password = (Manager::where('id',$manager_id)->select('password')->first())->password;

        if($password!=$old_pass){

            return back()->withInput()->with('error_pass','密码不正确');

        }else{


            Manager::where('id',$manager_id)->update(['password'=>md5($req->new_pass)]);

            return "<script>alert('密码修改成功');location.href='Manager_admin_info';</script>";

        }

    }

    
}
