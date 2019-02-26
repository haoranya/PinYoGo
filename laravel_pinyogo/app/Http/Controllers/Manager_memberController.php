<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;

use App\Models\User;

use App\Models\Money;

use DB;

class Manager_memberController extends Controller
{
    function member_level(Request $req){

        $name = $req->name;

        $add_time = $req->add_time;

        $user = User::select("*");

        if(isset($name)){

            $user->where('user','like',"%$name%");

        }

        if(isset($add_time)){

            $user->where('created_at','like',"$add_time%");

        }

        $users = $user->paginate(1);

        $user_arr = [];

        foreach($users as $user){

            $money = (Money::where('user_id',$user->id)->select('money')->first())['money'];

            if($money<=100){

                $user['member']='普通会员';

            }else if($money<=200&&$money>100){

                $user['member']="白银会员";

            }else if($money>200&&$money<=400){

                $user['member']='黄金会员';

            }else if($money>400&&$money<800){

                $user['money']='铂金会员';

            }else{

                $user['money']='超级会员';

            }

            $user_arr[]=$user;

        }

        $user_data = DB::table('users')  
        ->leftjoin('money', 'money.user_id', '=', 'users.id')
       
        ->get();

        $one = 0;

        $two = 0;

        $three = 0;

        $four = 0;

        $five = 0;

        foreach($user_data as $user){

            $money = $user->money;

            if($money<=100){

                $one++;

            }else if($money<=200&&$money>100){

                $two++;

            }else if($money>200&&$money<=400){

                $three++;

            }else if($money>400&&$money<800){

                $four++;

            }else{

                $five++;

            }

        }

        return view('Manager.member.member_level',['user_arr'=>$user_arr,'users'=>$users,'req'=>$req,'name'=>$name,'add_time'=>$add_time,'one'=>$one,'two'=>$two,'three'=>$three,'four'=>$four,'five'=>$five]);  

    }

    function ajax_stop(){

        $user_id = $_GET['user_id'];

        User::where('id',$user_id)->update(['state'=>'已停用']);

        return 1;
        
    }

    function ajax_start(){

        $user_id = $_GET['user_id'];

        User::where('id',$user_id)->update(['state'=>'已开启']);

        return 1;

    }

    function ajax_del(){

        $user_id = $_GET['user_id'];

        User::where('id',$user_id)->delete();

        Money::where('user_id',$user_id)->delete();

        return 1;

    }

    function member_select(){

        dd($req->all());

    }

}
