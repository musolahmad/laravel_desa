<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_apbdes extends Model
{
    //
    protected $table = 'tb_apbdes';
    protected $fillable = ['kd_apbdes','kd_rekening','th_anggaran','pagu'];
}
