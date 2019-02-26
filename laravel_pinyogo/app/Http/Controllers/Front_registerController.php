<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RegisterRequest;

use Illuminate\Support\Facades\Cache;

use App\Models\User;

use Illuminate\Support\Facades\Redis;

use Validator;

class Front_registerController extends Controller
{
    function register(){

        return view("Front.register.register");

    }

    function do_register(Request $req){


        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";

        preg_match($pattern,$req->user,$result);

        if($result){

            //邮件注册

            if(strlen($req->password)>=5&&strlen($req->password)<=10){

                if($req->password!=$req->password_confirmation){

                    return back()->withInput()->with('error_password_confirmation','密码不一致');

                }else{

                    if($req->ml=='on'){

                        $this->email($req->user,md5($req->password));
                        
                    }else{

                        return back()->withInput()->with('error_ml','协议必须同意');

                    }

                }

            }else{

                return back()->withInput()->with('error_password','密码要在五到十');

            }

            
        }else{

            //普通注册

            $rules = [
                'user' => ['required','min:5','max:30','unique:users'],//判断users表内是否重复了<除了 id 为 $id 的name>
                'password'=>['required','confirmed'],//不为空,两次密码是否相同
                'password_confirmation'=>['required',"same:password"],//不为空,两次密码是否相同
                'phone'=>['required', 'regex:/^0?(13|14|15|17|18)[0-9]{9}$/','unique:users'],
                'code'=>['required'],
                'ml'=>['accepted'],
                ];
            $messages = [
                'user.required'=>"用户名不能为空",
                'user.min'=>"用户名至少五位",
                'user.max'=>"用户名最多三十位",
                'user.unique' => '用户名已存在！',
                'password.required'=>"密码不能为空",
                'password.confirmed'=>"密码与确认密码不匹配",
                'password_confirmation.required'=>"确认密码不能为空",
                'password_confirmation.same'=>'',//如果这里的错误信息也写确认密码不能为空,那么每次就会输出两次,所以我给了个空字符串
                'phone.required'=>"手机号不能为空",
                'phone.regex'=>"请输入正确的手机号",
                'phone.unique'=>'手机号不可以绑定多个',
                'code.required'=>"请输入六位验证码",
                "ml.accepted" => "协议必须被接受",
               ];
        
             $this->validate($req,$rules,$messages);
        
               $phone = $req->phone;
        
               $user = $req->user;
        
               $password = md5($req->password);
        
               $code = $req->code;
        
               //从缓存里面取出验证码
        
               $cache_code = Cache::get($phone);
        
               if($cache_code==$code){
        
                $user = new User;

                dd($req->all());
        
                $user->fill($req->all());

                $user->password = $password;
        
                $user->save();

                return  "<script>alert('注册成功,请进行登录!');location.href='Front_login'</script>";
        
               }
        }
    }

    function email($user,$password){

        $arr = explode("@",$user);

        $name = $arr[0];

        $to = $arr[1];

        //生成激活码(32位的随机的字符串)
        $code = md5( rand(1,99999) );

        //保存要注册的账户到redis

        $value = json_encode([$user,$password]);

        Redis::setex($code,300,$value);

        //邮件的发送地址

        $from = [$user,$name];

        $message = [

            'title'=>"欢迎注册",

            'content'=>"点击以下链接进行激活：<br> 点击激活：
            <a href='http://localhost:9999/Front_email?code={$code}'>
            http://localhost:9999/Front_email?code={$code}</a><p>
            如果按钮不能点击，请复制上面链接地址，在浏览器中访问来激活账号！</p>",

            'to'=>$from

        ];

        //把消息放到redis的队列中

        Redis::lpush('email',json_encode($message));

        echo  "<script>alert('注册成功,请进行邮箱验证!');location.href='\Front_href?dir={$to}'</script>";

    }

    function do_email(Request $req){

        $code = $_GET['code'];

        //根据激活码取出redis里面的要注册的用户和密码

        $data = json_decode(Redis::get($code));

        if($data){

            $username = $data['0'];

            $password = $data['1'];

            $user = new User;

            $user->user = $username;

            $user->password = $password;

            $user->save();

            return  "<script>alert('注册成功,请进行登录!');location.href='Front_login'</script>";

        }else{

            return  "<script>alert('激活码已经失效,请重新注册!');location.href='Front_register'</script>";

        }

    }

    function href(){

        $dir = $_GET['dir'];

        echo "<a href='http://www.{$dir}' >点击前去登录邮箱进行验证</a>";
        
      

    }

}
