<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Medicines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id()->unique();
            $table->integer('user_id');
            $table->integer('expiry_level'); // 药品临期等级
            $table->string('offical_name'); // 药品官方名称
            $table->string('sub_name'); // 药品自定义名称
            $table->integer('amount'); // 数量
            $table->string('unit'); // 单位
            $table->integer('shelves'); // 货架号
            $table->integer('number_of_plies'); // 货架上第几层
            $table->timestamp('purchase_date'); // 采购时间
            $table->timestamp('expired_date')->nullable(); // 临期日期
            $table->timestamp('expiry_date'); // 过期时间
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
