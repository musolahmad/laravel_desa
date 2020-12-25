<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKomentarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_komentar', function (Blueprint $table) {
            $table->string('kd_komentar',12)->primary();
            $table->string('kd_aduan',12);
            $table->string('kd_admin',6);
            $table->enum('status',['Masuk','Diterima','Diajukan','Ditolak']);
            $table->text('komentar');
            $table->timestamps();
             $table->foreign('kd_aduan')->references('kd_aduan')->on('tb_aduan');
            $table->foreign('kd_admin')->references('kd_admin')->on('tb_admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_komentar');
    }
}
