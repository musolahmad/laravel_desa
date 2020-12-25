<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_satuan extends Model
{
    //
    protected $table = 'tb_satuan';
    protected $fillable = ['kd_satuan','nm_satuan'];
}
