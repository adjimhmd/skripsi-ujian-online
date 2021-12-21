<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_soals', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->integer('master_kelas_id')->unsigned();
            $table->integer('master_mapel_id')->unsigned();
            $table->enum('tipe_soal', ['objektif', 'subjektif', 'penjodohan', 'true-false']);
            $table->longText('soal');
            $table->longText('jawaban')->nullable();
            $table->longText('pembahasan');
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
        Schema::dropIfExists('bank_soals');
    }
}
