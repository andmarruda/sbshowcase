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
        //adding column additional_observations
        Schema::table('products', function (Blueprint $table) {
            $table->text('additional_observations')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //removing column additional_observations
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('additional_observations');
        });
    }
};
