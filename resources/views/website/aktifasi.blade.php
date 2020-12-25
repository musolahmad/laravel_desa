@extends('layouts.website')

@section('content')

  <main id="main">
   <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Aktifasi Akun</h2>
              </div>
            </div>       
         
            <!-- End Left contact -->            
            <div class="col-md-2 col-sm-3 col-xs-12">
              <div class="single-team-member">
                <div class="team-img">
                  <a href="#">
                    <img src="{{url('')}}/storage/{{$user->foto_profil}}" alt="">
                  </a>
                </div>
                <div class="team-content text-center">
                  <h4>{{$user->nama_depan}} {{$user->nama_belakang}}</h4>
                  <p>Pengguna Aplikasi</p>
                </div>
              </div>
            </div>
            <!-- End column -->
            <div class="col-md-6 col-sm-9 col-xs-12">
              <div class="form contact-form">
                <form action="{{url('')}}/registrasi/{{$user->kd_user}}" method="post">
                   @method('put')
                   @csrf
                  <div class="form-group">
                    <p>Silahkan cek email Anda dan Masukkan kode Aktifasi</p>
                    <input type="text" name="kd_user" id="kd_user" class="form-control @error('kd_user') is-invalid @enderror @if(session('kd_user')){{'is-invalid'}}@endif" placeholder="Kode Aktifasi" value="{{old('kd_user')}}">
                    @error('kd_user')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(session('kd_user'))
                            <div class="invalid-feedback">{{ session('kd_user') }}</div>
                    @endif
                  </div>
                  <div class="text-center">                    
                    <button type="submit" class="ready-btn btn-primary">Lanjutkan</button>
                    <a class="ready-btn btn-danger" href="{{url('/aktifasi')}}">Bukan Anda?</a>
                  </div>
                </form>
              </div>
              <br>
            </div>

@endsection  