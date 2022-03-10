<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruInstansisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru_instansis', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('instansi_pendidikan_id')->unsigned();
            $table->integer('user_guru_id')->unsigned();
            $table->enum('status', ['0-lembaga','0-guru','1'])->nullable();
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
        Schema::dropIfExists('guru_instansis');
    }
}
