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
        //adding whatsapp_number to generals table
        Schema::table('generals', function (Blueprint $table) {
            $table->string('whatsapp_number', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //removing whatsapp_number from generals table
        Schema::table('generals', function (Blueprint $table) {
            $table->dropColumn('whatsapp_number');
        });
    }
};
