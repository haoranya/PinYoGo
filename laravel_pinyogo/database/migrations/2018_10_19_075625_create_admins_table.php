<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('admin')->comment('登录名');
            $table->string('password')->comment('登陆密码');
            $table->string('company')->comment('公司名称');
            $table->unsignedTinyInteger('tel')->comment('公司电话');
            $table->string('company_location')->comment('公司详细地址');
            $table->string('name')->comment('name');
            $table->unsignedTinyInteger('QQ')->comment('联系人QQ');
            $table->unsignedTinyInteger('phone')->comment('联系人的电话');
            $table->string('email')->comment('联系人的Email');
            $table->unsignedTinyInteger('business')->comment('营业执照');
            $table->unsignedTinyInteger('tax')->comment('税务登记证号');
            $table->unsignedTinyInteger('organize')->comment('组织机构代码证');
            $table->string('legal')->comment('法定代表人');
            $table->unsignedTinyInteger('legal_ID')->comment('代表人身份证');
            $table->string('bank')->comment('开户行名称');
            $table->string('branck')->comment('开户行支行');
            $table->unsignedTinyInteger('bank_ID')->comment('银行账号');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
