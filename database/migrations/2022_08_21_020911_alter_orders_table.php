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
        //change order table adding some columns
        Schema::table('orders', function(Blueprint $table){
            $table->float('subtotal');
            $table->float('shippment_price');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //remove table changes
        Schema::table('orders', function(Blueprint $table){
            $table->dropColumn('subtotal');
            $table->dropColumn('shippment_price');
            $table->dropSoftDeletes();
        });
    }
};
