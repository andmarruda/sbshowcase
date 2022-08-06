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
        Schema::create('images_sizes', function (Blueprint $table) {
            $table->id();
            $table->timestampsTz();
            $table->softDeletes();
            $table->integer('min_width');
            $table->integer('max_width');
            $table->text('description');
        });

        Artisan::call(
            'db:seed', 
            [
                '--class' => 'ImagesSizeSeeder',
                '--force' => true
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images_sizes');
    }
};
