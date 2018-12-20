<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLatiLongiDesaToNullableOnPasarModernTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pasar_modern', function($table)
        {
            $table->string('lati')->nullable()->change();
            $table->string('longi')->nullable()->change();
            $table->string('desa')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pasar_modern', function (Blueprint $table) {
            //
        });
    }
}
