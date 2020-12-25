<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbadminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_admin', function (Blueprint $table) {
            $table->string('kd_admin',6)->primary();
            $table->string('kd_pegawai',6);
            $table->string('email',100)->unique();
            $table->text('password');
            $table->enum('lvl_admin',['1','2']);            
            $table->timestamps();            
            $table->foreign('kd_pegawai')->references('kd_pegawai')->on('tb_pegawai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_admin');
    }
}
