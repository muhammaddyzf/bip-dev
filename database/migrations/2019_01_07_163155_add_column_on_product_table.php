<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOnProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_produk', function (Blueprint $table) {
             $table->integer('PRDK_TENAGAKERJA')->nullable()->after('PRDK_KET');
             $table->integer('PRDK_NILAIINVESTASI')->nullable()->after('PRDK_KET');
             $table->integer('PRDK_JUMLAHKAPASITASPRODUKSI')->nullable()->after('PRDK_KET');
             $table->string('PRDK_SATUANKAPASITASPRODUKSI', 32)->nullable()->after('PRDK_KET');
             $table->integer('PRDK_NILAIPRODUKSI')->nullable()->after('PRDK_KET');
             $table->integer('PRDK_BBBP')->nullable()->after('PRDK_KET');
             $table->integer('PRDK_PEMASARAN')->nullable()->after('PRDK_KET');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
