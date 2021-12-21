<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstansiPendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('instansi_pendidikans');
        Schema::create('instansi_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->enum('jenjang', ['SD', 'SMP', 'SMA', 'UMUM'])->nullable();
            $table->enum('tipe', ['sekolah', 'lembaga_kursus'])->nullable();
            $table->string('nomor_induk',50)->nullable();
            $table->char('desa_id', 10)->nullable();
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
        Schema::dropIfExists('instansi_pendidikans');
    }
}
