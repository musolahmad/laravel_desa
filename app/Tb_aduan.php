<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_aduan extends Model
{
    //
    protected $table = 'tb_aduan';
    protected $fillable = ['kd_aduan','kd_user','judul','lokasi','isi','baca','status','jml_baca'];
}
