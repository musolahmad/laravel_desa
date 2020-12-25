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
                            <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons">av_timer</i> Periode Jabatan {{date('d-m-Y',strtotime($periode->awal))}} sampai {{date('d-m-Y',strtotime($periode->akhir))}}</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        <!-- Secondary Nav END -->
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
        <div class="row jarak-form">

        <!-- Form START -->
            <form class="col s12" method="post" action="@if(!empty($pegawaiperiode)){{url('/pegawai_periode/edit')}}@else{{url('/pegawai_periode')}}@endif" enctype="multipart/form-data">
                @csrf
                @if(!empty($pegawaiperiode))@method('put')@endif
                <!-- Row in form START -->
                <div class="row">  
                <input type="hidden" name="kd_periode" value="{{$periode->kd_periode}}">    
                @foreach($jabatan as $jbt)              
                    <div class="input-field col s12">
                        <label>{{$jbt->nm_jabatan}}</label><br>
                        <?php 
                        if(!empty($pegawaiperiode)){
                            $pegawai_periode= App\Tb_pegawaiperiode::where(['kd_periode'=>$periode->kd_periode,'kd_jabatan'=>$jbt->kd_jabatan])->first();
                        }
                        ?>
                        <input type="hidden" name="id[]" value="{{$pegawai_periode->id}}">
                        <input type="hidden" name="kd_jabatan[]" value="{{$jbt->kd_jabatan}}">
                        <select class="input-field" name="kd_pegawai[]" id="kd_pegawai[]" required>                            
                            @foreach($pegawai as $pgw)  
                                <option value="{{$pgw->kd_pegawai}}" @if(!empty($pegawaiperiode))@if($pgw->kd_pegawai==$pegawai_periode->kd_pegawai){{'selected'}}@endif @endif>{{$pgw->nm_pegawai}} [{{$pgw->nip_nik}}]</option>
                            @endforeach
                        </select>
                        @error('kd_pegawai')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>
                @endforeach
                </div>    
                <div class="row">
                    <div class="col 6">
                        @if(!empty($pegawaiperiode))
                        <button type="submit" name="submit" class="btn-large green waves-effect waves-light">UBAH <i class="material-icons">edit</i></button>
                        @else
                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        @endif
                    </div>
                    <div class="col 6">
                        <a href="{{url('')}}/periode" class="btn-large brown waves-effect waves-light">Kembali <i class="material-icons">arrow_back</i></a>
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