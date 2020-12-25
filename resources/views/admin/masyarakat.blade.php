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
                                    <li class="waves-effect waves-light hide-on-small-only"><a href="" class="judul"><i class="material-icons">accessibility</i> Kelola Masyarakat</a></li>
                                </ul>
                            </div>
                            <div class="col m5 hide-on-med-and-down">
                                <form method="post" action="{{url('')}}/masyarakat">
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

        <div class="row">
            <div class="col s12">
            <span class="right tooltipped" data-position="left" data-tooltip="Atur jumlah data yang ditampilkan">Atur jumlah data yang ditampilkan <a class="modal-trigger" href="#modal"><i class="material-icons" style="color: #333;">settings</i></a></span></th>
                        <div id="modal" class="modal">
                            <div class="modal-content white">
                                <h5>Jumlah data yang ditampilkan per halaman</h5>
                                <div class="row">
                                    <form method="post" action="{{url('')}}/masyarakat/page">
                                        <div class="input-field col s12">
                                             @method('put')
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
                    </div>
        </div>
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
                    <p class="description">Hasil pencarian untuk kata kunci <strong>{{session('cari')}}</strong><span class="right"><a href="{{url('')}}/masyarakat/cari"><i class="material-icons md-36" style="color: #333;">clear</i></a></span></p>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            @foreach($user as $usr)
            <div class="col s12 m4">
                <div class="card white lighten-5">
                   <br>
                   <center>
                        <img class="logo" id="image-preview" src="{{url('')}}/storage/{{$usr->foto_profil}}"/>
                   </center>
                   <label>
                        <div class="col s4">Nama</div><div class="col s1">:</div><div class="col s7">{{$usr->nama_depan}} {{$usr->nama_belakang}}</div> 
                        <div class="col s4">Tgl Lahir</div><div class="col s1">:</div><div class="col s7">{{date('d-m-Y',strtotime($usr->tgl_lahir))}}</div>
                        <div class="col s4">Alamat</div><div class="col s1">:</div><div class="col s7">{{$usr->alamat}}</div>
                        <div class="col s4">Gender</div><div class="col s1">:</div><div class="col s7">@if($usr->jns_kelamin=='l'){{'Laki-Laki'}}@else{{'usr'}}@endif</div>
                        <div class="col s4">Email</div><div class="col s1">:</div><div class="col s7">{{$usr->email}}</div>                   
                    </label>
                </div>
                <div class="card white lighten-5">
                    <br>
                    @if($usr->status_user=='3')
                    <div class="col s6">
                       <form action="{{url('')}}/masyarakat/{{$usr->kd_user}}" method="post">
                                @method('put')
                                @csrf
                        <input type="hidden" name="status" value="2">
                        <button class="btn small green waves-effect waves-light" type="submit" title="Aktifkan"><i class="material-icons">check</i> Aktifkan</button>
                        </form>
                    </div>
                    @elseif($usr->status_user=='2')
                    <div class="col s6">
                       <form action="{{url('')}}/masyarakat/{{$usr->kd_user}}" method="post">
                                @method('put')
                                @csrf
                        <input type="hidden" name="status" value="3">
                        <button class="btn small orange waves-effect waves-light" type="submit" title="Non-Aktifkan"><i class="material-icons">close</i> Non-Aktifkan</button>
                        </form>
                    </div>
                    @endif
                    <div  @if($usr->status_user=='1'){{'class="col s12"'}}else{{'class="col s6"'}}@endif style="text-align: center;">
                       <form action="{{url('')}}/masyarakat/{{$usr->kd_user}}" method="post">
                                @method('delete')
                                @csrf
                        <button class="btn small red waves-effect waves-light" type="submit" title="Hapus"><i class="material-icons">delete</i> Hapus</button>
                        </form>
                    </div>
                </div>
                <div class="card white lighten-5">
                    <?php 
                    $jumlah = App\Tb_aduan::where('kd_user',$usr->kd_user)->count();
                    $diterima = App\Tb_aduan::where('kd_user',$usr->kd_user)->where('status','Diterima')->count();
                    $ditolak = App\Tb_aduan::where('kd_user',$usr->kd_user)->where('status','Ditolak')->count();
                    $diajukan = App\Tb_aduan::where('kd_user',$usr->kd_user)->where('status','Diajukan')->count();
                    $baca = App\Tb_aduan::where('kd_user',$usr->kd_user)->where('baca','1')->count();
                    ?>
                    <label>
                        <div class="col s5">Total Aduan</div><div class="col s1">:</div><div class="col s6">{{$jumlah}}</div> 
                        <div class="col s5">Aduan Diterima</div><div class="col s1">:</div><div class="col s6">{{$diterima}}</div>
                        <div class="col s5">Aduan Ditolak</div><div class="col s1">:</div><div class="col s6">{{$ditolak}}</div>
                        <div class="col s5">Aduan Diajukan</div><div class="col s1">:</div><div class="col s6">{{$diajukan}}</div>
                        <div class="col s5">Belum Dibaca</div><div class="col s1">:</div><div class="col s6">{{$baca}}</div>                   
                    </label>
                </div>
                <div class="card white lighten-5">
                    <br>
                    <div class="col s12" style="text-align: center;">
                       <a href="{{url('')}}/masyarakat/{{$usr->kd_user}}" class="btn small blue-grey waves-effect waves-light white-text" type="submit" title="Cek Aduan"><i class="material-icons">check</i> Cek Aduan</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Row form END -->   
        <!-- Pagination START -->        
        @if ($user->hasPages())
        <ul class="pagination" role="navigation">
            <li class="{{ ($user->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $user->url(1) }}"><i class="material-icons md-48">first_page</i></a>
            </li>
            <li class="{{ ($user->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $user->url($user->currentPage()-1) }}"><i class="material-icons md-48">chevron_left</i></a>
            </li>

            <?php
                $start = $user->currentPage() - 1; // show 3 pagination links before current
                $end = $user->currentPage() + 1; // show 3 pagination links after current
                if($start < 1) {
                    $start = 1; // reset start to 1
                    $end += 1;
                } 
                if($end >= $user->lastPage() ) $end = $user->lastPage(); // reset end to last page
            ?>

            @if($start > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $user->url(1) }}">{{1}}</a>
                </li>
                @if($user->currentPage() != 4)
                    {{-- "Three Dots" Separator --}}
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
            @endif
                @for ($i = $start; $i <= $end; $i++)
                    <li class="page-item {{ ($user->currentPage() == $i) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $user->url($i) }}">{{$i}}</a>
                    </li>
                @endfor
            @if($end < $user->lastPage())
                @if($user->currentPage() + 3 != $user->lastPage())
                    {{-- "Three Dots" Separator --}}
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $user->url($user->lastPage()) }}">{{$user->lastPage()}}</a>
                </li>
            @endif

            <li class="{{ ($user->currentPage() == $user->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $user->url($user->currentPage()+1) }}" ><i class="material-icons md-48">chevron_right</i></a>
            </li>
            <li class="{{ ($user->currentPage() == $user->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $user->url($user->lastPage()) }}" ><i class="material-icons md-48">last_page</i></a>
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
    document.getElementById('nm_user').value="";
  }
  function edit(kd_user,nm_user) {
    // body...
    document.getElementById('kd_user').value=kd_user;
     document.getElementById('nm_user_edit').value=nm_user;
  }
</script> 