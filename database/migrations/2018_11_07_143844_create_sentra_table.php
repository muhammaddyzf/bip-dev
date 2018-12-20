<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentra', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_sentra');
            $table->string('jenis_produk');
            $table->integer('jumlah_unit_usaha');
            $table->string('kontak_person', 32);
            $table->text('alamat');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('kelurahan');
            $table->integer('id_kecamatan');
            $table->integer('tenaga_kerja');
            $table->integer('nilai_investasi');
            $table->integer('kapasitas_produksi');
            $table->string('satuan', 10);
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
        Schema::dropIfExists('sentra');
    }
}
