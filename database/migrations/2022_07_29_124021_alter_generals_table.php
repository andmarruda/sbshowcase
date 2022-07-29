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
        //adding extra columns
        Schema::table('generals', function (Blueprint $table) {
            $table->string('company_name', 60)->nullable();
            $table->string('company_doc', 20)->nullable();
            $table->string('blog_url', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //removing extra columns
        Schema::table('generals', function (Blueprint $table) {
            $table->dropColumn('company_name');
            $table->dropColumn('company_doc');
            $table->dropColumn('blog_url');
        });
    }
};
