<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbberitaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_berita', function (Blueprint $table) {
            $table->id();
            $table->string('kd_admin',6);
            $table->text('judul');   
            $table->text('isi');         
            $table->text('foto_berita'); 
            $table->integer('jml_baca');
            $table->timestamps();
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
        Schema::dropIfExists('tb_berita');
    }
}
