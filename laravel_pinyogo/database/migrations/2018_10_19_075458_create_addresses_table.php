<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->string('name')->comment('姓名');
            $table->unsignedTinyInteger('phone')->comment('联系电话');
            $table->string('province')->comment('省份');
            $table->string('city')->comment('市区');
            $table->string('county')->comment('县级');
            $table->enum('address_state',['默认','非默认'])->comment('地址状态');
            $table->string('email')->comment('邮箱');
            $table->string('address_name')->comment('地址别名');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
