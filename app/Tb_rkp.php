<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_rkp extends Model
{
    //
    protected $table = 'tb_rkp';
    protected $fillable = ['kd_kegiatan','kd_apbdes','nm_kegiatan','lokasi','volume','kd_satuan','sasaran','tgl_awal','tgl_akhir','biaya','pola_pelaksanaan','pelaksana','kd_gbr_awl','kd_gbr_akh'];
}
