<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblKusionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kusioners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('pertanyaan_1', 255);
            $table->string('pertanyaan_2', 255);
            $table->string('pertanyaan_3', 255);
            $table->string('pertanyaan_4', 255);
            $table->string('pertanyaan_5', 255);
            $table->string('pertanyaan_6', 255);
            $table->string('pertanyaan_7', 255);
            $table->string('pertanyaan_8', 255);
            $table->string('pertanyaan_9', 255);
            $table->string('pertanyaan_10', 255);
            $table->string('pertanyaan_11', 255);
            $table->string('pertanyaan_12', 255);
            $table->string('pertanyaan_13', 255);
            $table->string('pertanyaan_14', 255);
            $table->string('pertanyaan_15', 255);
            $table->string('pertanyaan_16', 255);
            $table->string('pertanyaan_17', 255);
            $table->string('pertanyaan_18', 255);
            $table->string('pertanyaan_19', 255);
            $table->string('pertanyaan_20', 255);
            $table->string('pertanyaan_21', 255);
            $table->string('pertanyaan_22', 255);
            $table->string('pertanyaan_23', 255);
            $table->string('pertanyaan_24', 255);
            $table->string('pertanyaan_25', 255);
            $table->string('pertanyaan_26', 255);
            $table->string('pertanyaan_27', 255);
            $table->string('pertanyaan_28', 255);
            $table->string('pertanyaan_29', 255);
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
        Schema::dropIfExists('tbl__kusioners');
    }
}
