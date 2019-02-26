<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Http\Requests\AddressRequest;

use App\Models\City;

use App\Models\Address;

class Front_cityController extends Controller
{
    function get_city(){

        $parent_id = $_GET['parent_id'];

        $data = City::where('parent_id',$parent_id)->get();

        return $data;

    }

    function set_address(){

        $id = $_GET['id'];

        Address::where('user_id',session()->get('id'))->update(['address_state'=>'非默认']);

        Address::where('id',$id)->update(['address_state'=>'默认']);

        if($_GET['home']=='true'){

            return "<script> alert('设置成功');location.href='Front_home_setting_address';</script>";

        }

        return 1;

    }

    function add_address(AddressRequest $req){

        $address = new Address;

        if($req->home){

            $address->fill($req->all());

            $address->user_id=session()->get('id');

            $address->save();

            return "<script> alert('添加成功');location.href='Front_home_setting_address';</script>";

        }else{

            $province = (City::where('id',$req->province)->select('name')->first())->name;

            $city = (City::where('id',$req->city)->select('name')->first())->name;
    
            $county = (City::where('id',$req->county)->select('name')->first())->name;
    
            $address->fill($req->all());
    
            $address->user_id=session()->get('id');
    
            $address->province = $province;
    
            $address->city = $city;
    
            $address->county = $county;
    
            $address->save();

            return "<script> alert('添加成功');location.href='Front_getOrderInfo';</script>";

        }

        return "<script> alert('添加成功');location.href='Front_getOrderInfo';</script>";

    }

    function update_address(AddressRequest $req){

        $id = $req->id;

        $num = Address::where('id',$id)->update(['name'=>$req->name,'phone'=>$req->phone,'province'=>$req->province,'city'=>$req->city,'county'=>$req->county,'address_name'=>$req->address_name,'zip_code'=>$req->zip_code]);

        if($num==1){

            return "<script> alert('修改成功');location.href='Front_home_setting_address';</script>";

        }


    }

    function edit_address(){

        $id = $_GET['id'];

        $address = Address::where('id',$id)->first();

        return view("Front.index.address_edit",['address'=>$address]);

    }

    function del_address(){

        $id = $_GET['id'];
        
        Address::where('id',$id)->delete();
        
        if($_GET['home']=='true'){
            
            return "<script> alert('修改成功');location.href='Front_home_setting_address';</script>";

        }

        return "<script> alert('修改成功');location.href='Front_getOrderInfo';</script>";

    }
}
