<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IdentitasAtlet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('master_atlet', function (Blueprint $table) {            
            $table->string('asal_jodang')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('no_ktp')->nullable();
        });        

        Schema::rename('no_kartu_tanda_anggota', 'nomor_induk');

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
