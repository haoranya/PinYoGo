<?php
    namespace App\Http\Libs;
    use Flc\Dysms\Client;
    use Flc\Dysms\Request\SendSms;
    use Illuminate\Support\Facades\Cache;
    class Phone{

       static function sendMessage($phone){

            //制作验证码

            $code = rand(100000,999999);

            //cache缓存

            $name = $phone;

            Cache::put($name,$code,5); // 单位：分钟

            //发短信

            $config=[
                
                'accessKeyId'    => 'LTAIsduZor6uivS5',

                'accessKeySecret' => 'VhxpdWdZuXMm95Zv7lC1euG14PxA7I',
    
            ];
         
             $client = new Client($config);

             $sendSms = new SendSms;
        
             $sendSms -> setPhoneNumbers($phone);
            
             $sendSms->setSignName('全栈9组sns项目');

             $sendSms->setTemplateCode('SMS_135043386');

             $sendSms -> setTemplateParam(['code'=>$code]);
       
            //发送

            $client -> execute($sendSms);

        

        }

    }

?>