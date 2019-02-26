<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('goods_name')->comment('商品名');
            $table->unsignedInteger('cat_one_id')->comment('分类1ID');
            $table->unsignedInteger('cat_two_id')->comment('分类2ID');
            $table->unsignedInteger('cat_three_id')->comment('分类3ID');
            $table->unsignedInteger('brand_id')->comment('品牌ID');
            $table->enum('goods_state',['未申请', '申请中', '审核通过', '已驳回']);
            $table->unsignedTinyInteger('price')->comment('价格');
            $table->longText('desc')->comment('商品描述');
            $table->string('serve')->comment('售后服务');
            $table->string('packing')->comment('包装列表');
            $table->string('spec_id-attribute_id')->comment('规格ID-属性ID');
            $table->unsignedInteger('shop_id')->comment('店铺ID');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
