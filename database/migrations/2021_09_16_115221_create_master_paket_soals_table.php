<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPaketSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_paket_soals', function (Blueprint $table) {
            $table->id();
            $table->integer('master_kelas_id')->unsigned();
            $table->integer('master_mapel_id')->unsigned();
            $table->integer('user_admin_instansi_id')->unsigned();
            $table->string('deskripsi');
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
        Schema::dropIfExists('master_paket_soals');
    }
}
