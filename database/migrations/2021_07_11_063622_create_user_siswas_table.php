<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_siswas', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->string('no_telp',14)->nullable();
            $table->integer('master_kelas_id')->unsigned();
            $table->string('nisn',10)->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('telp_wali',14)->nullable();
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
        Schema::dropIfExists('user_siswas');
    }
}
