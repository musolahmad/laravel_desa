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
                            <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons">av_timer</i> @if(!empty($periode)){{'Edit'}}@else{{'Tambah'}}@endif Data Periode</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        <!-- Secondary Nav END -->
        </div>
        <div class="row jarak-form">

        <!-- Form START -->
            <form class="col s12" method="post" action="@if(!empty($periode)){{url('/periode/edit')}}@else{{url('/periode')}}@endif" enctype="multipart/form-data">
                @csrf
                @if(!empty($periode))@method('put')@endif
                <!-- Row in form START -->
                <div class="row">                    
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">date_range</i>
                        <input id="tgl_awal" type="text" name="tgl_awal" value="@if(!empty($periode)){{$periode->awal}}@else{{old('tgl_awal')}}@endif">
                        <label for="tgl_awal">Tanggal Awal</label>
                        @if(!empty($periode))
                        <input id="kd_periode" type="hidden" name="kd_periode" value="{{$periode->kd_periode}}">
                        @endif
                         @error('tgl_awal')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">date_range</i>
                        <input id="tgl_akhir" type="text" name="tgl_akhir" value="@if(!empty($periode)){{$periode->akhir}}@else{{old('tgl_akhir')}}@endif">
                        <label for="tgl_akhir">Tanggal Akhir</label>
                         @error('tgl_akhir')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>
                </div>    
                <div class="row">
                    <div class="col 6">
                         @if(!empty($periode))
                        <button type="submit" name="submit" class="btn-large green waves-effect waves-light">UBAH <i class="material-icons">edit</i></button>
                        @else
                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        @endif
                    </div>
                    <div class="col 6">
                        <a href="{{url('')}}/periode" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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