<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Models\Admin;

class Admin_registerController extends Controller
{
    function register(){

        return view("Admin.register.register");

    }

    function do_register(){

        

    }
}
