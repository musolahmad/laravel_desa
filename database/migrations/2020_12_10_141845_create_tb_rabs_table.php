<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbRabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_rab', function (Blueprint $table) {
            $table->id();
            $table->string('kd_kegiatan',30);
            $table->string('uraian',50);
            $table->integer('no_urut');
            $table->enum('jns_belanja',['1','2','3']);  
            $table->integer('vol_rab');
            $table->string('kd_satuan',10);
            $table->integer('hrg_satuan');
            $table->timestamps();
            $table->foreign('kd_kegiatan')->references('kd_kegiatan')->on('tb_rkp');
            $table->foreign('kd_satuan')->references('kd_satuan')->on('tb_satuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_rab');
    }
}
