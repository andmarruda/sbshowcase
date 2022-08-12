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
        //remove not null from column complement of customers
        Schema::table('customers', function (Blueprint $table) {
            $table->string('complement', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //rollback this migration
        Schema::table('customers', function (Blueprint $table) {
            $table->string('complement', 50);
        });
    }
};
