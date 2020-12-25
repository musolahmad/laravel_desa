<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbpegawaiperiodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pegawaiperiode', function (Blueprint $table) {
            $table->id();
            $table->string('kd_periode',6);
            $table->string('kd_pegawai',6);            
            $table->string('kd_jabatan',6);  
            $table->timestamps();
            $table->foreign('kd_periode')->references('kd_periode')->on('tb_periode');
            $table->foreign('kd_pegawai')->references('kd_pegawai')->on('tb_pegawai');        
            $table->foreign('kd_jabatan')->references('kd_jabatan')->on('tb_jabatan');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pegawaiperiode');
    }
}
