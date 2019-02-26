<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Manager_loginRequest;

use App\Models\Manager;

use App\Models\Power;

use App\Models\privates;

class Manager_loginController extends Controller
{
    function login(){

        return view("Manager.login.login");

    }

    function dologin(Manager_loginRequest $req){

        $manager = $req->manager;

        $password = md5($req->password);

        $manager = Manager::where('manager',$manager)->where('password',$password)->first();

        if($manager){
           
            session()->put('manager_id',$manager->id);

            session()->put('manager',$manager->manager);

            $private_id = (Power::where('manager_id',$manager->id)->select('private_id')->first())->private_id;

            $private = Privates::where('id',$private_id)->first();

            if($private->private==null){

                session()->put('root',true);

            }else{

                session()->put('private',$private->private);

            }

           return "<script>alert('登陆成功!!!');location.href='Manager_index';</script>";

        }else{

            return back()->withInput()->with('error_login','用户名或者密码错误！！！');

        }

    }

    function logout(){

        Session()->flush();

        return "<script>alert('安全退出!!!');location.href='Manager_login';</script>";

    }
}
