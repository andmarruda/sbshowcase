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
        //adding column for prefer email
        Schema::table('generals', function(Blueprint $table){
            $table->string('prefer_email', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generals', function(Blueprint $table){
            $table->dropColumn('prefer_email');
        });
    }
};
