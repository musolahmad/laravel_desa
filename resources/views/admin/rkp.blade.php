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
                                    <li class="waves-effect waves-light hide-on-small-only"><a href="" class="judul"><i class="material-icons">book</i> Rencana Kerja Pemerintah Tahun {{$th}}</a></li>
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
        <div class="col m12" id="colres">
            <label class="right">Tahun {{$th}} <span class="right tooltipped" data-position="right" data-tooltip="Atur Tahun Anggaran yang ditampilkan"><a class="modal-trigger" href="#modal"> <i class="material-icons" style="color: #333;">settings</i></a></span></label>  
            <div id="modal" class="modal">
                <div class="modal-content white">
                    <h5>Tahun Anggaran yang ditampilkan</h5>
                    <div class="row">
                        <form method="post" action="{{url('')}}/rkp">
                            <div class="input-field col s12">
                                @csrf
                                <div class="input-field col s1" style="float: left;">
                                    <i class="material-icons prefix md-prefix">looks_one</i>
                                </div>
                                <div class="input-field col s11 right" style="margin: -5px 0 20px;">
                                    <select name="th" id="th" required>
                                        <?php
                                           $thn_skr = date('Y')+1;
                                           for ($x=$thn_skr; $x >=2015; $x--) { 
                                           ?> 
                                           <option <?php if($x==$th) echo "selected='selected'"?> value="<?php echo $x;?>"><?php echo $x;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="modal-footer white">
                                    <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Tampilkan</button>
                                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>       
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
                        <th rowspan="2" style="text-align: center;">Aksi</th>
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
                    @foreach($master as $m)
                    <tr>
                        <td>{{$m->kd_rekening}}.</td>
                        <td colspan="12"><b style="color:red;">{{$m->uraian}}</b></td>
                        <td style="text-align: center;">
                            <a href="{{url('')}}/rkp/tambah/{{$th}}/{{$m->kd_rekening}}" type="button" class="btn small blue-grey waves-effect waves-light" title="Tambah Data">Tambah</a>
                        </td>
                    </tr>
                    <?php 
                      $rkp= App\Tb_rkp::join('tb_master_apbdes','tb_master_apbdes.kd_rekening','=','tb_rkp.kd_rekening')->join('tb_satuan','tb_satuan.kd_satuan','=','tb_rkp.kd_satuan')->where(['tb_rkp.kd_rekening'=>$m->kd_rekening,'tb_rkp.th_anggaran'=>$th])->get();
                    ?>
                    @foreach($rkp as $r)
                    <tr>
                         <td>{{$r->kd_rekening.'.'.$r->no_urut_kegiatan}}</td>
                         <td>{{$m->uraian}}</td>
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
                         <form action="{{url('')}}/rkp/{{$r->kd_kegiatan}}" method="post">
                            @method('delete')
                            @csrf
                            <td>
                                <input type="hidden" name="kd_rekening" value="{{$r->kd_rekening}}">
                                <input type="hidden" name="th_anggaran" value="{{$th}}">
                                <input type="hidden" name="no_urut_kegiatan" value="{{$r->no_urut_kegiatan}}">
                                <a class="btn small green waves-effect waves-light" title="Edit Data" href="{{url('')}}/rkp/{{$r->kd_kegiatan}}"><i class="material-icons">edit</i></a>
                                <button class="btn small deep-orange waves-effect waves-light" type="submit" title="Hapus Data"><i class="material-icons">delete</i> </button>
                                <a class="btn small blue waves-effect waves-light" title="Tambah Detail" href="{{url('')}}/{{$r->kd_kegiatan}}/rkp/edit"><i class="material-icons">add</i></a>
                            </td>
                        </form>
                    </tr>    
                    @endforeach
                    @if($rkp->isEmpty())
                        <tr><td colspan="14"><center>Tidak ada data yang ditemukan</center></td></tr>
                    @endif
                    @endforeach
                    @if($master->isEmpty())
                        <tr><td colspan="14"><center><p class="add">Tidak ada data yang ditemukan. <u><a href="{{url('')}}/apbdes/master">Tambah data baru</a></u></p></center></td></tr>
                    @endif
                </tbody>
            </table>        
        </div>   
    </div>

</main>
<!-- Main END -->
@endsection 