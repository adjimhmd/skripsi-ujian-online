<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterMaterisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_materis', function (Blueprint $table) {
            $table->id();
            $table->integer('user_guru_id')->unsigned();
            $table->integer('master_mapel_id')->unsigned();
            $table->integer('master_kelas_id')->unsigned();
            $table->string('deskripsi')->nullable();
            $table->string('link_gdrive')->nullable();
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
        Schema::dropIfExists('master_materis');
    }
}
