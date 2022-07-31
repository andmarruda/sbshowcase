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
        //alter delivery setting tables adding foreign key
        Schema::table('delivery_settings', function (Blueprint $table) {
            $table->foreign('city_id')->references('city_id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //alter delivery setting tables removing foreign key
        Schema::table('delivery_settings', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
        });
    }
};
