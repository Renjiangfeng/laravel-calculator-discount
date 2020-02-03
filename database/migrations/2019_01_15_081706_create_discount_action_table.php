<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_action', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("discount_id")->comment("discount表id")->index();
            $table->string("type")->comment("执行类型  ");
            $table->text("configuration")->comment("条件参数json");
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `discount_action` comment'优惠执行动作表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_action');
    }
}
