<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterRuangUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_ruang_ujians', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi');
            $table->Integer('master_paket_soal_id')->unsigned();
            $table->Integer('master_tahun_ajaran_id')->unsigned();
            $table->Integer('kelas_program_id')->unsigned();
            $table->smallInteger('batas');
            $table->smallInteger('durasi');
            $table->dateTime('waktu_mulai', $precision = 0);
            $table->dateTime('waktu_selesai', $precision = 0);
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
        Schema::dropIfExists('master_ruang_ujians');
    }
}
