<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_profildesa extends Model
{
    //
    protected $table = 'tb_profildesa';
    protected $fillable = ['id','nm_desa','alamat','website','logo'];
}
