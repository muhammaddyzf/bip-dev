<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasarModernTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasar_modern', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kategori_pasar');
            $table->string('nama_toko');
            $table->text('alamat');
            $table->integer('id_kecamatan');
            $table->string('desa', 100);
            $table->integer('luas_tanah');
            $table->integer('luas_bangunan');
            $table->string('nama_perusahaan');
            $table->text('alamat_perusahaan');
            $table->string('lati');
            $table->string('longi');
            $table->timestamps();
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
        Schema::dropIfExists('pasar_modern');
    }
}
