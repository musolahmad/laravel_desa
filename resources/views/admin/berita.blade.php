@extends('layouts.admin')

@section('content')
<main>

    <!-- container START -->
    <div class="container"> 
        <!-- Row Start -->
        <div class="row">
        <!-- Secondary Nav START -->
            <div class="col s12">
                <nav class="secondary-nav">
                    <div class="nav-wrapper blue-grey darken-1">
                        <ul class="left">
                            <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons">book</i> {{$judul}}</a></li>
                        </ul>
                    </div>
                </nav>
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
        <div class="row jarak-form">
        <!-- Form START -->
        @if($id=='tambah' || $id=='edit'){{''}}
            <form class="col s12" method="post" action="@if(!empty($data)){{url('/berita/edit')}}@else{{url('/berita')}}@endif" enctype="multipart/form-data">
        @else
            <form class="col s12" method="post" action="@if(!empty($data)){{url('/pengaturan/edit')}}@else{{url('/pengaturan')}}@endif" enctype="multipart/form-data">
        @endif        
                @csrf
                @if(!empty($data))@method('put')@endif
               <!-- Row in form START -->
                <div class="row">
                    @if($id=='tambah' || $id=='edit'){{''}}
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">subtitles</i>
                        <input id="judul" type="text" name="judul" value="@if(!empty($data)){{$data->judul}}@else{{old('judul')}}@endif">
                        <label for="judul">Judul Artikel</label>
                        @error('judul')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror                  
                    </div>
                    @else
                        <input type="hidden" id="judul" name="judul" value="{{$judul}}">
                    @endif
                    <div class="input-field col s12">
                        <textarea id="isi_berita" name="isi_berita" placeholder="Silahkan Tulis {{$judul}}">@if(!empty($data)){{$data->isi}}@else{{''}}@endif</textarea>          
                        <input type="hidden" id="menu" name="menu" value="{{$id}}">      
                        <input type="hidden" id="no" name="no" value="{{$no}}"> 
                        @if(!empty($data))<input type="hidden" id="foto_lama" name="foto_lama" value="{{$data->foto_berita}}">@endif 
                        @error('isi_berita')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror                  
                    </div>
                    <div class="col m4">
                        <img class="galeri materialboxed" id="image-preview"  src="{{url('')}}/storage/@if(!empty($data)){{$data->foto_berita}}@else{{'foto_berita/no_image_news.jpg'}}@endif" width="100%" />
                    </div>
                    <div class="input-field col m8 tooltipped" data-position="top" data-tooltip="Jika tidak ada gambar, biarkan kosong">
                        <div class="file-field input-field">
                            <div class="btn light-green darken-1">
                                <span>File</span>
                                <input type="file" id="foto_berita" name="foto_berita" onchange="previewImage();">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path" type="text" placeholder="Upload Foto {{$judul}}">
                            </div>
                            @error('foto_berita')
                             <small class="red-text">*{{ $message }}</small><br>
                            @enderror
                            <small class="red-text">*Format file yang diperbolehkan hanya *.JPG, *.PNG dan ukuran maksimal file 2 MB. Disarankan gambar berbentuk kotak atau lingkaran!</small>
                        </div>
                    </div>                     
                </div>    
                <div class="row">
                    <div class="col s12">
                        @if(!empty($data))
                        <button type="submit" name="submit" class="btn-large green waves-effect waves-light right">UBAH <i class="material-icons">edit</i></button>
                        @else
                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light right">SIMPAN <i class="material-icons">done</i></button>
                        @endif
                    </div>
                </div>               
            </form>
            <!-- Form END -->

        </div>
        <!-- Row form END -->   
    </div>
    <!-- container END -->  

</main>
<!-- Main END -->
<script>
    CKEDITOR.replace('isi_berita');
</script>
@endsection 
<script>
  function previewImage() {
    document.getElementById("image-preview").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("foto_berita").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    };
  };
</script> 