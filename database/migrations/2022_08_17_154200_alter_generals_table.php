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
        //adding highlight product 1, 2 and 3 into generals table
        Schema::table('generals', function(Blueprint $table){
            $table->integer('highlight_product_1')->unsigned()->nullable();
            $table->integer('highlight_product_2')->unsigned()->nullable();
            $table->integer('highlight_product_3')->unsigned()->nullable();
            $table->foreign('highlight_product_1')->references('id')->on('products')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('highlight_product_2')->references('id')->on('products')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('highlight_product_3')->references('id')->on('products')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //removing all changes make on up method
        Schema::table('generals', function(Blueprint $table){
            $table->dropForeign(['highlight_product_1']);
            $table->dropForeign(['highlight_product_2']);
            $table->dropForeign(['highlight_product_3']);
            $table->dropColumn('highlight_product_1');
            $table->dropColumn('highlight_product_2');
            $table->dropColumn('highlight_product_3');
        });
    }
};
