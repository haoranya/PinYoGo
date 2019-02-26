<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Info;

use App\Http\Requests\LoginRequest;

use App\Http\Requests\Safe_loginRequest;

use Illuminate\Support\Facades\Cache;

use App\Http\Libs\Ip;

use App\Http\Libs\Area;

use App\Http\Libs\Shebei;

use App\Http\Libs\Browser;

use App\Http\Libs\Phone;

class Front_loginController extends Controller
{
    function login(){

        if(session()->get('remember')){

            return redirect()->route('Front_index');

        }else{

            return view("Front.login.login",['bool'=>'false','ip'=>'','browser'=>'','shebei'=>'','country'=>'','city'=>'','user_id'=>'','user_name'=>'','phone'=>'']);

        }

    }

    function do_login(LoginRequest $req){

        $ip = Ip::get_client_ip();

        $area = Area::area($ip);

        $shebei = Shebei::getOS();

        $browser = Browser::my_get_browser();

        $session_code = strtolower(session()->get('code'));

        $code = strtolower($req->code);

        $name = $req->user;

        $password = md5($req->password);

        if($session_code==$code){

            $data = User::where("user",$name)->first();

            if($data){

                if($data->password==$password){
    
                    //ip的判断
                    $info = Info::where('user_id',$data->id)->first();

                    if(!$info){
    
                        $info_obj = new Info;
    
                        $info_obj->user_id = $data->id;
    
                        $info_obj->ip = $ip;
    
                        $info_obj->browser = $browser;
    
                        $info_obj->shebei = $shebei;
    
                        $info_obj->country = $area->data->country;
    
                        $info_obj->city = $area->data->city;
    
                        $info_obj->user_name = $name;
    
                        $info_obj->save();
    
                    }else{

                        if($info->ip!=$ip){

                            if(!$data->phone){

                                $data->phone='null';

                            }
    
                            return view('Front.login.login',['bool'=>'true','ip'=>$ip,'browser'=>$browser,'shebei'=>$shebei,'country'=>$area->data->country,'city'=>$area->data->city,'user_id'=>$data->id,'user_name'=>$req->name,'phone'=>$data->phone]);
                            die;
                        }else{

                        }
    
                    }

                    //判断是否自动登录
                    if($req->remember==true){
    
                        session()->put('remember',true);
                    }

                    session()->put('user',$name);
    
                    session()->put('id',$data->id);
    
                    return redirect()->route('Front_index');
    
                }else{

                    return back()->withInput()->with('error_password','密码错误');

                     }
            }else{

                    return back()->withInput()->with('error_user','账号不存在');

                  }
        }else{

            return back()->withInput()->with('error_code','验证码错误');

        }

    }

    function logout(){

        session()->flush();

        return redirect("Front_login");

    }

    function send(){

        $phone = $_GET['phone'];
       
        Phone::sendMessage($phone);
        
    }

    function safe_login(Safe_loginRequest $req){

        $phone = $req->phone;

        $code = $req->code;

        $cache_code = Cache::get($phone);//获取缓存在cache里面的验证码

        if($code==$cache_code){

            $info_obj = new Info;

            $user = new User;

            $result = $info_obj->where("user_id",$req->user_id)->update(['ip'=>$req->ip,'country'=>$req->country,'city'=>$req->city,'browser'=>$req->browser,'shebei'=>$req->shebei]);
            $user->where("id",$req->user_id)->update(['phone'=>$phone]);
             //判断是否自动登录
             if($req->remember==true){
    
                session()->put('remember',true);
            }
          
            session()->put('user',$req->user_name);

            session()->put('id',$req->user_id);

            Cache::put($phone,'',0);

            return redirect()->route('Front_index');

        }

    }
    
}
