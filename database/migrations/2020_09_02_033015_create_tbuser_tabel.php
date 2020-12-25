<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbuserTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->string('kd_user',10)->primary();
            $table->string('nama_depan',30);
            $table->string('nama_belakang',30);
            $table->string('email',100)->unique();
            $table->text('password');
            $table->enum('jns_kelamin', ['l', 'p']);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('no_telp',25);
            $table->text('foto_profil');
            $table->enum('status_user', ['1', '2', '3']);
            $table->date('tgl_daftar');
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
        Schema::dropIfExists('tb_user');
    }
}
