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
                                    <li class="waves-effect waves-light judul">{{$berita->judul}} (Aduan {{$berita->status}})</li>
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
            <div class="col s12 m4">
                <img src="{{url('')}}/storage/{{$berita->gambar}}" width="100%"/>
            </div>
            <div class="col s12 m8">
                <img src="{{url('')}}/storage/{{$berita->foto_profil}}" width="100%" class="avatar" /> 
                <b><a href="{{url('')}}/pelapor/{{$berita->kd_user}}">{{$berita->nama_depan}} {{$berita->nama_belakang}}</a></b>   
                <span class="right"><small><i class="material-icons">date_range</i> {{date('d-m-Y (H:i:s)',strtotime($berita->tgl))}}</small></span>
                <div class="card">
                    <div class="col s12">
                        <p><b>{{$berita->judul}}</b></p>
                        <p>Lokasi : {{$berita->lokasi}}</p>
                        <p>{{$berita->isi}}</p>
                    </div>
                    <div class="col s12" style="text-align: right;">
                        <form action="{{url('')}}/aduan_masyarakat/{{$berita->kd_aduan}}" method="post">
                            @method('delete')
                            @csrf
                        @if($berita->status=='Masuk'||$berita->status=='Ditolak')
                        <a class="btn small blue waves-effect waves-light modal-trigger white-text" href="#modal" onclick="tambah('Diterima','{{$berita->kd_aduan}}');"><i class="material-icons">done</i> Terima</a>
                        @endif
                        @if($berita->status=='Masuk'||$berita->status=='Diterima')
                        <a class="btn small orange waves-effect waves-light modal-trigger white-text" href="#modal" onclick="tambah('Ditolak','{{$berita->kd_aduan}}');"><i class="material-icons">close</i> Tolak</a>
                        @endif
                        @if($berita->status!='Diajukan')
                            <input type="hidden" name="gambar" value="{{$berita->gambar}}">
                            <button type="submit" class="btn small red waves-effect waves-light white-text"><i class="material-icons">delete</i> Hapus</button>
                        @endif
                        </form>
                        
                    </div>
                    <div id="modal" class="modal">
                            <div class="modal-content white">
                                <h5>Tulis Komentar Anda</h5>
                                <div class="row">
                                    <form method="post" action="{{url('')}}/aduan_masyarakat">
                                        <div class="input-field col s12">
                                             @csrf
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix md-prefix">subtitles</i>
                                                <input id="komentar" type="text" name="komentar" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                <input id="status" type="hidden" name="status">
                                                <input id="kd_aduan" type="hidden" name="kd_aduan">
                                                <label for="judul">Tulis Komentar</label>
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
                </div>
                {{$jumlah}} Komentar 
                @foreach($komentar as $kmt)
                <p>
                <img src="{{url('')}}/storage/{{$kmt->foto_profil}}" width="100%" class="avatar1" /> 
                <b>{{$kmt->nm_pegawai}}</b>
                <span class="right"><small><i class="material-icons">date_range</i> {{date('d-m-Y (H:i:s)',strtotime($kmt->tgl))}}</small></span>
                </p>
                <div class="card">
                    <div class="col s12">
                        <p><b>{{$kmt->sts}}</b></p>
                        <p>{{$kmt->komentar}}</p>
                    </div>
                    @if(session('kode_admin')==$kmt->kd_admin)
                    <div class="col s12" style="text-align: right;">
                        @if($berita->status!='Diajukan')
                        <form action="{{url('')}}/aduan_masyarakat/hapus" method="post">
                            @method('delete')
                            @csrf
                            <input type="hidden" name="kd_komentar_hapus" value="{{$kmt->kd_komentar}}">
                            <input type="hidden" name="kd_aduan_hapus" value="{{$berita->kd_aduan}}">
                            <a class="btn small green waves-effect waves-light modal-trigger white-text" href="#modaljml" onclick="edit('{{$kmt->kd_komentar}}','{{$kmt->komentar}}','{{$kmt->kd_aduan}}');"><i class="material-icons">edit</i> Edit</a>
                            <button type="submit" class="btn small red waves-effect waves-light white-text"><i class="material-icons">delete</i> Hapus</a>
                        </form>
                        @else
                        <a class="btn small green waves-effect waves-light modal-trigger white-text" href="#modaljml" onclick="edit('{{$kmt->kd_komentar}}','{{$kmt->komentar}}','{{$kmt->kd_aduan}}');"><i class="material-icons">edit</i> Edit</a>
                        @endif
                    </div>
                    @endif
                </div>
                @endforeach
                @if($komentar->isEmpty())
                <p style="text-align: center;"><b>Tidak Ada Komentar</b></p>
                @endif
                <a type="button" href="{{url('')}}/adn" class="btn small blue-grey waves-effect waves-light white-text"><i class="material-icons">arrow_back</i> Kembali</a>
                <div id="modaljml" class="modal">
                    <div class="modal-content white">
                       <h5>Edit Komentar Anda</h5>
                           <div class="row">
                                <form method="post" action="{{url('')}}/aduan_masyarakat/edit">
                                        <div class="input-field col s12">
                                            @method('put')
                                            @csrf
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix md-prefix">subtitles</i>
                                                <input id="komentar_edit" type="text" name="komentar_edit" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                <input id="kd_komentar" type="hidden" name="kd_komentar">
                                                <input id="kd_aduan_edit" type="hidden" name="kd_aduan_edit">
                                                <label for="judul">Edit Komentar</label>
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
            </div>
        </div>    
    </div>
    <!-- container END -->  

</main>
<!-- Main END -->

@endsection 
<script>
    function tambah(sts,kd_aduan) {
    // body...
    document.getElementById('komentar').value='';
     document.getElementById('status').value=sts;
     document.getElementById('kd_aduan').value=kd_aduan;
  }
   function edit(kd_komentar,komentar,kd_aduan) {
    // body...
    document.getElementById('komentar_edit').value=komentar;
     document.getElementById('kd_komentar').value=kd_komentar; 
     document.getElementById('kd_aduan_edit').value=kd_aduan;
  }
</script>