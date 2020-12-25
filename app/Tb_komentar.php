<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_komentar extends Model
{
    //
    protected $table = 'tb_komentar';
    protected $fillable = ['kd_komentar','kd_aduan','kd_admin','status','komentar'];
}
