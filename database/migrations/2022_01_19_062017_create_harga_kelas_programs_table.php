<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargaKelasProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harga_kelas_programs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kelas_program_id')->unsigned();
            $table->smallInteger('jumlah_bulan')->nullable();
            $table->decimal('harga',10,0)->nullable();
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
        Schema::dropIfExists('harga_kelas_programs');
    }
}
