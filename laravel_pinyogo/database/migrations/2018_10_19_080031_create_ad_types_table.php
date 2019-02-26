<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_types', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('ad_type')->comment('类型名称');
            $table->enum('ad_type_state',['无效','有效'])->comment('广告类型状态');
            $table->string('group')->comment('分组');
            $table->string('key')->comment('key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_types');
    }
}
