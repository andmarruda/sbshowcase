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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->timestampsTz();
            $table->string('primarybg', '6');
            $table->string('primarycolor', '6');
            $table->string('secondarybg', '6');
            $table->string('secondarycolor', '6');
            $table->string('highlightbg', '6');
            $table->string('highlightcolor', '6');
        });

        Artisan::call('db:seed', [
            '--class' => 'TemplateSeeder',
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
        Schema::dropIfExists('templates');
    }
};
