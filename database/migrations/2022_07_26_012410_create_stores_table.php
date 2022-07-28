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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->timestampsTz();
            $table->softDeletes();
            $table->string('name', 50);
            $table->string('address', 60);
            $table->string('address_number', 60);
            $table->string('address_complement', 60)->nullable();
            $table->string('address_neighborhood', 60);
            $table->string('address_city', 60);
            $table->string('address_state', 3);
            $table->string('address_zipcode', 10);
            $table->string('address_country', 30);
            $table->text('google_maps_embeded');
            $table->string('phone', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
