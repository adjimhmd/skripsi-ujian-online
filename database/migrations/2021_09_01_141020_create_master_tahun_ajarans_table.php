<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTahunAjaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_tahun_ajarans', function (Blueprint $table) {
            $table->id();
            $table->char('tahun_awal',4);
            $table->char('tahun_akhir',4);
            $table->enum('semester', ['ganjil', 'genap']);
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
        Schema::dropIfExists('master_tahun_ajarans');
    }
}
