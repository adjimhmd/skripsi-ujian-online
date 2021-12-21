<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kelas', function (Blueprint $table) {
            $table->id();
            $table->enum('tingkat', ['SD', 'SMP', 'SMA', 'UMUM']);
            $table->enum('kelas', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'])->nullable();
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
        Schema::dropIfExists('master_kelas');
    }
}
