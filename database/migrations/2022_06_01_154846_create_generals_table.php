<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->timestampsTz();
            $table->string('brand', 100);
            $table->string('brand_image', 50);
            $table->string('slogan', 200);
            $table->string('section', 100);
            $table->string('google_analytics', 255)->nullable();
            $table->string('google_optimize_script', 255)->nullable();
            $table->string('highlight_img_1', 50);
            $table->string('highlight_text_1', 255);
            $table->string('highlight_img_2', 50);
            $table->string('highlight_text_2', 255);
        });

        Artisan::call('db:seed', [
            '--class' => 'GeneralSeeder',
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generals');
    }
};
