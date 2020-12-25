@extends('layouts.website')

@section('content')

  <main id="main">
   <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Login</h2>
              </div>
            </div>          
          <!-- Start  contact -->
            <div class="col-md-8 col-sm-12 col-xs-12">
              @if(session('error'))
                <div class="alert alert-danger alert-block" id="alert-message">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ session('error') }}</strong>
                </div>
              @endif  
              @if(session('berhasil'))
                <div class="alert alert-success alert-block" id="alert-message">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ session('berhasil') }}</strong>
                </div>
              @endif 
              <div class="form contact-form">
                <form action="{{url('')}}/login" method="post">
                  @csrf
                  <div class="form-group">
                    <input type="text" class="form-control @error('email') is-invalid @enderror @if(session('email')){{'is-invalid'}}@endif" name="email" id="email" placeholder="Email" value="{{old('email')}}@if(session('mail')){{session('mail')}}@endif"/>
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(session('email'))
                            <div class="invalid-feedback">{{ session('email') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror @if(session('password')){{'is-invalid'}}@endif" name="password" id="password" placeholder="Kata sandi" value="{{old('password')}}"/>
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(session('password'))
                            <div class="invalid-feedback">{{ session('password') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <center><a href="{{url('')}}/lupa_password">Lupa Akun?</a> | <a href="{{url('')}}/aktifasi/">Aktifasi Akun</a></center>
                  </div>
                  <div class="text-center">
                    <a class="ready-btn btn-danger" href="{{url('')}}">Batal</a>
                    <button type="submit" class="ready-btn btn-primary">Masuk</button>
                  </div>
                  <div class="text-center">
                    <a class="ready-btn btn-success" href="{{url('')}}/registrasi">Registrasi</a>
                  </div>
                </form>
              </div>
              <br>
            </div>
            <!-- End Left contact -->
@endsection  