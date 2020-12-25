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
                                    <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons">add_a_photo</i> Galeri Foto</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
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
                    <p class="description">Hasil pencarian untuk kata kunci <strong>{{session('cari')}}</strong><span class="right"><a href="{{url('')}}/cari"><i class="material-icons md-36" style="color: #333;">clear</i></a></span></p>
                </div>
            </div>
        </div>
        @endif
        <form method="post" action="{{url('')}}/galeri" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="input-field col s6 m10">
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
                    <div class="input-field col s6 m2" style="text-align: right;">
                        <button type="submit" name="submit" class="btn-large blue-grey waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                    </div>
                    <div class="input-field col s12 m12">
                     <small class="red-text">*Format file yang diperbolehkan hanya *.JPG, *.PNG dan ukuran maksimal file 2 MB. Disarankan gambar berbentuk kotak atau lingkaran!</small>
                    </div> 
                </div>
            </form>
        <!-- Row form END -->   
        <div class="row">
            @foreach($galeri as $glr)
            <div class="col s12 m4">
                <img src="{{url('')}}/storage/{{$glr->gambar}}" width="100%"/>
                <div class="col s12">
                    <input type="text" value="{{url('')}}/storage/{{$glr->gambar}}" id="myInput{{$glr->id}}">
                    <button onclick="myFunction('{{$glr->id}}');" name="submit" class="btn small orange col s12">Copy Link<i class="material-icons">content_copy</i></button>
                </div>
                <form method="post" action="{{url('')}}/galeri/{{$glr->kode}}">
                @method('delete')
                @csrf
                <input type="hidden" name="file" value="{{$glr->gambar}}">
                <div class="col s12">
                    <button type="submit" name="submit" class="btn small red col s12">Hapus <i class="material-icons">delete</i></button>
                </div>
                </form>
            </div>
            @endforeach
        </div>
        <!-- Pagination START -->        
        @if ($galeri->hasPages())
        <ul class="pagination" role="navigation">
            <li class="{{ ($galeri->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $galeri->url(1) }}"><i class="material-icons md-48">first_page</i></a>
            </li>
            <li class="{{ ($galeri->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $galeri->url($galeri->currentPage()-1) }}"><i class="material-icons md-48">chevron_left</i></a>
            </li>

            <?php
                $start = $galeri->currentPage() - 1; // show 3 pagination links before current
                $end = $galeri->currentPage() + 1; // show 3 pagination links after current
                if($start < 1) {
                    $start = 1; // reset start to 1
                    $end += 1;
                } 
                if($end >= $galeri->lastPage() ) $end = $galeri->lastPage(); // reset end to last page
            ?>

            @if($start > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $galeri->url(1) }}">{{1}}</a>
                </li>
                @if($galeri->currentPage() != 4)
                    {{-- "Three Dots" Separator --}}
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
            @endif
                @for ($i = $start; $i <= $end; $i++)
                    <li class="page-item {{ ($galeri->currentPage() == $i) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $galeri->url($i) }}">{{$i}}</a>
                    </li>
                @endfor
            @if($end < $galeri->lastPage())
                @if($galeri->currentPage() + 3 != $galeri->lastPage())
                    {{-- "Three Dots" Separator --}}
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $galeri->url($galeri->lastPage()) }}">{{$galeri->lastPage()}}</a>
                </li>
            @endif

            <li class="{{ ($galeri->currentPage() == $galeri->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $galeri->url($galeri->currentPage()+1) }}" ><i class="material-icons md-48">chevron_right</i></a>
            </li>
            <li class="{{ ($galeri->currentPage() == $galeri->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $galeri->url($galeri->lastPage()) }}" ><i class="material-icons md-48">last_page</i></a>
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
     oFReader.readAsDataURL(document.getElementById("gambar").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    };
  };
  function tambah() {
    // body...
    document.getElementById('nm_jabatan').value="";
  }
  function edit(kd_jabatan,nm_jabatan) {
    // body...
    document.getElementById('kd_jabatan').value=kd_jabatan;
     document.getElementById('nm_jabatan_edit').value=nm_jabatan;
  }
  function myFunction(id) {
  var copyText = document.getElementById("myInput"+id+"");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Link Gambar berhasil dicopy: " + copyText.value);
}
</script> 