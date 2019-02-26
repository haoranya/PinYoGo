<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('buyer_state',['待支付','待收货','已收货','待评价'])->comment('买家订单状态');
            $table->enum('seller_state',['待支付','未支付'])->comment('卖家订单状态');
            $table->enum('buyer_handle',['退货','退款'])->comment('买家订单处理');
            $table->string('order_area')->comment('订单所在位置');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_infos');
    }
}
