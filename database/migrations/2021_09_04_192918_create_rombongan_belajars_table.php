<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRombonganBelajarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rombongan_belajars', function (Blueprint $table) {
            $table->id();
            $table->integer('kelas_program_id')->unsigned();
            $table->bigInteger('user_siswa_id')->unsigned();
            $table->bigInteger('harga_kelas_program_id')->unsigned();
            $table->enum('status', ['0', '1'])->nullable();
            $table->string('bukti_bayar')->nullable();
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
        Schema::dropIfExists('rombongan_belajars');
    }
}
