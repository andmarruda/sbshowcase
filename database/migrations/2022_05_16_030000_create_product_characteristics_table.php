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
        Schema::create('product_characteristics', function (Blueprint $table) {
            $table->id();
            $table->timestampsTz();
            $table->bigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->bigInteger('characteristics_types_id');
            $table->foreign('characteristics_types')->references('id')->on('characteristics_types')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_characteristics');
    }
};
