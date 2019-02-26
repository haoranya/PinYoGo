<?php
  namespace App\Http\Libs;

  class Qrcode{

   static function qrcode(){

      $image = imagecreatetruecolor(100, 30);//创建一个空画布
    
     //设置字体大小
     $fontsize = 5; 
     //生成随机字符  
     $number = rand(0,9);
     $code = [];
     for($a=1;$a<=4;$a++){
         
        $one=array(chr(rand(65,90)),chr(rand(97,122)));
        
        $two=array_rand($one,1);

        $code[]=$one[$two];

     }
     $code[]=$number;

     $code[]=$number;
     
     shuffle($code);

     $message=[];

     //循环放入画布
  for($i=0;$i<count($code);$i++){

    //设置字体颜色，随机颜色
    $fontcolor = imagecolorallocate($image, rand(120,255),rand(120,255), rand(120,255));      //0-120深颜色

    //设置数字

    $fontcontent = $code[$i];

    //.=连续定义变量

    $message[]=$fontcontent;  //用来保存到session

    //设置坐标
    $x = ($i*100/6)+rand(5,10);  //左上角x轴的位置

    $y = rand(5,10);  //字符串y轴的位置
 
    imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);//将每一个字符串填充到画布
  }

  $captcha_code = implode('',$message);

  //存到session
  session()->put('code',$captcha_code);

  //增加干扰元素，设置雪花点
  for($i=0;$i<200;$i++){
    //设置点的颜色，50-200颜色比数字浅，不干扰阅读
    $pointcolor = imagecolorallocate($image,rand(50,200), rand(50,200), rand(50,200));    
    //imagesetpixel — 画一个单一像素
    imagesetpixel($image, rand(1,99), rand(1,29), $pointcolor);
  }
  //增加干扰元素，设置横线
  for($i=0;$i<4;$i++){
    //设置线的颜色
    $linecolor = imagecolorallocate($image,rand(80,220), rand(80,220),rand(80,220));
    //设置线，两点一线
    imageline($image,rand(1,99), rand(1,29),rand(1,99), rand(1,29),$linecolor);
  }
 
  //设置头部，image/png
  header('Content-Type: image/png');
  //imagepng() 建立png图形函数
  imagepng($image);
  //imagedestroy() 结束图形函数 销毁$image
  imagedestroy($image);

    }

  }




 