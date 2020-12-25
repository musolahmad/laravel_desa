<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbReferensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_referensi', function (Blueprint $table) {
            $table->id();
            $table->string('kd_kegiatan',30);
            $table->string('kd_aduan',12);
            $table->timestamps();
            $table->foreign('kd_kegiatan')->references('kd_kegiatan')->on('tb_rkp');
            $table->foreign('kd_aduan')->references('kd_aduan')->on('tb_aduan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_referensi');
    }
}
