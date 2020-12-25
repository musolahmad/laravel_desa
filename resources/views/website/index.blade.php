@extends('layouts.website')

@section('content')  
  <main id="main">
   <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Berita dan Artikel Terkini</h2>
              </div>
            </div>          
          <!-- Start single blog -->
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">
              @foreach($artikel as $art)
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="single-blog">
                  <div class="blog-meta">
                    <span class="date-type">
                      <a href="">
                        <img src="{{url('')}}/storage/{{$art->foto_profil}}" class="avatar">
                      </a>
                    </span>
                    <span class="author-meta">
                      {{$art->nm_pegawai}}
                    </span>
                    <span class="pull-right">
                      <i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($art->tgl))}} / {{date('H:i:s',strtotime($art->tgl))}}
                    </span>
                  </div>                  
                  <div class="single-blog-img">                    
                    <a href="{{url('')}}/artikel/{{$art->id}}">
                      <img src="{{url('')}}/storage/{{$art->foto_berita}}" alt="" width="100%">
                    </a>
                  </div>
                  <div class="blog-meta">
                    
                  </div>
                  <div class="blog-text">
                    <h4>
                      <a href="#">{{$art->judul}}</a>
                    </h4>
                    <p align="justify">
                      {!!substr($art->isi, 0, 300)!!}.........
                    </p>
                  </div>
                  <span>
                    <a href="{{url('')}}/artikel/{{$art->id}}" class="ready-btn">Lihat Selengkapnya</a>
                  </span>
                </div>
              </div>
              <!-- End single blog -->             
              @endforeach
              @if($artikel->isEmpty())
              <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                  <div class="single-blog">
                    <div class="blog-text">
                      <h1>
                          Oops!</h1>
                      <h2>
                          404 Data Tidak Ditemukan</h2>
                      <div class="error-details">
                          Maaf, Tidak ada berita atau artikel!
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
              <div class="col-md-12 col-sm-12 col-xs-12">                
                <!-- End single blog -->
                @if ($artikel->hasPages())
                <nav aria-label="...">
                  <ul class="pagination">
                    <li class="page-item {{ ($artikel->currentPage() == 1) ? ' disabled' : '' }}">
                      <a class="page-link" href="{{ $artikel->url($artikel->currentPage()-1) }}">Previous</a>
                    </li>
                    <?php
                        $start = $artikel->currentPage() - 1; // show 3 pagination links before current
                        $end = $artikel->currentPage() + 1; // show 3 pagination links after current
                        if($start < 1) {
                            $start = 1; // reset start to 1
                            $end += 1;
                        } 
                        if($end >= $artikel->lastPage() ) $end = $artikel->lastPage(); // reset end to last page
                    ?>

                    @if($start > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $artikel->url(1) }}">{{1}}</a>
                        </li>
                        @if($artikel->currentPage() != 4)
                            {{-- "Three Dots" Separator --}}
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                        @endif
                    @endif
                        @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ ($artikel->currentPage() == $i) ? ' active' : '' }}">
                                <a class="page-link" href="{{ $artikel->url($i) }}">{{$i}}</a>
                            </li>
                        @endfor
                    @if($end < $artikel->lastPage())
                        @if($artikel->currentPage() + 3 != $artikel->lastPage())
                            {{-- "Three Dots" Separator --}}
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="{{ $artikel->url($artikel->lastPage()) }}">{{$artikel->lastPage()}}</a>
                        </li>
                    @endif
                    <li class="page-item {{ ($artikel->currentPage() == $artikel->lastPage()) ? ' disabled' : '' }}">
                      <a class="page-link" href="{{ $artikel->url($artikel->currentPage()+1) }}">Next</a>
                    </li>
                  </ul>
                </nav>
                @endif
              </div>              
            </div>
          </div>
          <!-- End single blog -->
@endsection  