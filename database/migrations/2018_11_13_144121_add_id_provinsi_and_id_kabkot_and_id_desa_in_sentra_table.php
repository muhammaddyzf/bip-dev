<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdProvinsiAndIdKabkotAndIdDesaInSentraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sentra', function (Blueprint $table) {
            $table->integer('id_provinsi')->nullable()->after('alamat');
            $table->integer('id_kabkot')->nullable()->after('id_provinsi');
            $table->integer('id_desa')->nullable()->after('id_kecamatan');

            $table->string('lati')->nullable()->change();
            $table->string('longi')->nullable()->change();
            $table->string('kelurahan')->nullable()->change();
            $table->string('rt')->nullable()->change();
            $table->string('rw')->nullable()->change();
            $table->string('satuan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sentra', function (Blueprint $table) {
            //
        });
    }
}
