<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('user')->comment('用户名');
            $table->string('password')->comment('密码');
            $table->unsignedTinyInteger('phone')->comment('手机号');
            $table->string('nickname')->comment('昵称');
            $table->enum('sex',['男','女'])->comment('性别');
            $table->dateTime('birthday')->comment('生日');
            $table->string('province')->comment('省份');
            $table->string('city')->comment('市区');
            $table->string('county')->comment('县级');
            $table->string('work')->comment('职业');
            $table->string('head')->comment('头像');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
