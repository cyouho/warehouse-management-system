<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Drink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drink', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id()->unique();
            $table->integer('user_id');
            $table->string('food_name');
            $table->integer('amount'); // 数量
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
        Schema::dropIfExists('drink');
    }
}
