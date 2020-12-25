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
                                    <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons">book</i> APBDes Master</a></li>
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
            <a type="button" name="tambah" class="btn small blue-grey waves-effect waves-light modal-trigger" href="#modal" onclick="tambah();">Tambah Data <i class="material-icons">add_circle</i></a>
            <table class="bordered" id="tbl">
                <thead class="blue lighten-4" id="head">
                    <tr>
                        <th width="20%">Kode Rekening</th>
                        <th width="30%">Uraian</th>
                        <th width="20%">Jenis Akun</th>
                        <th width="30%">Tindakan</th>
                    </tr>                    
                </thead>
                <tbody>
                    @foreach($master as $m)
                    <tr>
                        <td>{{$m->kd_rekening}}.</td>
                        <td>@if($m->kd_induk==0)<b style="color:red;">{{$m->uraian}}</b>@else @if($m->tipe_akun==1)<b>{{$m->uraian}}</b>@else{{$m->uraian}}@endif @endif</td>
                        <td>@if($m->jns_akun==1){{'Debet'}}@else{{'Kredit'}}@endif</td>
                        <td>
                            <form action="{{url('')}}/apbdes/master/{{$m->kd_rekening}}" method="post">
                                @csrf
                                <?php 
                                    $e = App\Tb_master_apbdes::where('kd_induk', $m->kd_rekening)->first();
                                ?>
                                @if(empty($e))                            
                                <a class="btn small green waves-effect waves-light modal-trigger" href="#m_t" title="Edit Data" onclick="edit('{{$m->kd_rekening}}','{{$m->uraian}}','{{$m->tipe_akun}}');"><i class="material-icons">edit</i> Edit</a>
                                @else
                                <a class="btn small green waves-effect waves-light modal-trigger" href="#m" title="Edit Data" onclick="editm('{{$m->kd_rekening}}','{{$m->uraian}}');"><i class="material-icons">edit</i> Edit</a>
                                @endif 
                                <button type="submit" class="btn small red waves-effect waves-light" title="Hapus Data"><i class="material-icons">delete</i> Hapus</button>
                                @if($m->tipe_akun==1)
                                    <a class="btn small blue-grey waves-effect waves-light modal-trigger" href="#mt" title="Tambah Akun" onclick="tambahm('{{$m->kd_rekening}}','{{$m->jns_akun}}');"><i class="material-icons">add</i> Tambah</a>
                                @endif                            
                            </form>  
                        </td>
                    </tr>
                    @endforeach
                    @if($master->isEmpty())
                        <tr><td colspan="5"><center><p class="add">Tidak ada data yang ditemukan. <u><a href="#modal" class="modal-trigger">Tambah data baru</a></u></p></center></td></tr>
                    @endif
                </tbody>
            </table> 
            <div id="modal" class="modal">
                <div class="modal-content white">
                    <h5>Tambah Data Uraian</h5>
                    <div class="row">
                        <form method="post" action="{{url('')}}/apbdes/master">
                            @csrf
                            <div class="input-field col s12">
                                <i class="material-icons prefix md-prefix">book</i>
                                <input id="uraian" type="text" name="uraian" required oninvalid="this.setCustomValidity('data tidak boleh kosong')">
                                <label for="nama_master">Nama Akun / Uraian</label>                                            
                            </div> 
                            <div class="input-field col s2" style="float: left;">
                                <label>Jenis Akun</label>
                            </div>
                            <div class="input-field col s10 " style="margin: -5px 0 20px;">
                                <select class="browser-default validate " name="jns_akun" id="jns_akun" required>
                                    <option value="1">Debet</option>
                                    <option value="2">Kredit</option>
                                </select>
                            </div>
                            <div class="input-field col s2" style="float: left;">
                                <label>Tipe Akun</label>
                            </div>
                            <div class="input-field col s10 " style="margin: -5px 0 20px;">
                                <select class="browser-default validate" name="tipe_akun" id="tipe_akun" required>
                                    <option value="1">Induk</option>
                                    <option value="2">Bukan Induk</option>
                                </select>
                            </div>
                            <div class="modal-footer white">
                                <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Simpan</button>
                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="mt" class="modal">
                <div class="modal-content white">
                    <h5>Tambah Data Uraian</h5>
                    <div class="row">
                        <form method="post" action="{{url('')}}/apbdes/mastersub">
                            @csrf
                            <div class="input-field col s12">
                                <i class="material-icons prefix md-prefix">book</i>
                                <input id="uraian_" type="text" name="uraian_" required oninvalid="this.setCustomValidity('data tidak boleh kosong')">
                                <label for="nama_master">Nama Akun / Uraian</label>  
                                <input type="hidden" name="kd_induk_" id="kd_induk_">
                                <input type="hidden" name="jns_akun_" id="jns_akun_">
                            </div> 
                            <div class="input-field col s2" style="float: left;">
                                <label>Tipe Akun</label>
                            </div>
                            <div class="input-field col s10 " style="margin: -5px 0 20px;">
                                <select class="browser-default validate" name="tipe_akun_" id="tipe_akun_" required>
                                    <option value="1">Induk</option>
                                    <option value="2">Bukan Induk</option>
                                </select>
                            </div>
                            <div class="modal-footer white">
                                <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Simpan</button>
                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="m" class="modal">
                <div class="modal-content white">
                    <h5>Edit Data Uraian</h5>
                    <div class="row">
                        <form method="post" action="{{url('')}}/apbdes/editmaster">
                            @csrf
                            <div class="input-field col s12">
                                <i class="material-icons prefix md-prefix">book</i>
                                <input id="uraian_edit" type="text" name="uraian_edit" required oninvalid="this.setCustomValidity('data tidak boleh kosong')">
                                <label for="nama_master">Nama Akun / Uraian</label>                                            
                            </div>                             
                            <input type="hidden" name="kd_rekening_edit" id="kd_rekening_edit">
                            <div class="modal-footer white">
                                <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Ubah</button>
                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
            <div id="m_t" class="modal">
                <div class="modal-content white">
                    <h5>Edit Data Uraian</h5>
                    <div class="row">
                        <form method="post" action="{{url('')}}/apbdes/masteredit">
                            @csrf
                            <div class="input-field col s12">
                                <i class="material-icons prefix md-prefix">book</i>
                                <input id="uraian_editm" type="text" name="uraian_editm" required oninvalid="this.setCustomValidity('data tidak boleh kosong')">
                                <label for="nama_master">Nama Akun / Uraian</label>                                            
                            </div>                             
                            <input type="hidden" name="kd_rekening_editm" id="kd_rekening_editm">
                            <div class="input-field col s2" style="float: left;">
                                <label>Tipe Akun</label>
                            </div>
                            <div class="input-field col s10 " style="margin: -5px 0 20px;">
                                <select class="browser-default validate" name="tipe_akun_editm" id="tipe_akun_editm" required>
                                    <option value="1">Induk</option>
                                    <option value="2">Bukan Induk</option>
                                </select>
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
    function tambah() {
    // body...
        document.getElementById('uraian').value="";
        document.getElementById('jns_akun').value="1";
        document.getElementById('tipe_akun').value="1";
    }
    function tambahm(kd_rekening,jns_akun) {
    // body...
        document.getElementById('uraian_').value="";
        document.getElementById('jns_akun_').value=jns_akun;
        document.getElementById('kd_induk_').value=kd_rekening;
        document.getElementById('tipe_akun_').value="1";
    }
    function editm(kd_rekening,uraian) {
    // body...
        document.getElementById('uraian_edit').value=uraian;
        document.getElementById('kd_rekening_edit').value=kd_rekening;
    }
    function edit(kd_rekening,uraian,tipe_akun) {
    // body...
        document.getElementById('uraian_editm').value=uraian;
        document.getElementById('kd_rekening_editm').value=kd_rekening;
        document.getElementById('tipe_akun_editm').value=tipe_akun;
    }
</script>
@endsection 