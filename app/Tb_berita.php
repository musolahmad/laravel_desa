<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_berita extends Model
{
    //
    protected $table = 'tb_berita';
    protected $fillable = ['id','kd_admin','judul','isi','foto_berita'];
}
