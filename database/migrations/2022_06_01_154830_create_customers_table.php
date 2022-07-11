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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestampsTz();
            $table->string('name', 100);
            $table->string('cpf_cnpj', 15);
            $table->date('birth_date');
            $table->string('phone', 15);
            $table->string('email', 100);
            $table->string('address', 150);
            $table->string('number', 10);
            $table->string('complement', 50);
            $table->string('neighborhood', 50);
            $table->string('city', 50);
            $table->string('state', 2);
            $table->string('zip_code', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
