<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasarTradisionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasar_tradisional', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_pasar');
            $table->string('kategori_pasar');
            $table->text('alamat');
            $table->integer('id_kecamatan');
            $table->integer('luas_tanah');
            $table->integer('luas_bangunan');
            $table->integer('bangunan_kios');
            $table->integer('bangunan_los');
            $table->integer('jumlah_pedagang');
            $table->string('status', 100);
            $table->string('pengelola', 100);
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
        Schema::dropIfExists('pasar_tradisional');
    }
}
