<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAttributsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_attributs', function (Blueprint $table) {
            $table->dropPrimary();
            $table->unsignedInteger('id');
            $table->string('nama', 55);
            $table->string('tempat_lahir', 55);
            $table->string('status', 55);
            $table->integer('no_hp');
            $table->date('tgl_lahir');
            $table->string('alamat', 255);
            $table->string('jurusan_prodi', 55);
            $table->date('th_masuk');
            $table->date('th_lulus');
            $table->string('tempat_bekerja', 55);
            $table->date('waktu_lulus_bekerja');
            $table->binary('path_foto');
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
        Schema::dropIfExists('users_attributs');
    }
}
