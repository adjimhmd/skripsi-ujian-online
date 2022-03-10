<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_ujians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('master_ruang_ujian_id')->unsigned();
            $table->bigInteger('user_siswa_id')->unsigned();
            $table->double('total_nilai');
            $table->tinyInteger('ujian_ke');
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
        Schema::dropIfExists('nilai_ujians');
    }
}
