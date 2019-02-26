<?php
  namespace App\Http\Libs;
  class Area{
    
    static function area($ip){

      $ipContent   = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip={$ip}");

      return json_decode($ipContent);

    }
   
   

}

?>