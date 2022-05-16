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
        Schema::create('social_media_urls', function (Blueprint $table) {
            $table->id();
            $table->timestampsTz();
            $table->bigInteger('social_media_id');
            $table->foreign('social_media_id')->references('social_media')->on('id')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->string('url', 250);
            $table->unique('social_media_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_media_urls');
    }
};
