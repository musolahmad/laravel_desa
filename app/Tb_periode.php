<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_periode extends Model
{
    //
    protected $table = 'tb_periode';
    protected $fillable = ['kd_periode','awal','akhir'];
}
