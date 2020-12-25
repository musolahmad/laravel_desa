<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbApbdesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_apbdes', function (Blueprint $table) {
            $table->string('kd_apbdes',24)->primary();
            $table->string('kd_rekening',20);
            $table->year('th_anggaran');
            $table->bigInteger('pagu_rencana');
            $table->bigInteger('pagu_realisasi');
            $table->timestamps();
            $table->foreign('kd_rekening')->references('kd_rekening')->on('tb_master_apbdes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_apbdes');
    }
}
