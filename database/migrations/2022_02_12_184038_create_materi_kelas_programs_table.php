<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriKelasProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi_kelas_programs', function (Blueprint $table) {
            $table->id();
            $table->integer('master_materi_id')->unsigned();
            $table->integer('kelas_program_id')->unsigned();
            $table->enum('status', ['public','private'])->nullable();
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
        Schema::dropIfExists('materi_kelas_programs');
    }
}
