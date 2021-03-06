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
                            <div class="col m7">
                                <ul class="left">
                                    <li class="waves-effect waves-light hide-on-small-only"><a href="" class="judul"><i class="material-icons">person</i> Pegawai</a></li>
                                    <li class="waves-effect waves-light"><a href="{{url('')}}/pegawai/tambah"><i class="material-icons md-24">add_circle</i> Tambah Data</a></li>
                                </ul>
                            </div>
                            <div class="col m5 hide-on-med-and-down">
                                <form method="post" action="{{url('')}}/pgwcari">
                                    @csrf
                                    <div class="input-field round-in-box">
                                        <input id="search" type="search" name="cari" placeholder="Ketik dan tekan enter mencari data..." required>
                                        <label for="search"><i class="material-icons">search</i></label>
                                    </div>
                                </form>
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
        @if(session('cari'))
        <div class="col m12" style="margin-top: -10px;">
            <div class="card blue lighten-5">
                <div class="card-content">
                    <p class="description">Hasil pencarian untuk kata kunci <strong>{{session('cari')}}</strong><span class="right"><a href="{{url('')}}/pgwcari"><i class="material-icons md-36" style="color: #333;">clear</i></a></span></p>
                </div>
            </div>
        </div>
        @endif
        <div class="col m12" id="colres">
            <table class="bordered" id="tbl">
                <thead class="blue lighten-4" id="head">
                    <tr>
                        <th width="10%">NIP / NIK</th>
                        <th width="20%">Nama Pegawai</th>
                        <th width="10%">Tanggal Lahir</th>
                        <th width="30%">Alamat</th>
                        <th width="10%">Jenis Kelamin</th>
                        <th width="20%">Tindakan <span class="right tooltipped" data-position="left" data-tooltip="Atur jumlah data yang ditampilkan"><a class="modal-trigger" href="#modal"><i class="material-icons" style="color: #333;">settings</i></a></span></th>
                        <div id="modal" class="modal">
                            <div class="modal-content white">
                                <h5>Jumlah data yang ditampilkan per halaman</h5>
                                <div class="row">
                                    <form method="post" action="{{url('')}}/jbt">
                                        <div class="input-field col s12">
                                             @csrf
                                            <div class="input-field col s1" style="float: left;">
                                                <i class="material-icons prefix md-prefix">looks_one</i>
                                            </div>
                                            <div class="input-field col s11 right" style="margin: -5px 0 20px;">
                                                <select class="browser-default validate" name="jml" id="jml" required>
                                                    <option value="5" @if($no==5){{'selected'}}@endif>5</option>
                                                    <option value="10" @if($no==10){{'selected'}}@endif>10</option>
                                                    <option value="20" @if($no==20){{'selected'}}@endif>20</option>
                                                    <option value="50" @if($no==50){{'selected'}}@endif>50</option>
                                                    <option value="100" @if($no==100){{'selected'}}@endif>100</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer white">
                                                <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Simpan</button>
                                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>                    
                </thead>
                <tbody>
                    @foreach($pegawai as $jbt)
                    @if($jbt->kd_pegawai!='ADM001')
                    <tr>
                        <td>{{$jbt->nip_nik}}</td>
                        <td>{{$jbt->nm_pegawai}}</td>
                        <td>{{date('d-m-Y',strtotime($jbt->tgl_lahir))}}</td>
                        <td>{{$jbt->alamat}}</td>
                        <td>@if($jbt->jns_kelamin=='l'){{'Laki-Laki'}}@else{{'Perempuan'}}@endif</td>
                        <form action="{{url('')}}/pegawai/{{$jbt->kd_pegawai}}" method="post">
                            @method('delete')
                            @csrf
                            <td>
                                <a class="btn small green waves-effect waves-light modal-trigger" href="{{url('')}}/pegawai/{{$jbt->kd_pegawai}}"><i class="material-icons">edit</i> Edit</a>
                                <button class="btn small deep-orange waves-effect waves-light" type="submit"><i class="material-icons">delete</i> Hapus</button>
                            </td>
                        </form>
                    </tr>
                    @endif
                    @endforeach
                    @if($pegawai->isEmpty())
                        <tr><td colspan="5"><center><p class="add">Tidak ada data yang ditemukan. <u><a href="#tambah" class="modal-trigger" onclick="tambah();">Tambah data baru</a></u></p></center></td></tr>
                    @endif
                </tbody>
                <!-- Modal Edit Start -->
                <div id="edit" class="modal">
                    <div class="modal-content white">
                        <h5>Edit Data Pegawai</h5>
                        <div class="row">
                            <form method="post" action="{{url('')}}/Pegawai/edit">
                                <div class="input-field col s12">
                                @method('put')
                                @csrf
                                    <i class="material-icons prefix md-prefix">assistant</i>
                                    <input type="hidden" name="kd_Pegawai" id="kd_Pegawai">
                                    <input id="nm_Pegawai_edit" type="text" name="nm_Pegawai_edit" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                    <label for="nm_Pegawai">Nama Pegawai</label>                                
                                    <div class="modal-footer white">
                                        <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Simpan</button>
                                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit END -->
            </table>        
        </div>
        <!-- Row form END -->   
        <!-- Pagination START -->        
        @if ($pegawai->hasPages())
        <ul class="pagination" role="navigation">
            <li class="{{ ($pegawai->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $pegawai->url(1) }}"><i class="material-icons md-48">first_page</i></a>
            </li>
            <li class="{{ ($pegawai->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $pegawai->url($Pegawai->currentPage()-1) }}"><i class="material-icons md-48">chevron_left</i></a>
            </li>

            <?php
                $start = $pegawai->currentPage() - 1; // show 3 pagination links before current
                $end = $pegawai->currentPage() + 1; // show 3 pagination links after current
                if($start < 1) {
                    $start = 1; // reset start to 1
                    $end += 1;
                } 
                if($end >= $pegawai->lastPage() ) $end = $pegawai->lastPage(); // reset end to last page
            ?>

            @if($start > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $pegawai->url(1) }}">{{1}}</a>
                </li>
                @if($pegawai->currentPage() != 4)
                    {{-- "Three Dots" Separator --}}
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
            @endif
                @for ($i = $start; $i <= $end; $i++)
                    <li class="page-item {{ ($Pegawai->currentPage() == $i) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $Pegawai->url($i) }}">{{$i}}</a>
                    </li>
                @endfor
            @if($end < $pegawai->lastPage())
                @if($pegawai->currentPage() + 3 != $pegawai->lastPage())
                    {{-- "Three Dots" Separator --}}
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $Pegawai->url($pegawai->lastPage()) }}">{{$pegawai->lastPage()}}</a>
                </li>
            @endif

            <li class="{{ ($pegawai->currentPage() == $pegawai->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $pegawai->url($pegawai->currentPage()+1) }}" ><i class="material-icons md-48">chevron_right</i></a>
            </li>
            <li class="{{ ($pegawai->currentPage() == $pegawai->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $pegawai->url($pegawai->lastPage()) }}" ><i class="material-icons md-48">last_page</i></a>
            </li>
        </ul>
        @endif
    </div>
    <!-- container END -->  

</main>
<!-- Main END -->

@endsection 
<script>
  function previewImage() {
    document.getElementById("image-preview").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("logo").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    };
  };
  function tambah() {
    // body...
    document.getElementById('nm_Pegawai').value="";
  }
  function edit(kd_Pegawai,nm_Pegawai) {
    // body...
    document.getElementById('kd_Pegawai').value=kd_Pegawai;
     document.getElementById('nm_Pegawai_edit').value=nm_Pegawai;
  }
</script> 