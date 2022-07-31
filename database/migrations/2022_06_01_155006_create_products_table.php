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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestampsTz();
            $table->string('name', 150);
            $table->text('description', 500);
            $table->string('image', 50);
            $table->float('price');
            $table->float('old_price');
            $table->float('percentage_discount');
            $table->integer('installments_limit');
            $table->integer('quantity');
            $table->softDeletes();
            $table->boolean('promotion_flag');
            $table->integer('category_id');
            $table->integer('measure_id');
            $table->integer('color_id');
            $table->integer('brand_id');
            $table->integer('type_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('measure_id')->references('id')->on('measures')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
