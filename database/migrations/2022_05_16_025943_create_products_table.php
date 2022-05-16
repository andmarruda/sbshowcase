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
            $table->bigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->float('price');
            $table->float('discount');
            $table->float('old_price');
            $table->string('description', 150);
            $table->text('details');
            $table->boolean('promo_flag');
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
