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
        //Droping some columns to recreated with foreign key and create other columns.
        Schema::table('customers', function (Blueprint $table) {
            $table->smallInteger('gender');
            $table->string('password');
            $table->dropColumn('city');
            $table->dropColumn('state');
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
        //Rolling back this migration
        Schema::table('customers', function (Blueprint $table){
            $table->dropColumn('gender');
            $table->dropColumn('password');
            $table->dropForeign('customers_state_id_foreign');
            $table->dropColumn('state_id');
            $table->dropForeign('customers_city_id_foreign');
            $table->dropColumn('city_id');
            $table->string('city', 50);
            $table->string('state', 2);
        });
    }
};
