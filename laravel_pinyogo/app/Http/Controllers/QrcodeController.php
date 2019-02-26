<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//字符串处理为二维码需要下载依赖endroid/qrcode
use Endroid\QrCode\QrCode;

class QrcodeController extends Controller
{
    function qrcode(){

            $str = $_GET['code'];

            $qrCode = new QrCode($str);

            header('Content-Type: '.$qrCode->getContentType());

            echo  $qrCode->writeString();

    }
}
