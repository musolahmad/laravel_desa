<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_user extends Model
{
    //
    protected $table = 'tb_user';
    protected $fillable = ['kd_user','nama_depan','nama_belakang','email','password','jns_kelamin','tgl_lahir','alamat','no_telp','foto_profil','status_user','tgl_daftar'];
}
