<?php
  namespace App\Http\Libs;
  
    // require_once '/vendor/autoload.php';
    //使用发邮件的功能  需要下载邮件的依赖包swiftmailer/swiftmailer
    class Email {

        public $mailer;

       function __construct(){
              

              // 设置邮件服务器账号

               $transport = (new \Swift_SmtpTransport('smtp.126.com', 25))

               ->setUsername('haoran_ya@126.com')

               ->setPassword('haohao521')

             ;

             // 创建发邮件对象

             $this->mailer = new \Swift_Mailer($transport);
        }

        function send($title,$content,$to){

            // 创建邮件消息

            $message = (new \Swift_Message($title))

            ->setFrom(['haoran_ya@126.com'=>'全栈一班'])

            ->setTo([$to[0], $to[0] => $to[1]])//收件人

            ->setBody($content, 'text/html');     // 邮件内容及邮件内容类型

            ;

          // 发送邮件
          
          $result = $this->mailer->send($message);
            
        }
     
    }

?>