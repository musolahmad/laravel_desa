<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbprofildesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_profildesa', function (Blueprint $table) {
            $table->id();
            $table->string('nm_desa',30);
            $table->text('alamat');
            $table->text('website');
            $table->text('logo');
            $table->string('kd_pos',10);
            $table->string('hr_krj',30);
            $table->string('jm_krj',30);
            $table->text('peta');
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
        Schema::dropIfExists('tb_profildesa');
    }
}
