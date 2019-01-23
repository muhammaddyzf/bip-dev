<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOnIkmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_ikm', function (Blueprint $table) {
             $table->string('IKM_BENTUKBADAN', 50)->nullable()->after('IKM_PEMILIK');
             $table->string('IKM_THNDIKELUARKANIJIN', 50)->nullable()->after('IKM_PEMILIK');
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
