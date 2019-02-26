<?php
  namespace App\Http\Libs;
  class Log{

     protected $fp = '';
    
     function __construct($file_name){

        $this->fp = fopen('log/'.$file_name."log",'a');

     }

     function log($content){

        //构造文件的格式
            //获取时间
            $date = date("Y-m-d H:i:s");

            $c = $date.'/r/n';

            $c.=str_repeat("=",120);

            $c.=$content."/r/n/r/n";

            fwrite($this->fp,$c);

     }
   

}

?>