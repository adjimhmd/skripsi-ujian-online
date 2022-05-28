<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('master_ruang_ujian_id')->unsigned();
            $table->bigInteger('user_siswa_id')->unsigned();
            $table->bigInteger('user_guru_id')->unsigned()->nullable();
            $table->bigInteger('instansi_pendidikan_id')->unsigned()->nullable();
            $table->decimal('angka',1,0);
            $table->string('komentar');
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
        Schema::dropIfExists('ratings');
    }
}
