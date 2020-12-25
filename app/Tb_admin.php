<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_admin extends Model
{
    //
    protected $table = 'tb_admin';
    protected $fillable = ['kd_admin','kd_pegawai','email','password','lvl_admin'];
}
