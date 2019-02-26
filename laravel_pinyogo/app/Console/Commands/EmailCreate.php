<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Libs\Email;

use Illuminate\Support\Facades\Redis;

class EmailCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'email:create{--file=} {--paging}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成回流文件';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //引入发邮件的对象

        $email = new Email;

        //设置堵塞取消息

        ini_set("default_socket_timeout",-1);

        echo "邮件发送队列启动成功\r\n";

        while(true){

            $data = Redis::brpop("email",0);
            //将数据转换为数组，默认转为对象，转数组要加true
            $message = json_decode($data[1], true);

            //发送邮件

            $email->send($message['title'],$message['content'],$message['to']);

            echo "邮件发送成功\r\n";

        }
    }
}
