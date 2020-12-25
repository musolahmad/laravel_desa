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
                            <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons">work</i> Profil Desa</a></li>
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
        <!-- Row form Start -->
        <div class="row jarak-form">

        <!-- Form START -->
            <form class="col s12" method="post" action="{{url('')}}/profildesa" enctype="multipart/form-data">
                @csrf
                <!-- Row in form START -->
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">work</i>
                        <input id="nama_desa" type="text" name="nama_desa" value="@if(!empty($profildesa)){{$profildesa->nm_desa}}@else{{old('nama_desa')}}@endif">
                        <label for="nm_desa">Nama Desa</label>
                        @error('nama_desa')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>  
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">place</i>
                        <input id="alamat" type="text" name="alamat" value="@if(!empty($profildesa)){{$profildesa->alamat}}@else{{old('alamat')}}@endif" >
                        <label for="alamat">Alamat</label>
                        @error('alamat')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>  
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">assignment</i>
                        <input id="kode_pos" type="text" name="kode_pos" value="@if(!empty($profildesa)){{$profildesa->kd_pos}}@else{{old('kode_pos')}}@endif" >
                        <label for="kode_pos">Kode Pos</label>
                        @error('kode_pos')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div> 
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">language</i>
                        <input id="website" type="text" name="website" value="@if(!empty($profildesa)){{$profildesa->website}}@else{{old('website')}}@endif">
                        <label for="website">Website</label>
                        @error('website')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                        @if(!empty($profildesa))
                        <input type="hidden" name="logo_lama" id="logo_lama" value="{{$profildesa->logo}}">
                        @endif
                    </div>  
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">today</i>
                        <input id="hari_kerja" type="text" name="hari_kerja" value="@if(!empty($profildesa)){{$profildesa->hr_krj}}@else{{old('hari_kerja')}}@endif" >
                        <label for="hari_kerja">Hari Kerja</label>
                        @error('hari_kerja')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>   
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">av_time</i>
                        <input id="jam_kerja" type="text" name="jam_kerja" value="@if(!empty($profildesa)){{$profildesa->jm_krj}}@else{{old('jam_kerja')}}@endif" >
                        <label for="hari_kerja">Jam Kerja</label>
                        @error('jam_kerja')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>                    
                    <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Jika tidak ada logo, biarkan kosong">
                        <div class="file-field input-field">
                            <div class="btn light-green darken-1">
                                <span>File</span>
                                <input type="file" id="logo" name="logo" onchange="previewImage();">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path" type="text" placeholder="Upload Logo Desa">
                            </div>
                            @error('logo')
                             <small class="red-text">*{{ $message }}</small><br>
                            @enderror
                            <small class="red-text">*Format file yang diperbolehkan hanya *.JPG, *.PNG dan ukuran maksimal file 2 MB. Disarankan gambar berbentuk kotak atau lingkaran!</small>
                        </div>
                    </div> 
                    <div class="input-field col s6">
                        <img class="logo" id="image-preview" src="{{url('')}}/storage/@if(!empty($profildesa)){{$profildesa->logo}}@else{{'profil_desa/favicon.png'}}@endif"/>
                    </div>   
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">map</i>
                        <input id="peta" type="text" name="peta" value="@if(!empty($profildesa)){{$profildesa->peta}}@else{{old('peta')}}@endif" >
                        <label for="hari_kerja">Peta</label>
                        @error('peta')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>                   
                </div> 
                <div class="row">
                    <div class="col 6">
                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                    </div>
                    <div class="col 6">
                        <a href="{{url('')}}" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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
</script> 