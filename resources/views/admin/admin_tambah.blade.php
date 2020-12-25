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
                            <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons">person</i> @if(!empty($admin)){{'Edit'}}@else{{'Tambah'}}@endif Data admin</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        <!-- Secondary Nav END -->
        </div>
        <div class="row jarak-form">

        <!-- Form START -->
            <form class="col s12" method="post" action="@if(!empty($admin)){{url('/admin_data/edit')}}@else{{url('/admin_data')}}@endif" enctype="multipart/form-data">
                @csrf
                @if(!empty($admin))@method('put')@endif
                <!-- Row in form START -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">person</i><label>Nama Admin</label>                 
                        @if(!empty($admin))
                        <input id="nm_pegawai" type="text" name="nm_pegawai" value="{{$admin->nm_pegawai}}" disabled>
                        <input id="kd_admin" type="hidden" name="kd_admin" value="{{$admin->kd_admin}}">
                        <input id="email_lama" type="hidden" name="email_lama" value="{{$admin->email}}">
                        @else
                        <br>
                        <select class="input-field" name="kd_pegawai" id="kd_pegawai" required>                            
                            @foreach($pegawai as $pgw)
                                @if($pgw->kd_pegawai!='ADM001')  
                                <option value="{{$pgw->kd_pegawai}}" @if(!empty($pegawaiperiode))@if($pgw->kd_pegawai==$pegawai_periode->kd_pegawai){{'selected'}}@endif @endif>{{$pgw->nm_pegawai}} [{{$pgw->nip_nik}}]</option>
                                @endif
                            @endforeach
                        </select>
                        @endif                  
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">mail</i>
                        <input id="email" type="text" name="email" value="@if(!empty($admin)){{$admin->email}}@else{{old('email')}}@endif">
                        <label for="email">Email</label>
                        @error('email')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div> 
                   <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">lock</i>
                        <input id="password" type="password" name="password" value="@if(!empty($admin)){{Crypt::decryptString($admin->password)}}@else{{old('password')}}@endif">
                        <label for="password">Password</label>
                        @error('password')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div> 
                </div>    
                <div class="row">
                    <div class="col 6">
                         @if(!empty($admin))
                        <button type="submit" name="submit" class="btn-large green waves-effect waves-light">UBAH <i class="material-icons">edit</i></button>
                        @else
                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        @endif
                    </div>
                    <div class="col 6">
                        <a href="{{url('')}}/admin_data" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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