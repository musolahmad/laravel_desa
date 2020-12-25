<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_referensi extends Model
{
    //
    protected $table = 'tb_referensi';
    protected $fillable = ['kd_kegiatan','kd_aduan'];
}
