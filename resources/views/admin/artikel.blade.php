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
                                    <li class="waves-effect waves-light hide-on-small-only"><a href="" class="judul"><i class="material-icons">subtitles</i> Berita dan Artikel</a></li>
                                    <li class="waves-effect waves-light"><a href="{{url('')}}/berita/tambah"><i class="material-icons md-24">add_circle</i> Tambah Data</a></li>
                                </ul>
                            </div>
                            <div class="col m5 hide-on-med-and-down">
                                <form method="post" action="{{url('')}}/caribrt">
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
                    <p class="description">Hasil pencarian untuk kata kunci <strong>{{session('cari')}}</strong><span class="right"><a href="{{url('')}}/caribrt"><i class="material-icons md-36" style="color: #333;">clear</i></a></span></p>
                </div>
            </div>
        </div>
        @endif
        <div class="col m12" id="colres">
            <table class="bordered" id="tbl">
                <thead class="blue lighten-4" id="head">
                    <tr>
                        <th width="20%">Tanggal</th>
                        <th width="20%">Judul</th>
                        <th width="40%">Artikel</th>
                        <th width="20%">Tindakan <span class="right tooltipped" data-position="left" data-tooltip="Atur jumlah data yang ditampilkan"><a class="modal-trigger" href="#modal"><i class="material-icons" style="color: #333;">settings</i></a></span></th>
                        <div id="modal" class="modal">
                            <div class="modal-content white">
                                <h5>Jumlah data yang ditampilkan per halaman</h5>
                                <div class="row">
                                    <form method="post" action="{{url('')}}/brt">
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
                    @foreach($berita as $brt)
                    @if($brt->id>=6)
                    <tr>
                        <td>{{date('d-m-Y (H:i:s)',strtotime($brt->created_at))}}</td>
                        <td>{{$brt->judul}}</td>
                        <td>{!!$brt->isi!!}</td>
                        @if($brt->kd_admin == session('kode_admin'))
                        <form action="{{url('')}}/berita/{{$brt->id}}" method="post">
                            @method('delete')
                            @csrf
                            <td>
                                <a class="btn small green waves-effect waves-light " href="{{url('')}}/berita/{{$brt->id}}"><i class="material-icons">edit</i> Edit</a>
                                <button class="btn small deep-orange waves-effect waves-light" type="submit"><i class="material-icons">delete</i> Hapus</button>
                            </td>
                        </form>
                        @else
                        <td></td>
                        @endif
                    </tr>
                    @endif
                    @endforeach
                    @if($id->id<6)
                        <tr><td colspan="5"><center><p class="add">Tidak ada data yang ditemukan. <u><a href="{{url('')}}/berita/tambah">Tambah data baru</a></u></p></center></td></tr>
                    @endif
                </tbody>
            </table>        
        </div>
        <!-- Row form END -->   
        <!-- Pagination START -->        
        @if ($berita->hasPages())
        <ul class="pagination" role="navigation">
            <li class="{{ ($berita->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $berita->url(1) }}"><i class="material-icons md-48">first_page</i></a>
            </li>
            <li class="{{ ($berita->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $berita->url($berita->currentPage()-1) }}"><i class="material-icons md-48">chevron_left</i></a>
            </li>

            <?php
                $start = $berita->currentPage() - 1; // show 3 pagination links before current
                $end = $berita->currentPage() + 1; // show 3 pagination links after current
                if($start < 1) {
                    $start = 1; // reset start to 1
                    $end += 1;
                } 
                if($end >= $berita->lastPage() ) $end = $berita->lastPage(); // reset end to last page
            ?>

            @if($start > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $berita->url(1) }}">{{1}}</a>
                </li>
                @if($berita->currentPage() != 4)
                    {{-- "Three Dots" Separator --}}
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
            @endif
                @for ($i = $start; $i <= $end; $i++)
                    <li class="page-item {{ ($berita->currentPage() == $i) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $berita->url($i) }}">{{$i}}</a>
                    </li>
                @endfor
            @if($end < $berita->lastPage())
                @if($berita->currentPage() + 3 != $berita->lastPage())
                    {{-- "Three Dots" Separator --}}
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $berita->url($berita->lastPage()) }}">{{$berita->lastPage()}}</a>
                </li>
            @endif

            <li class="{{ ($berita->currentPage() == $berita->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $berita->url($berita->currentPage()+1) }}" ><i class="material-icons md-48">chevron_right</i></a>
            </li>
            <li class="{{ ($berita->currentPage() == $berita->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $berita->url($berita->lastPage()) }}" ><i class="material-icons md-48">last_page</i></a>
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
    document.getElementById('judul').value="";
  }
  function edit(id,judul) {
    // body...
    document.getElementById('id').value=id;
     document.getElementById('judul_edit').value=judul;
  }
</script> 