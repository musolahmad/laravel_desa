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
          <!-- Start  contact -->
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="form contact-form">
                <form action="{{url('')}}/aktifasi" method="post">
                   @csrf
                  <div class="form-group">
                    <label>Temukan Akun Anda</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror @if(session('email')){{'is-invalid'}}@endif" name="email" id="email" placeholder="Email" value="{{old('email')}}"/>
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(session('email'))
                            <div class="invalid-feedback">{{ session('email') }}</div>
                    @endif
                  </div>
                  <div class="text-center">                    
                    <button type="submit" class="ready-btn btn-primary">Cari</button>
                    <a class="ready-btn btn-danger" href="{{url('/')}}">Batal</a>
                  </div>
                </form>
              </div>
              <br>
            </div>
            <!-- End Left contact -->

@endsection  