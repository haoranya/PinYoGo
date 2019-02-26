<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Manager_indexController extends Controller
{
    function index(){

        if(session()->get('manager_id')){

            return view("Manager.index.index");

        }else{

            return "<script>alert('你还没有登录!!!');location.href='Manager_login';</script>";

        }

       

    }

    function brand(){

        return view("Manager.index.brand");

    }

    function content_category(){

        return view("Manager.index.content_category");

    }

    function goods(){

        return view("Manager.index.goods");

    }

    function item_cat(){

        return view("Manager.index.item_cat");

    }

    function seller(){

        return view("Manager.index.seller");

    }

    function seller_1(){

        return view("Manager.index.seller_1");

    }

    function home(){

        return view("Manager.index.home");

    }

    function specification(){

        return view("Manager.index.specification");

    }

    function type_template(){

        return view("Manager.index.type_template");

    }
}
