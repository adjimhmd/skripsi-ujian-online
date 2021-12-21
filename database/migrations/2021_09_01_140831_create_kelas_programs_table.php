<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas_programs', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi',100)->nullable();
            $table->Integer('master_kelas_id')->unsigned();
            $table->smallInteger('master_mapel_id')->unsigned();
            $table->integer('instansi_pendidikan_id')->unsigned();
            $table->string('jurusan',50)->nullable();
            $table->decimal('harga',10,0);
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
        Schema::dropIfExists('kelas_programs');
    }
}
