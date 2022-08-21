<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_deliveries', function (Blueprint $table) {
            $table->id();
            $table->timestampsTz();
            $table->integer('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('restrict')->onUpdate('cascade');
            $table->string('phone', 15);
            $table->string('address', 150);
            $table->string('number', 10);
            $table->string('complement', 50);
            $table->string('neighborhood', 50);
            $table->string('zip_code', 10);
            $table->integer('state_id');
            $table->foreign('state_id')->references('state_id')->on('states')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('city_id');
            $table->foreign('city_id')->references('city_id')->on('cities')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_deliveries');
    }
};
