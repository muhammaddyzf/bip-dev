<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importir', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_perusahaan')->nullable;
            $table->text('alamat_perusahaan')->nullable;
            $table->string('npwp', 32)->nullable;
            $table->string('nama_pemilik', 50)->nullable;
            $table->string('email', 50)->nullable;
            $table->string('telp', 50)->nullable;
            $table->text('nomor_api')->nullable;
            $table->text('uraian_barang')->nullable;
            $table->string('pos_taris')->nullable;
            $table->integer('volume_kuantitas')->nullable;
            $table->string('volume_satuan', 32)->nullable;
            $table->integer('nilai')->nullable;
            $table->string('nilai_satuan', 32)->nullable;
            $table->string('negara_asal')->nullable;
            $table->string('pelabuhan_bongkar')->nullable;
            $table->string('pib_nomor')->nullable;
            $table->date('pib_tanggal')->nullable;
            $table->text('keterangan')->nullable;
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('importir');
    }
}
