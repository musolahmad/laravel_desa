<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbaduanTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_aduan', function (Blueprint $table) {
            $table->string('kd_aduan',12)->primary();
            $table->string('kd_user',10);
            $table->string('judul',50);
            $table->text('lokasi');
            $table->text('isi');
            $table->enum('baca',['1','2']);
            $table->enum('status',['Masuk','Diterima','Diajukan','Ditolak']);
            $table->integer('jml_baca');
            $table->timestamps();            
            $table->foreign('kd_user')->references('kd_user')->on('tb_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_aduan');
    }
}
