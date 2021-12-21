<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_ujians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('master_ruang_ujian_id')->unsigned();
            $table->bigInteger('user_siswa_id')->unsigned();
            $table->bigInteger('bank_soal_id')->unsigned();
            $table->longText('jawaban');
            $table->double('nilai');
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
        Schema::dropIfExists('detail_ujians');
    }
}
