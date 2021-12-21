<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAdminInstansisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_admin_instansis', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->Integer('instansi_pendidikan_id')->unsigned();
            $table->string('nik',16)->nullable();
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
        Schema::dropIfExists('user_admin_instansis');
    }
}
