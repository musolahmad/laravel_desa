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
                                    <li class="waves-effect waves-light hide-on-small-only"><a href="" class="judul"><i class="material-icons">book</i> Realisasi APBDes Tahun {{$th}}</a></li>
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
                        <form method="post" action="{{url('')}}/realisasi">
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
                        <th width="10%">Kode Rekening</th>
                        <th width="20%">Uraian</th>
                        <th width="16%">Pagu Anggaran</th>
                        <th width="16%">Realisasi Anggaran</th>
                        <th width="7%">Tindakan</th>
                        <th width="16%">Lebih / Kurang</th>
                    </tr>                    
                </thead>
                <tbody>
                    @foreach($master as $m)
                    <tr>
                        <td>{{$m->kd_rekening}}.</td>
                        <td>@if($m->kd_induk==0)<b style="color:red;">{{$m->uraian}}</b>@else @if($m->tipe_akun==1)<b>{{$m->uraian}}</b>@else{{$m->uraian}}@endif @endif</td>
                        <td>Rp <span class="right">
                            <?php 
                                 $pagu= App\Tb_apbdes::where(['kd_rekening'=>$m->kd_rekening,'th_anggaran'=>$th])->first();
                            ?>
                            @if($m->kd_induk==0)<b style="color:red;">@if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana,0,',','.')}}@endif</b>@else @if($m->tipe_akun==1)<b> @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana,0,',','.')}}@endif</b>@else @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana,0,',','.')}}@endif @endif @endif</span>
                        </td>
                        <td>Rp <span class="right">                            
                            @if($m->kd_induk==0)<b style="color:red;">@if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_realisasi,0,',','.')}}@endif</b>@else @if($m->tipe_akun==1)<b> @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_realisasi,0,',','.')}}@endif</b>@else @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_realisasi,0,',','.')}}@endif @endif @endif</span>
                        </td>
                        <td>
                            @if($m->tipe_akun==2)
                                <a class="btn small green waves-effect waves-light modal-trigger" href="#m" onclick="edit('{{$m->kd_rekening}}','{{$m->uraian}}','@if(empty($pagu)){{"0"}}@else{{number_format($pagu->pagu_realisasi,0,',','.')}}@endif','{{$th}}','{{$m->kd_induk}}');" title="Edit Data"><i class="material-icons">edit</i> Edit</a> 
                            @endif    
                        </td>
                        <td>Rp <span class="right">                            
                            @if($m->kd_induk==0)<b style="color:red;">@if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana-$pagu->pagu_realisasi,0,',','.')}}@endif</b>@else @if($m->tipe_akun==1)<b> @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana-$pagu->pagu_realisasi,0,',','.')}}@endif</b>@else @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana-$pagu->pagu_realisasi,0,',','.')}}@endif @endif @endif</span>
                        </td>                        
                    </tr>
                    @endforeach
                    @if($master->isEmpty())
                        <tr><td colspan="5"><center><p class="add">Tidak ada data yang ditemukan. <u><a href="#modal" class="modal-trigger">Tambah data baru</a></u></p></center></td></tr>
                    @endif
                </tbody>
            </table>
            <div id="m" class="modal">
                <div class="modal-content white">
                    <h5>Edit Data Pagu Anggaran</h5>
                    <div class="row">
                        <form method="post" action="{{url('')}}/realisasi/apbdes">
                            @csrf
                            <div class="input-field col s12">
                                <i class="material-icons prefix md-prefix">book</i>
                                <input id="uraian_edit" type="text" name="uraian_edit" disabled>
                                <input id="kd_rekening_edit" type="hidden" name="kd_rekening_edit" >  
                                <input id="th_edit" type="hidden" name="th_edit" >   
                                <input id="kd_induk_edit" type="hidden" name="kd_induk_edit" >                           
                            </div> 
                            <div class="input-field col s12">
                                <i class="material-icons prefix md-prefix">attach_money</i>
                                <input class="uang" id="pagu" type="text" name="pagu" required oninvalid="this.setCustomValidity('data tidak boleh kosong')">
                                <label for="nama_master">Pagu Anggaran</label>                                            
                            </div>                             
                            <div class="modal-footer white">
                                <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Ubah</button>
                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>             
        </div>   
    </div>

</main>
<!-- Main END -->
<script type="text/javascript">
    function edit(kd_rekening,uraian,pagu,th,kd_induk) {
    // body...
        document.getElementById('uraian_edit').value=uraian;
        document.getElementById('kd_rekening_edit').value=kd_rekening;
        document.getElementById('pagu').value=pagu;
        document.getElementById('th_edit').value=th;
        document.getElementById('kd_induk_edit').value=kd_induk;
    }
</script>
@endsection 