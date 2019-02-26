<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->string('ip')->comment('用户ip地址');
            $table->string('country')->comment('用户登录的所在国家');
            $table->string('city')->comment('用户登录的所在城市');
            $table->string('browser')->comment('用户所使用浏览器');
            $table->string('shebei')->comment('用户所使用的设备');
            $table->string('user_name')->comment('用户登录的名字');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infos');
    }
}
