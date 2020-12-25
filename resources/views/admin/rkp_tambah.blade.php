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
                            <li class="waves-effect waves-light"><a href="" class="judul"><i class="material-icons">book</i> @if(!empty($rkp)){{'Edit'}}@else{{'Tambah'}}@endif Data Rencana Kerja Pemerintah</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        <!-- Secondary Nav END -->
        </div>
        <div class="row jarak-form">

        <!-- Form START -->
            <form class="col s12" method="post" action="@if(!empty($rkp)){{url('/rkp/'.$rkp->kd_kegiatan)}}@else{{url('/rkp/simpan')}}@endif" enctype="multipart/form-data">
                @csrf
                @if(!empty($rkp))@method('put')@endif
                <!-- Row in form START -->
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">filter_1</i>
                        <input id="bidang" type="text" name="bidang" value="{{$bidang->uraian}}" disabled>
                        <input id="kd_rekening" type="hidden" name="kd_rekening" value="{{$bidang->kd_rekening}}">
                        <input id="th" type="hidden" name="th" value="{{$th}}">
                        <label for="bidang">Bidang</label>                                          
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">assessment</i>
                        <input id="nm_kegiatan" type="text" name="nm_kegiatan" value="@if(!empty($rkp)){{$rkp->nm_kegiatan}}@else{{old('nm_kegiatan')}}@endif" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                        <label for="nm_kegiatan">Jenis Kegiatan</label>
                        @error('nm_kegiatan')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div> 
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">place</i>                        
                        <label for="alamat">Lokasi (RT/RW/Dusun)</label>
                        <input id="lokasi" type="text" name="lokasi" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')" value="@if(!empty($rkp)){{$rkp->lokasi}}@else{{old('lokasi')}}@endif">
                    </div> 
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">insert_chart</i>                 
                        <label for="volume">Volume</label>    
                        <input id="volume" type="text" class="uang" name="volume" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')" value="@if(!empty($rkp)){{$rkp->volume}}@else{{old('volume')}}@endif">
                    </div> 
                    <div class="input-field col s1">
                        <label>Satuan</label>                        
                    </div>
                    <div class="input-field col s5">
                        <select name="kd_satuan" id="kd_satuan">
                            @foreach($satuan as $s)
                            <option value="{{$s->kd_satuan}}" @if(!empty($rkp)) @if($rkp->kd_satuan==$s->kd_satuan) {{'selected'}} @endif @endif>{{$s->nm_satuan}}</option> 
                            @endforeach                           
                        </select>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">people_outline</i>
                        <input id="sasaran" type="text" name="sasaran" value="@if(!empty($rkp)){{$rkp->sasaran}}@else{{old('sasaran')}}@endif" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                        <label for="sasaran">Sasaran / Manfaaat</label>
                        @error('sasaran')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>    
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">date_range</i>
                        <input id="tgl_awal" type="text" name="tgl_awal" value="@if(!empty($rkp)){{$rkp->tgl_awal}}@else{{old('tgl_awal')}}@endif">
                        <label for="tgl_awal">Tanggal Awal</label>
                         @error('tgl_awal')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>                   
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">date_range</i>
                        <input id="tgl_akhir" type="text" name="tgl_akhir" value="@if(!empty($rkp)){{$rkp->tgl_akhir}}@else{{old('tgl_akhir')}}@endif">
                        <label for="tgl_akhir">Tanggal Akhir</label>
                         @error('tgl_akhir')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div>  
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">attach_money</i>                        
                        <label for="alamat">Prakiraan Biaya</label>
                        <input id="biaya" type="text" name="biaya" class="uang" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')" value="@if(!empty($rkp)){{$rkp->biaya}}@else{{old('biaya')}}@endif">
                        @error('biaya')
                         <small class="red-text">*{{ $message }}</small>
                        @enderror
                    </div> 
                    <div class="input-field col s2">
                        <label>Sumber Dana</label>                        
                    </div>
                    <div class="input-field col s4">
                        <select name="sumber" id="sumber">
                            @foreach($apbdes as $s)
                            <option value="{{$s->kd_rekening}}" @if(!empty($rkp))@if($rkp->sumber==$s->kd_rekening){{'selected'}}@endif @endif>{{$s->uraian}}</option> 
                            @endforeach   
                        </select>
                    </div>                     
                    <div class="input-field col s2">
                        <label>Pola Pelaksanaan</label>                        
                    </div>
                    <div class="input-field col s10">
                        <select name="pola_pelaksanaan" id="pola_pelaksanaan">
                            <option value="1" @if(!empty($rkp))@if($rkp->pola_pelaksanaan=="1"){{'selected'}}@endif @endif>Swakelola</option>
                            <option value="2" @if(!empty($rkp))@if($rkp->pola_pelaksanaan=="2"){{'selected'}}@endif @endif>Kerja Sama</option>
                            <option value="3" @if(!empty($rkp))@if($rkp->pola_pelaksanaan=="3"){{'selected'}}@endif @endif>Pihak Ketiga</option>
                        </select>
                    </div>  
                    <div class="input-field col s12">
                        <i class="material-icons prefix md-prefix">content_paste</i>                        
                        <label for="alamat">Rencana Pelaksana Kegiatan</label>
                        <input id="pelaksana" type="text" name="pelaksana" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')" value="@if(!empty($rkp)){{$rkp->pelaksana}}@else{{old('pelaksana')}}@endif">
                    </div> 
                </div> 
                <div class="row">
                    <div class="col 6">
                         @if(!empty($rkp))
                        <button type="submit" name="submit" class="btn-large green waves-effect waves-light">UBAH <i class="material-icons">edit</i></button>
                        @else
                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        @endif
                    </div>
                    <div class="col 6">
                        <a href="{{url('')}}/rkp" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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