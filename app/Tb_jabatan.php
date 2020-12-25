<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_jabatan extends Model
{
    //
    protected $table = 'tb_jabatan';
    protected $fillable = ['kd_jabatan','nm_jabatan'];
}
