<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_rule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("discount_id")->comment("活动主表id")->index();
            $table->string("type")->comment("执行类型  contains_product 制定固定产品  contains_category  商品类型  item_total 满减或者满 打折");
            $table->text("configuration")->comment("条件参数json");
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `discount_rule` comment'优惠规则表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_rule');
    }
}
