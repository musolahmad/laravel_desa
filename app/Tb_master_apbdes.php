<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_master_apbdes extends Model
{
    //
    protected $table = 'tb_master_apbdes';
    protected $fillable = ['id','uraian','jns_akun','kd_induk'];
}
