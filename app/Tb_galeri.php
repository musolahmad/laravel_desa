<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_galeri extends Model
{
    //
    protected $table = 'tb_galeri';
    protected $fillable = ['kode','gambar'];
}
