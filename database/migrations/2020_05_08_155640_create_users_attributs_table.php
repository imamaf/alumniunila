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
            $table->increments('id');
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
<<<<<<< HEAD:database/migrations/2020_05_02_091604_create_users_attributs_table.php
            $table->string('path_foto');
=======
            $table->binary('path_foto');
>>>>>>> 80a134672e5cff95b5e9e65f1b34af8596066dfe:database/migrations/2020_05_08_155640_create_users_attributs_table.php
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
