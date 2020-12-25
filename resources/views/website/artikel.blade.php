@extends('layouts.website')

@section('content')  
  <main id="main">
   <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>@if(!empty($artikel)){{$artikel->judul}}@else{{'Artikel Tidak Ditemukan'}}@endif</h2>
              </div>
            </div>          
          <!-- Startikel single blog -->
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">
              @if(!empty($artikel))
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="single-blog">
                  <div class="blog-meta">
                    <span class="date-type">
                      <a href="">
                        <img src="{{url('')}}/storage/{{$artikel->foto_profil}}" class="avatar">
                      </a>
                    </span>
                    <span class="author-meta">
                     {{$artikel->nm_pegawai}}
                    </span>
                    <span class="pull-right">
                      <i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($artikel->tgl))}} / {{date('H:i:s',strtotime($artikel->tgl))}}
                    </span>
                  </div>           
                  <div class="single-blog-img">
                    <a href="{{url('')}}/artikel/{{$artikel->id}}">
                      <img src="{{url('')}}/storage/{{$artikel->foto_berita}}" alt="" width="100%">
                    </a>
                  </div>
                  <div class="blog-meta">
                    
                  </div>
                  <div class="blog-text">
                    <h4>
                      <a href="#">{{$artikel->judul}}</a>
                    </h4>
                    <p align="justify">
                      {!!$artikel->isi!!}
                    </p>
                  </div>
                </div>
              </div>
              <!-- End single blog -->  
              @else
              <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                  <div class="single-blog">
                    <div class="blog-text">
                      <h1>
                          Oops!</h1>
                      <h2>
                          404 Data Tidak Ditemukan</h2>
                      <div class="error-details">
                          Maaf, Halamaan yang anda requset tidak ditemukan!
                      </div>
                    </div>
                  </div>
                  <div class="form contact-form">
                    <div class="text-center">
                      <a class="ready-btn btn-danger" href="{{url('')}}">Halaman Utama</a>
                    </div>
                  </div>
              </div>
              @endif             
            </div>
          </div>
          <!-- End single blog -->

@endsection  