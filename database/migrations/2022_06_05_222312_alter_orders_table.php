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
        //adding order status
        Schema::table('orders', function(Blueprint $table){
            $table->integer('order_status_id');
            $table->foreign('order_status_id')->references('id')->on('order_statuses')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //remove order status
        Schema::table('orders', function(Blueprint $table){
            $table->dropforeign('orders_order_status_id_foreign');
            $table->dropColumn('order_status_id');
        });
    }
};
