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
                                    <li class="waves-effect waves-light hide-on-small-only"><a href="{{url('')}}/admin_profil/profil" class="judul"><i class="material-icons">person</i> Profil Admin</a></li>
                                    <li class="waves-effect waves-light"><a href="{{url('')}}/admin_profil/password">Ubah Password</a></li>
                                    <li class="waves-effect waves-light"><a href="{{url('')}}/admin_profil/foto">Ubah Foto</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Secondary Nav END -->
        </div>
        <!-- Row form END -->  
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
            <div class="col m3">
                <div class="card white lighten-5">
                   <br>
                   <center>
                        <img class="logo" id="image-preview" src="{{url('')}}/storage/{{$admin->foto_profil}}"/>
                   </center>
                   <p>
                   <label>
                        <div class="col s4">NIP / NIK</div><div class="col s1">:</div><div class="col s7">{{$admin->nip_nik}}</div>
                        <div class="col s4">Nama</div><div class="col s1">:</div><div class="col s7">{{$admin->nm_pegawai}}</div>
                        <div class="col s4">Tgl Lahir</div><div class="col s1">:</div><div class="col s7">{{date('d-m-Y',strtotime($admin->tgl_lahir))}}</div>
                        <div class="col s4">Alamat</div><div class="col s1">:</div><div class="col s7">{{$admin->alamat}}</div>
                        <div class="col s4">Gender</div><div class="col s1">:</div><div class="col s7">@if($admin->jns_kelamin=='l'){{'Laki-Laki'}}@else{{'Perempuan'}}@endif</div>
                        <div class="col s4">Email</div><div class="col s1">:</div><div class="col s12">{{$admin->email}}</div>                    
                    </label>
                    <a type="button" href="{{url('')}}/admin_profil/profil" class="btn-large green waves-effect waves-light right white-text"> Edit</a>
                    </p>
                </div>                
            </div>
            <form class="col m9" method="post" action="{{url('')}}/admin_profil" enctype="multipart/form-data">
                @csrf
                <!-- Row in form START -->
                @if(session('ubah')=='password')
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">lock_outline</i>
                        <input id="password" type="password" name="password" value="">
                        <input id="password_lama" type="hidden" name="password_lama" value="{{Crypt::decryptString($admin->password)}}">
                        <label for="password">Password</label>
                        @error('password')
                         <small class="red-text">* {{ $message }}</small>
                        @enderror
                    </div>  
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">lock_one</i>
                        <input id="password_baru" type="password" name="password_baru" value="">
                        <label for="password_baru">Password Baru</label>
                        @error('password_baru')
                         <small class="red-text">* {{ $message }}</small>
                        @enderror
                    </div>  
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">lock_alt</i>
                        <input id="konfirmasi_password_baru" type="password" name="konfirmasi_password_baru" value="">
                        <label for="konfirmasi_password_baru">Konfirmasi Password Baru</label>
                        @error('konfirmasi_password_baru')
                         <small class="red-text">* {{ $message }}</small>
                        @enderror
                    </div>  
                </div>
                @endif
                @if(session('ubah')=='profil')
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">person</i>
                        <input id="nama" type="text" name="nama" value="{{$admin->nm_pegawai}}">
                        <input type="hidden" id="kd_pegawai_" name="kd_pegawai_" value="{{$admin->kd_pegawai}}">
                        <label for="nama">Nama</label>
                        @error('nama')
                         <small class="red-text">* {{ $message }}</small>
                        @enderror
                    </div> 
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">date_range</i>
                        <input id="tgl_lahir" type="text" name="tgl_lahir" value="{{$admin->tgl_lahir}}">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                    </div>   
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">place</i>
                        <input id="alamat" type="text" name="alamat" value="{{$admin->alamat}}" >
                        <label for="alamat">Alamat</label>
                        @error('alamat')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div> 
                    <div class="input-field col s3">
                        <i class="material-icons prefix md-prefix">wc</i> <label for="jenis_kelamin">Jenis Kelamin</label>                       
                    </div>
                    <div class="input-field col s9">
                        <input type="radio" id="l" name="jenis_kelamin" value="l" @if($admin->jns_kelamin == "l") checked @endif>
                        <label for="l">Laki - Laki</label><br>
                        <input type="radio" id="p" name="jenis_kelamin" value="p" @if($admin->jns_kelamin == "p") checked @endif>
                        <label for="p">Perempuan</label>
                    </div>
                     <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">mail</i>
                        <input id="email" type="text" name="email" value="{{$admin->email}}" >
                        <input id="email_" type="hidden" name="email_" value="{{$admin->email}}" >
                        <label for="email">Email</label>
                        @error('email')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                        @if(session('email'))
                        <small class="red-text">*{{ session('email') }}</small>
                        @endif
                    </div>                                     
                </div>
                @endif
                @if(session('ubah')=='foto')
                <div class="row">
                    <div class="input-field col s6 tooltipped" data-position="top" data-tooltip="Jika tidak ada logo, biarkan kosong">
                        <div class="file-field input-field">
                            <div class="btn light-green darken-1">
                                <span>File</span>
                                <input type="file" id="logo" name="logo" onchange="previewImage();">
                                <input type="hidden" id="foto_profil" name="foto_profil" value="{{$admin->foto_profil}}">
                                <input type="hidden" id="kd_pegawai" name="kd_pegawai" value="{{$admin->kd_pegawai}}">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path" type="text" placeholder="Upload Logo Desa">
                            </div>
                            @error('logo')
                             <small class="red-text">* {{ $message }}</small><br>
                            @enderror
                            <small class="red-text">* Format file yang diperbolehkan hanya *.JPG, *.PNG dan ukuran maksimal file 2 MB. Disarankan gambar berbentuk kotak atau lingkaran!</small>
                        </div>
                    </div> 
                    <div class="input-field col s6">
                        <img class="logo" id="image-preview" src="{{url('')}}/storage/{{$admin->foto_profil}}"/>
                    </div>   
                </div>
                @endif
                <div class="row">
                    <div class="col 12">
                        <button type="submit" name="submit" class="btn-large green waves-effect waves-light"><i class="material-icons">mode_edit</i> Ubah</button>
                    </div>
                </div>     
            </form>
        </div>    
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