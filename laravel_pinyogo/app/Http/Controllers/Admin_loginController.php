<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Models\Admin;

use  App\Http\Requests\Admin_loginRequest;

class Admin_loginController extends Controller
{
    function login(){

        if(session()->get('remember')=='true'){

            return redirect()->route('Admin_index');

        }

        return view("Admin.login.shoplogin");

    }

    function do_login(Admin_loginRequest $req){

        $admin = $req->admin;
        
        $password = md5($req->password);
     
        $code = $req->code;
        
        $data = Admin::where("admin",$admin)->first();
   
        if($data){

            if($data->password==$password){

                if(strtolower($code)==strtolower(session()->get('code'))){

                    if($req->remember){

                        session()->put('remember','true');

                    }

                    session()->put('admin',$admin);

                    session()->put('admin_id',$data->id);

                    return redirect()->route('Admin_index');

                }else{

                    return back()->withInput()->with('error_code','验证码不正确');

                }

            }else{

                return back()->withInput()->with('error_password','密码不正确');

            }

        }else{

            return back()->withInput()->with('error_admin','账号不存在');

        }
        
    }

    function logout(){

        session()->flush();

        return redirect("Admin_login");

    }
}