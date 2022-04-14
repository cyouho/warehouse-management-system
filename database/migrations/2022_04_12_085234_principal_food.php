<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Principal food table.
 * 主食表。
 */
class PrincipalFood extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('principal_food', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id()->unique();
            $table->integer('user_id');
            $table->integer('food_level'); // 食品临期等级
            $table->string('food_name'); // 食品官方名称
            $table->string('food_sub_name'); // 食品自定义名称
            $table->integer('amount'); // 数量
            $table->integer('shelves'); // 货架号
            $table->integer('number_of_plies'); // 货架上第几层
            $table->timestamp('purchase_date'); // 采购时间
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
        Schema::dropIfExists('principal_food');
    }
}
