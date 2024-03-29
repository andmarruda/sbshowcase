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
        Schema::create('email_providers', function (Blueprint $table) {
            $table->id();
            $table->timestampsTz();
            $table->softDeletes();
            $table->string('host', 200);
            $table->smallInteger('port');
            $table->string('email', 250);
            $table->string('password', 50);
            $table->string('secure', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_providers');
    }
};
