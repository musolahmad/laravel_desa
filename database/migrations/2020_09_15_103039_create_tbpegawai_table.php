<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbpegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pegawai', function (Blueprint $table) {
            $table->string('kd_pegawai',6)->primary();
            $table->string('nip_nik',30);
            $table->string('nm_pegawai', 50);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->enum('jns_kelamin',['l','p']);            
            $table->text('foto_profil');         
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
        Schema::dropIfExists('tb_pegawai');
    }
}
