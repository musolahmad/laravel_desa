@extends('layouts.admin')

@section('content')
<main>

    <!-- container START -->
    <div class="container"> 
        <!-- Row Start -->
        <div class="row">
            <!-- Secondary Nav START -->
            <div class="col s12">
                <div class="z-depth-1">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <div class="col m12">
                                <ul class="left">
                                    <li class="waves-effect waves-light hide-on-small-only"><a href="{{url('')}}/rkp/@if(!empty($r)){{$r->th_anggaran}}@endif"><i class="material-icons">book</i> RKP @if(!empty($r)){{$r->th_anggaran}}@endif</a></li>
                                    @if(!empty($r))
                                     <li class="waves-effect waves-light"><small><a href="#referensi" class="modal-trigger" onclick="tambah();"><i class="material-icons md-24">add_circle</i> Referensi Aduan</a></small></li>
                                    @endif 
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            
            <!-- Secondary Nav END -->
        </div>
        <!-- Row END -->
        @if(session('berhasil'))
        <div id="alert-message" class="row">
            <div class="col m12">
                <div class="card green lighten-5">
                    <div class="card-content notif">
                        <span class="card-title green-text"><i class="material-icons md-36">done</i> {{session('berhasil')}}</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
         @if(session('gagal'))
        <div id="alert-message" class="row">
            <div class="col m12">
                <div class="card red lighten-5">
                    <div class="card-content notif">
                        <span class="card-title red-text"><i class="material-icons md-36">close</i> {{session('gagal')}}</span>
                    </div>
                </div>
            </div>
        </div>
        @endif  
        @if(!empty($r))
        <form method="post" action="{{url('')}}/{{$r->kd_kegiatan}}/rkp_tambah" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="input-field col s4 m5">
                            <div class="file-field input-field">
                                <div class="btn light-green darken-1">
                                    <span>File</span>
                                    <input type="file" id="gambar" name="gambar">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path" type="text" placeholder="Upload Foto Galeri">
                                </div>
                                @error('gambar')
                                 <small class="red-text">*{{ $message }}</small><br>
                                @enderror
                            </div>
                    </div> 
                    <div class="input-field col s4 m5">
                        <select class="file-field input-field" name="kode" id="kode">
                           <option value="{{$r->kd_gbr_awl}}">Foto Sebelum Pelaksanaan</option>
                           <option value="{{$r->kd_gbr_akh}}">Foto Sesudah Pelaksanaan</option>
                        </select>
                    </div> 
                    <div class="input-field col s4 m2" style="text-align: right;">
                        <button type="submit" name="submit" class="btn-large blue-grey waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                    </div>
                    <div class="input-field col s12 m12">
                     <small class="red-text">*Format file yang diperbolehkan hanya *.JPG, *.PNG dan ukuran maksimal file 2 MB. Disarankan gambar berbentuk kotak atau lingkaran!</small>
                    </div> 
                </div>
        </form>  
        @endif   
        <div class="col m12" id="colres">
           <table class="bordered" id="tbl">
                <thead class="blue lighten-4" id="head">
                    <tr>
                        <th rowspan="2" style="text-align: center;">KD</th>
                        <th colspan="2" style="text-align: center;">Bidang/Jenis Kegiatan</th>
                        <th rowspan="2" style="text-align: center;">Lokasi <p>(RT, RW, Dusun)</p></th>
                        <th rowspan="2" style="text-align: center;">Perkiraan Volume</th>
                        <th rowspan="2" style="text-align: center;">Sasaran / Manfaat </th>
                        <th rowspan="2" style="text-align: center;">Waktu Pelaksanaan</th>
                        <th colspan="2" style="text-align: center;">Prakiraan Biaya & Sumber Dana</th>
                        <th colspan="3" style="text-align: center;">Pola Pelaksanaan</th>
                        <th rowspan="2" style="text-align: center;">Rencana Pelaksana Kegiatan</th>
                    </tr>  
                     <tr>
                        <th style="text-align: center;">Bidang</th>
                        <th style="text-align: center;">Jenis Kegiatan</th>
                        <th style="text-align: center;">Jumlah (Rupiah)</th>
                        <th style="text-align: center;">Sumber</th>
                        <th style="text-align: center;">Swa Kelola</th>
                        <th style="text-align: center;">Kerja Sama</th>
                        <th style="text-align: center;">Pihak Ketiga</th>
                    </tr>                       
                </thead>
                <tbody>                    
                    @if(!empty($r))
                    <tr>
                        <td>{{$r->kd_rekening}}.</td>
                        <td colspan="12"><b style="color:red;">{{$r->uraian}}</b></td>
                    </tr>
                    <tr>
                         <td>{{$r->kd_rekening.'.'.$r->no_urut_kegiatan}}</td>
                         <td>{{$r->uraian}}</td>
                         <td>{{$r->nm_kegiatan}}</td>
                         <td>{{$r->lokasi}}</td>
                         <td style="text-align: center;">{{number_format($r->volume,0,',','.')}} {{$r->nm_satuan}}</td>
                         <td>{{$r->sasaran}}</td>
                         <td>{{date('d-m-Y',strtotime($r->tgl_awal))}} - {{date('d-m-Y',strtotime($r->tgl_akhir))}}</td>
                         <td style="text-align: right;">{{number_format($r->biaya,0,',','.')}}</td>
                         <?php 
                          $sumber= App\Tb_master_apbdes::where(['kd_rekening'=>$r->sumber])->first();
                        ?>
                         <td>{{$sumber->uraian}}</td>
                         <td>@if($r->pola_pelaksanaan==1) <i class="material-icons md-36">check</i> @endif</td>
                         <td>@if($r->pola_pelaksanaan==2) <i class="material-icons md-36">check</i> @endif</td>
                         <td>@if($r->pola_pelaksanaan==3) <i class="material-icons md-36">check</i> @endif</td>
                         <td>{{$r->pelaksana}}</td>                         
                    </tr>    
                    @else
                        <tr><td colspan="13"><center>Tidak ada data yang ditemukan</center></td></tr>
                    @endif
                </tbody>
            </table>        
        </div>
        @if(!empty($r))
        <div class="row">
            <!-- Secondary Nav START -->
            <div class="col s12">
                <div class="z-depth-1">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <div class="col m12">
                                <ul class="left">
                                    <li class="waves-effect waves-light><a href=""><i class="material-icons">book</i> Rencana Anggaran Biaya</a></li>
                                    <li class="waves-effect waves-light"><a href="#tambah" class="modal-trigger" onclick="tambah();"><i class="material-icons md-24">add_circle</i> Tambah RAB</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Secondary Nav END -->
        </div>

            <div class="col m12" id="colres">
               <table class="bordered" id="tbl">
                    <thead class="blue lighten-4" id="head">
                        <tr>
                            <th width="10%" rowspan="2" style="text-align: center;">No / Kode Rekening</th>
                            <th width="25%" rowspan="2" style="text-align: center;">Uraian</th>
                            <th width="30%" colspan="3" style="text-align: center;">Rincian Perhitungan</th>
                            <th width="20%" rowspan="2" style="text-align: center;">Jumlah (Rp)</th>
                            <th width="15%" rowspan="2" style="text-align: center;">Aksi</th>
                        </tr> 
                        <tr>
                            <th style="text-align: center;">Volume</th>
                            <th style="text-align: center;">Satuan</th>
                            <th style="text-align: center;">Harga Satuan (Rp)</th>
                        </tr>                       
                    </thead>
                    <tbody> 
                        <tr>
                            <td style="text-align: center;">1</td>
                            <td style="text-align: center;">2</td>
                            <td style="text-align: center;">3</td>
                            <td style="text-align: center;">4</td>
                            <td style="text-align: center;">5</td>
                            <td style="text-align: center;">6 = (3X5)</td>
                            <td></td>
                        </tr> 
                        <?php 
                            $rab = App\Tb_rab::join('tb_rkp','tb_rkp.kd_kegiatan','=','tb_rab.kd_kegiatan')->where('tb_rab.kd_kegiatan',$r->kd_kegiatan)->groupBy('jns_belanja')->get();
                            $tot=0;
                            $no=0;
                        ?>    
                        @foreach($rab as $ra)
                        <tr>
                            <td><b>{{$ra->kd_rekening}}.{{$ra->no_urut_kegiatan}}.{{$ra->jns_belanja}}</b></td>
                            <td colspan="6"><b>@if($ra->jns_belanja=='1'){{'Belanja Pegawai'}}@elseif($ra->jns_belanja=='2'){{'Belanja Barang dan Jasa'}}@else{{'Belanja Modal'}}@endif</b></td>
                        </tr>
                        <?php 
                            $detail = App\Tb_rab::join('tb_rkp','tb_rkp.kd_kegiatan','=','tb_rab.kd_kegiatan')->join('tb_satuan','tb_satuan.kd_satuan','=','tb_rab.kd_satuan')->where('tb_rab.kd_kegiatan',$r->kd_kegiatan)->where('jns_belanja',$ra->jns_belanja)->get();

                            $no_urut = App\Tb_rab::where('kd_kegiatan',$r->kd_kegiatan)->where('jns_belanja',$ra->jns_belanja)->orderBy('no_urut','DESC')->first();

                            $jumlah=0; 
                        ?>
                        @foreach($detail as $det) 
                         <tr>
                            <td>{{$ra->kd_rekening}}.{{$ra->no_urut_kegiatan}}.{{$ra->jns_belanja}}.{{$det->no_urut}}</td>
                            <td>{{$det->uraian}}</td>
                            <td style="text-align: center;">{{$det->vol_rab}}</td>
                            <td style="text-align: center;">{{$det->nm_satuan}}</td>
                            <td style="text-align: right;">{{number_format($det->hrg_satuan,0,',','.')}}</td>
                            <td style="text-align: right;">{{number_format($det->vol_rab*$det->hrg_satuan,0,',','.')}}</td>
                            @if($no_urut->no_urut==$det->no_urut)
                            <form action="{{url('')}}/rab/{{$det->id}}" method="post">
                            @method('delete')
                            @csrf
                                <td style="text-align: right;">
                                    <a class="btn small green waves-effect waves-light modal-trigger" href="#edit" onclick="edit('{{$det->id}}','{{$det->uraian}}','{{$det->jns_belanja}}','{{$det->vol_rab}}','{{$det->kd_satuan}}','{{$det->hrg_satuan}}');"><i class="material-icons" title="Edit">edit</i></a>
                                    <input type="hidden" name="kd_kegiatan_hapus" value="{{$r->kd_kegiatan}}" id="kd_kegiatan_hapus">
                                    <button class="btn small deep-orange waves-effect waves-light" type="submit" title="Hapus"><i class="material-icons">delete</i></button>
                                </td>
                            </form>
                            @else
                             <td style="text-align: right;">
                                <a class="btn small green waves-effect waves-light modal-trigger" href="#edit" onclick="edit('{{$det->id}}','{{$det->uraian}}','{{$det->jns_belanja}}','{{$det->vol_rab}}','{{$det->kd_satuan}}','{{$det->hrg_satuan}}');"><i class="material-icons" title="Edit">edit</i></a>
                            </td>
                            @endif
                        </tr>
                        <?php 
                            $jumlah = $jumlah+($det->vol_rab*$det->hrg_satuan);
                            $tot = $tot+$jumlah;
                        ?>
                       @endforeach 
                       <?php $no=$no+1; ?>
                        <tr>
                            <th colspan="5" style="text-align: right;">Sub Total ({{$no}})</th>
                            <th style="text-align: right;">{{number_format($jumlah,0,',','.')}}</th>
                            <th></th>
                        </tr>        
                        @endforeach                   
                        @if($rab->isEmpty())
                            <tr><td colspan="7"><center>Tidak ada data yang ditemukan</center></td></tr>
                        @endif
                    </tbody>
                    <thead class="blue lighten-4" id="head">
                        <tr>
                            <th colspan="5" style="text-align: right;">Jumlah (Rp.)</th>
                            <th style="text-align: right;">{{number_format($tot,0,',','.')}}</th>
                            <th></th>
                        </tr>                  
                    </thead>
                    <thead class="blue lighten-4" id="head">
                        <tr>
                            <th colspan="5" style="text-align: right;">Sisa Pagu Anggaran ({{number_format($r->biaya,0,',','.')}} - {{number_format($tot,0,',','.')}})</th>
                            <th style="text-align: right;">{{number_format($r->biaya-$tot,0,',','.')}}</th>
                            <th></th>
                        </tr>                  
                    </thead>
                </table>        
            </div>
        <div class="row">
            <!-- Secondary Nav START -->
            <div class="col s12">
                <div class="z-depth-1">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <div class="col m12">
                                <ul class="left">
                                    <li class="waves-effect waves-light><a href=""><i class="material-icons">book</i> Daftar Referensi Aduan</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Secondary Nav END -->
        </div>
        <div class="row">
            @foreach($listreferensi as $rfs)
                <div class="col s12 m6">
                    <div class="col s12 m5">
                        <img src="{{url('')}}/storage/{{$rfs->gambar}}" width="100%"/>
                    </div>
                    <div class="col s12 m7">
                        <h5><b>{{$rfs->judul}}</b></h5>
                        <p>Lokasi : {{$rfs->lokasi}}</p>
                        <p>{{$rfs->isi}}</p>
                        <form method="post" action="{{url('')}}/referensi/{{$rfs->kd_aduan}}">
                            @method('delete')
                            @csrf
                            <input type="hidden" name="kd_kegiatan_hapus" value="{{$r->kd_kegiatan}}">
                            <button type="submit" class="btn small deep-orange waves-effect waves-light col s12" title="Hapus Referensi">Hapus<i class="material-icons">delete</i></button>
                        </form>
                    </div>
                </div>    
           @endforeach
           @if($listreferensi->isEmpty())
           <p style="text-align: center;">Tidak ada data Referensi</p>
           @endif
        </div>
        <div class="row">
            <!-- Secondary Nav START -->
            <div class="col s12">
                <div class="z-depth-1">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <div class="col m12">
                                <ul class="left">
                                    <li class="waves-effect waves-light><a href=""><i class="material-icons">add_a_photo</i> Foto Galeri</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Secondary Nav END -->
            <div class="col s12 m6">
                <p><label>Foto Sebelum Kegiatan</label></p>
                <div class="row">
                @foreach($foto_sblm as $glr)
                <div class="col s12 m6">
                    <img src="{{url('')}}/storage/{{$glr->gambar}}" width="100%"/>
                    <form method="post" action="{{url('')}}/rkp/{{$r->kd_kegiatan}}/sebelum/{{$glr->kode}}">
                    @csrf
                    <input type="hidden" name="file_sblm" value="{{$glr->gambar}}">
                    <div class="col s12">
                        <button type="submit" class="btn small red col s12">Hapus <i class="material-icons">delete</i></button>
                    </div>
                    </form>
                </div>
                @endforeach
                @if($foto_sblm->isEmpty())
                <center><b>Tidak Ada Foto Sebelum Kegiatan</b></center>
                @endif
                </div>
            </div>
             <div class="col s12 m6">
                <p><label>Foto Sesudah Kegiatan</label></p>
                <div class="row">
                @foreach($foto_sdh as $glr)
                <div class="col s12 m6">
                    <img src="{{url('')}}/storage/{{$glr->gambar}}" width="100%"/>
                    <form method="post" action="{{url('')}}/rkp/{{$r->kd_kegiatan}}/sesudah/{{$glr->kode}}">
                    @csrf
                    <input type="hidden" name="file_sdh" value="{{$glr->gambar}}">
                    <div class="col s12">
                        <button type="submit" class="btn small red col s12">Hapus <i class="material-icons">delete</i></button>
                    </div>
                    </form>
                </div>
                @endforeach
                @if($foto_sdh->isEmpty())
                <center><b>Tidak Ada Foto Sesudah Kegiatan</b></center>
                @endif
                </div>
                <div id="tambah" class="modal">
                    <div class="modal-content white">
                        <h5>Tambah RAB</h5>
                        <div class="row">
                            <form method="post" action="{{url('')}}/rab">
                                <div class="input-field col s12">
                                @csrf
                                    <i class="material-icons prefix md-prefix">assistant</i>
                                    <input id="uraian" type="text" name="uraian" value="" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                    <label for="uraian">Uraian</label>    
                                </div>
                                <input type="hidden" name="kd_kegiatan" value="{{$r->kd_kegiatan}}">
                                <div class="row">
                                <div class="input-field col s3" style="float: left;">
                                    <label>Jenis Belanja</label>
                                </div>
                                <div class="input-field col s9 right" style="margin: -5px 0 20px;">
                                    <select class="browser-default validate" name="jns_belanja" id="jns_belanja" required>
                                        <option value="1">Belanja Pegawai</option>
                                        <option value="2">Belanja Barang dan Jasa</option>
                                        <option value="3">Belanja Modal</option>
                                    </select>
                                </div>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix md-prefix">insert_chart</i>                 
                                    <label for="volume">Volume</label>    
                                    <input id="volume" type="text" class="uang" name="volume" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')" value="0" onkeyup="kali();">
                                </div> 
                                <div class="row">
                                <div class="input-field col s2" style="float: left;">
                                    <label>Satuan</label>                        
                                </div>
                                <div class="input-field col s4 right" style="margin: -5px 0 20px;">
                                    <select name="kd_satuan" id="kd_satuan" class="browser-default validate">
                                        @foreach($satuan as $s)
                                        <option value="{{$s->kd_satuan}}">{{$s->nm_satuan}}</option> 
                                        @endforeach                           
                                    </select>
                                </div>    
                                </div>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix md-prefix">attach_money</i>                 
                                    <label for="hrg_satuan">Harga Satuan</label>    
                                    <input id="hrg_satuan" type="text" class="uang" name="hrg_satuan" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')" value="0" onkeyup="kali();">
                                </div>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix md-prefix">attach_money</i>                 
                                    <label for="total">Total Harga</label>    
                                    <input id="total" type="text" class="uang" name="total" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')" value="0" disabled>
                                    <small class="red-text">*sisa pagu anggaran Rp {{number_format($r->biaya-$tot,0,',','.')}}, Total Harga jangan sampai melebihi sisa anggaran</small>
                                </div>       
                                <div  class="input-field col s12">
                                    <div class="modal-footer white">
                                        <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Simpan</button>
                                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="edit" class="modal">
                    <div class="modal-content white">
                        <h5>EDIT RAB</h5>
                        <div class="row">
                            <form method="post" action="{{url('')}}/rab/edit">
                                <div class="input-field col s12">
                                @method('put')
                                @csrf
                                    <i class="material-icons prefix md-prefix">assistant</i>
                                    <input id="uraian_edit" type="text" name="uraian_edit" value="" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                    <label for="uraian_edit">Uraian</label>    
                                </div>
                                <input type="hidden" name="kd_kegiatan_edit" value="{{$r->kd_kegiatan}}">
                                <input type="hidden" name="id_edit" id="id_edit">
                                <div class="row">
                                <div class="input-field col s3" style="float: left;">
                                    <label>Jenis Belanja</label>
                                </div>
                                <div class="input-field col s9 right" style="margin: -5px 0 20px;">
                                    <select class="browser-default validate" name="jns_belanja_edit" id="jns_belanja_edit" required disabled>
                                        <option value="1">Belanja Pegawai</option>
                                        <option value="2">Belanja Barang dan Jasa</option>
                                        <option value="3">Belanja Modal</option>
                                    </select>
                                </div>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix md-prefix">insert_chart</i>                 
                                    <label for="volume_edit">Volume</label>    
                                    <input id="volume_edit" type="text" class="uang" name="volume_edit" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')" value="0" onkeyup="kali_edit();">
                                </div> 
                                <div class="row">
                                <div class="input-field col s2" style="float: left;">
                                    <label>Satuan</label>                        
                                </div>
                                <div class="input-field col s4 right" style="margin: -5px 0 20px;">
                                    <select name="kd_satuan_edit" id="kd_satuan_edit" class="browser-default validate">
                                        @foreach($satuan as $s)
                                        <option value="{{$s->kd_satuan}}">{{$s->nm_satuan}}</option> 
                                        @endforeach                           
                                    </select>
                                </div>    
                                </div>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix md-prefix">attach_money</i>                 
                                    <label for="hrg_satuan_edit">Harga Satuan</label>    
                                    <input id="hrg_satuan_edit" type="text" class="uang" name="hrg_satuan_edit" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')" value="0" onkeyup="kali_edit();">
                                </div>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix md-prefix">attach_money</i>                 
                                    <label for="total_edit">Total Harga</label>    
                                    <input id="total_edit" type="text" class="uang" name="total_edit" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')" value="0" disabled>
                                    <small class="red-text">*sisa pagu anggaran Rp {{number_format($r->biaya-$tot,0,',','.')}}, Total Harga jangan sampai melebihi sisa anggaran</small>
                                </div>       
                                <div  class="input-field col s12">
                                    <div class="modal-footer white">
                                        <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Edit</button>
                                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="referensi" class="modal">
                    <div class="modal-content white">
                        <h5>Referensi Aduan</h5>
                        @foreach($referensi as $rfs)
                        <div class="row">
                            
                            <div class="col s12 m4">
                                <img src="{{url('')}}/storage/{{$rfs->gambar}}" width="100%"/>
                            </div>
                            <div class="col s12 m7">
                                <h5><b>{{$rfs->judul}}</b></h5>
                                <p>Lokasi : {{$rfs->lokasi}}</p>
                                <p>{{$rfs->isi}}</p>
                            </div>
                            <div class="col s12 m1">
                                <form method="post" action="{{url('')}}/referensi">
                                    @csrf
                                    <input type="hidden" name="kd_kegiatan_referensi" value="{{$r->kd_kegiatan}}">
                                    <input type="hidden" name="kd_aduan_referensi" value="{{$rfs->kd_aduan}}">
                                    <button type="submit" class="btn small blue-grey waves-effect waves-light" title="Pilih Referensi"><i class="material-icons">check</i></button>
                                </form>
                            </div>
                        </div>    

                        @endforeach
                        <div class="modal-footer white">
                            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif   
    </div>

