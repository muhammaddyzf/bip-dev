<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdProvinsiAndIdKabkotAndIdDesaInPasarModernTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pasar_modern', function (Blueprint $table) {
            $table->integer('id_provinsi')->nullable()->after('alamat');
            $table->integer('id_kabkot')->nullable()->after('id_provinsi');
            $table->integer('id_desa')->nullable()->after('id_kecamatan');
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
