<?php
  namespace App\Http\Libs;

  class Ip{

   static function get_client_ip($type = 0,$adv=false) {

    $type   =  $type ? 1 : 0;

    static $ip  =   NULL;

    if ($ip !== NULL) return $ip[$type];

    if($adv){//高级模式获取(防止伪装)

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            $pos    =   array_search('unknown',$arr);

            if(false !== $pos) unset($arr[$pos]);

            $ip     =   trim($arr[0]);

        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {

            $ip     =   $_SERVER['HTTP_CLIENT_IP'];

        }elseif (isset($_SERVER['REMOTE_ADDR'])) {

            $ip     =   $_SERVER['REMOTE_ADDR'];

        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {

        $ip     =   $_SERVER['REMOTE_ADDR'];

    }

    // IP地址合法验证

    $long = sprintf("%u",ip2long($ip));

    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);

    return $ip[$type];

}

  }




 