</main>
<!-- Main END -->
@endsection 
<script>
    function kali() {
        // body...
        var harga; var volume;
        harga = document.getElementById('hrg_satuan').value.replace('.', "");
        harga = harga.replace('.', "");
        harga = harga.replace('.', "");
        volume = document.getElementById('volume').value.replace('.', "");
        volume = volume.replace('.', "");
        volume = volume.replace('.', "");
        var total = parseInt(harga)*parseInt(volume);
        document.getElementById('total').value =new Number(total).toLocaleString("id-ID");

    }
    function kali_edit() {
        // body...
        var harga; var volume;
        harga = document.getElementById('hrg_satuan_edit').value.replace('.', "");
        harga = harga.replace('.', "");
        harga = harga.replace('.', "");
        volume = document.getElementById('volume_edit').value.replace('.', "");
        volume = volume.replace('.', "");
        volume = volume.replace('.', "");
        var total = parseInt(harga)*parseInt(volume);
        document.getElementById('total_edit').value =new Number(total).toLocaleString("id-ID");

    }
    function edit(id,uraian,jns_belanja,volume,nm_satuan,hrg_satuan) {
        // body...
        document.getElementById('id_edit').value=id;
        document.getElementById('uraian_edit').value=uraian;
        document.getElementById('jns_belanja_edit').selectedIndex=jns_belanja-1;
        document.getElementById('volume_edit').value=volume;
        document.getElementById('kd_satuan_edit').value=nm_satuan;
        document.getElementById('hrg_satuan_edit').value=new Number(hrg_satuan).toLocaleString("id-ID");
        document.getElementById('total_edit').value=new Number(hrg_satuan*volume).toLocaleString("id-ID");
    }
    function tambah() {
        // body...
        document.getElementById('uraian').value="";
        document.getElementById('jns_belanja').selectedIndex=0;
        document.getElementById('volume').value="0";
        document.getElementById('kd_satuan').selectedIndex=0;
        document.getElementById('hrg_satuan').value="0";
        document.getElementById('total').value="0"
    }
</script>