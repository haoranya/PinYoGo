<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('ad_title')->comment('标题');
            $table->unsignedInteger('ad_type_id')->comment('类型ID');
            $table->string('url')->comment('广告内容的连接');
            $table->unsignedInteger('sort')->comment('广告位');
            $table->string('ad_logo')->comment('广告图');
            $table->enum('ad_state',['无效','有效'])->comment('广告状态');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
