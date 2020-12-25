<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbmasterapbdesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_master_apbdes', function (Blueprint $table) {
            $table->string('kd_rekening',20)->primary();
            $table->string('uraian',50);
            $table->enum('jns_akun',['1','2']);
            $table->string('kd_induk',20);
            $table->enum('tipe_akun',['1','2']);
            $table->integer('no_urut');
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
        Schema::dropIfExists('tb_master_apbdes');
    }
}
