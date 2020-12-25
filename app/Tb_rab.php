<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_rab extends Model
{
    //
    protected $table = 'tb_rab';
    protected $fillable = ['kd_kegiatan','uraian','no_urut','jns_belanja','vol_rab','kd_satuan','hrg_satuan'];
}
