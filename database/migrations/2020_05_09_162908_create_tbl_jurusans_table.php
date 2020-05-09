<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblJurusansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_jurusans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_jurusan', 30);
            $table->string('nama_jurusan', 30);
            $table->string('akreditas', 1);
            $table->date('th_akreditas');
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
        Schema::dropIfExists('tbl_jurusans');
    }
}
