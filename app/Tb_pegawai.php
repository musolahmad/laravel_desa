<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_pegawai extends Model
{
    //
    protected $table = 'tb_pegawai';
    protected $fillable = ['kd_pegawai','nip_nik','nm_pegawai','kd_jabatan','tgl_lahir','alamat','jns_kelamin','foto_profil'];
}
