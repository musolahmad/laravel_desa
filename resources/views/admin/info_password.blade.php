@extends('layouts.website')

@section('content')

  <main id="main">
   <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Bagaimana Anda ingin mendapatkan kode kata sandi Anda?</h2>
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
                  <h4>{{$user->nm_pegawai}}</h4>
                  <p>Pengguna Aplikasi</p>
                </div>
              </div>
            </div>
            <!-- End column -->
            <div class="col-md-6 col-sm-9 col-xs-12">
              <div class="form contact-form">
                <form action="{{url('')}}/lupa_password/{{$user->kd_admin}}" method="post">
                   @csrf
                  <div class="form-group">
                    <p>Kirim kode melalui Email?</p>
                    <h3><i class="fa fa-envelope-o"></i> {{$user->email}}</h3>
                  </div>
                  <div class="text-center">                    
                    <button type="submit" class="ready-btn btn-primary">Lanjutkan</button>
                    <a class="ready-btn btn-danger" href="{{url('/lupa_password')}}">Bukan Anda?</a>
                  </div>
                </form>
              </div>
              
              <br>
            </div>

@endsection  