<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_types', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('goods_type')->comment('分类名');
            $table->unsignedInteger('parent_id')->comment('父亲ID');
            $table->unsignedInteger('level')->comment('等级');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_types');
    }
}
