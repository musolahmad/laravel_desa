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
                            <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons">person</i> @if(!empty($pegawai)){{'Edit'}}@else{{'Tambah'}}@endif Data Pegawai</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        <!-- Secondary Nav END -->
        </div>
        <div class="row jarak-form">

        <!-- Form START -->
            <form class="col s12" method="post" action="@if(!empty($pegawai)){{url('/pegawai/edit')}}@else{{url('/pegawai')}}@endif" enctype="multipart/form-data">
                @csrf
                @if(!empty($pegawai))@method('put')@endif
                <!-- Row in form START -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">filter_1</i>
                        <input id="nip_atau_nik" type="text" name="nip_atau_nik" value="@if(!empty($pegawai)){{$pegawai->nip_nik}}@else{{old('nip_atau_nik')}}@endif">
                        @if(!empty($pegawai))
                        <input id="nip_atau_nik_" type="hidden" name="nip_atau_nik_" value="{{$pegawai->nip_nik}}">
                        <input id="kd_pegawai" type="hidden" name="kd_pegawai" value="{{$pegawai->kd_pegawai}}">
                        <input id="foto_lama" type="hidden" name="foto_lama" value="{{$pegawai->foto_profil}}">
                        @endif
                        <label for="nip_atau_nik">NIP / NIK</label>
                        @error('nip_atau_nik')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror 
                        @if(session('nip'))
                        <small class="red-text">*{{ session('nip') }}</small>
                        @endif                       
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">person</i>
                        <input id="nama_pegawai" type="text" name="nama_pegawai" value="@if(!empty($pegawai)){{$pegawai->nm_pegawai}}@else{{old('nama_pegawai')}}@endif">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        @error('nama_pegawai')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div> 
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">date_range</i>
                        <input id="tgl_lahir" type="text" name="tgl_lahir" value="@if(!empty($pegawai)){{$pegawai->tgl_lahir}}@else{{old('tgl_lahir')}}@endif">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                         @error('tgl_lahir')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">place</i>
                        <input id="alamat" type="text" name="alamat" value="@if(!empty($pegawai)){{$pegawai->alamat}}@else{{old('alamat')}}@endif" >
                        <label for="alamat">Alamat</label>
                        @error('alamat')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>  
                                  
                    <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Jika tidak ada logo, biarkan kosong">
                        <div class="file-field input-field">
                            <div class="btn light-green darken-1">
                                <span>File</span>
                                <input type="file" id="foto_admin" name="foto_admin" onchange="previewImage();">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path" type="text" placeholder="Upload Logo Desa">
                            </div>
                            @error('foto_admin')
                             <small class="red-text">*{{ $message }}</small><br>
                            @enderror
                            <small class="red-text">*Format file yang diperbolehkan hanya *.JPG, *.PNG dan ukuran maksimal file 2 MB. Disarankan gambar berbentuk kotak atau lingkaran!</small>
                        </div>
                    </div> 
                    <div class="input-field col s6">
                        <img class="logo" id="image-preview" src="{{url('')}}/storage/@if(!empty($pegawai)){{$pegawai->foto_profil}}@else{{'foto_admin/1.jpg'}}@endif"/>
                    </div>  
                    <div class="input-field col s12">
                        <div class="input-field col s4">
                            <i class="material-icons prefix md-prefix">wc</i> <label for="jenis_kelamin">Jenis Kelamin</label> 
                        </div>
                        <div class="input-field col s4">
                            <input type="radio" id="l" name="jenis_kelamin" value="l" @if(!empty($pegawai)&&$pegawai->jns_kelamin == "l") checked @endif>
                            <label for="l">Laki - Laki</label>
                        </div>
                        <div class="input-field col s4">
                            <input type="radio" id="p" name="jenis_kelamin" value="p" @if(!empty($pegawai)&&$pegawai->jns_kelamin == "p") checked @endif>
                            <label for="p">Perempuan</label>
                        </div>   
                        @error('jenis_kelamin')
                          <small class="red-text">*{{ $message }}</small>
                        @enderror       
                    </div>                
                </div> 
                <div class="row">
                    <div class="col 6">
                         @if(!empty($pegawai))
                        <button type="submit" name="submit" class="btn-large green waves-effect waves-light">UBAH <i class="material-icons">edit</i></button>
                        @else
                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        @endif
                    </div>
                    <div class="col 6">
                        <a href="{{url('')}}/pegawai" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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
     oFReader.readAsDataURL(document.getElementById("foto_admin").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    };
  };
</script> 