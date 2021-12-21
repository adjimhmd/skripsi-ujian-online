<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_gurus', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->string('no_telp',14)->nullable();
            $table->string('nuptk',16)->nullable();
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
        Schema::dropIfExists('user_gurus');
    }
}
