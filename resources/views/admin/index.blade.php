@extends('layouts.admin')

@section('content')
  <main>

    <!-- container START -->
    <div class="container"> 
        <div class="row">
          
                <div class="col s12" id="header-instansi">
                    <div class="card blue-grey white-text">
                        <div class="card-content">
                            <div class="circle left"><img class="logo" src="{{url('')}}/storage/@if($desa){{$desa->logo}}@else{{'profil_desa/favicon.png'}}@endif"/></div>
                            <h5 class="ins">@if($desa){{$desa->nm_desa}}@else{{'Desa Wisata'}}@endif</h5>
                            <p class="almt">@if($desa){{$desa->alamat}}@endif, Kode Pos : @if($desa){{$desa->kd_pos}}@endif</p>
                            <p class="almt">Hari Kerja : @if($desa){{$desa->hr_krj}}@endif | Jam Kerja : @if($desa){{$desa->jm_krj}}@endif</p>
                        </div>
                    </div>
                </div>
            
            <!-- Welcome Message START -->        
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4>Selamat Datang </h4>
                        <p class="description">Anda login sebagai
                        <strong>@if(session('lvl_admin')==1){{'Super Admin'}}@else{{'Admin'}}@endif</strong>. @if(session('lvl_admin')==1){{'Anda memiliki akses penuh terhadap sistem.'}}@endif</p>
                    </div>
                </div>
            </div>
            <!-- Welcome Message END -->

            <!-- Info Statistic START -->
            <div class="col s12 m4">
                <a href="{{url('')}}/berita">
                    <div class="card green">
                        <div class="card-content">
                            <span class="card-title white-text"><i class="material-icons md-36">class</i> Jumlah Artikel dan Berita</span>
                            <h5 class="white-text link">{{$artikel}} Artikel dan Berita</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col s12 m4">
                <a href="{{url('')}}/glr">
                    <div class="card purple">
                        <div class="card-content">
                            <span class="card-title white-text"><i class="material-icons md-36">picture_in_picture</i> Jumlah Galeri Foto</span>
                            <h5 class="white-text link">{{$galeri}} Foto</h5>
                        </div>
                    </div>
                </a>
            </div>            
            <div class="col s12 m4">
                <a href="{{url('')}}/adn">
                    <div class="card cyan">
                        <div class="card-content">
                            <span class="card-title white-text"><i class="material-icons md-36">mail</i> Jumlah Aduan Masyarakat</span>
                            <h5 class="white-text link">{{$masuk}} Aduan Masyarakat</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Row END -->
    
    </div>
    <!-- container END -->

</main>
<!-- Main END -->

@endsection  