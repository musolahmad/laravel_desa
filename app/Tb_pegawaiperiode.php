<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_pegawaiperiode extends Model
{
    //
    protected $table = 'Tb_pegawaiperiode';
    protected $fillable = ['kd_periode','kd_pegawai','kd_jabatan'];
}
