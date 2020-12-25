<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbRkpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_rkp', function (Blueprint $table) {
            $table->string('kd_kegiatan',30)->primary();
            $table->integer('no_urut_kegiatan');
            $table->year('th_anggaran');
            $table->string('kd_rekening',20);
            $table->string('nm_kegiatan',100);
            $table->text('lokasi');
            $table->double('volume');            
            $table->string('kd_satuan',10);
            $table->string('sasaran',50);
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->integer('biaya');
            $table->string('sumber',20);
            $table->enum('pola_pelaksanaan',['1','2','3']);  
            $table->string('pelaksana',50);
            $table->string('kd_gbr_awl',31);
            $table->string('kd_gbr_akh',31);
            $table->timestamps();
            $table->foreign('kd_rekening')->references('kd_rekening')->on('tb_master_apbdes');
            $table->foreign('kd_satuan')->references('kd_satuan')->on('tb_satuan');
             $table->foreign('sumber')->references('kd_rekening')->on('tb_master_apbdes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_rkp');
    }
}
