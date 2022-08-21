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
        //change order products table
        Schema::table('order_products', function(Blueprint $table){
            $table->string('product_name', 150);
            $table->float('old_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //remove columns added order products table
        Schema::table('order_products', function(Blueprint $table){
            $table->dropColumn('product_name');
            $table->dropColumn('old_price');
        });
    }
};
