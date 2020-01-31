<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title")->nullable();
            $table->string("label")->nullable();
            $table->tinyInteger("status")->default(2)->comment("活动状态   1开启  2关闭");
            $table->dateTime("start_time")->nullable()->comment("开始时间");
            $table->dateTime("end_time")->nullable()->comment("结束时间");
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `discount` comment'优惠表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount');
    }
}
