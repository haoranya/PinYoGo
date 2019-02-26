<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin_shopController extends Controller
{
    function shop(){

        return view("Admin.shop.shop");

    }
}
