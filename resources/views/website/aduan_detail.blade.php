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
                        <a href="{{url('')}}/pelapor/{{$artikel->kd_user}}">
                          <img src="{{url('')}}/storage/{{$artikel->foto_profil}}" class="avatar">
                        </a>
                      </span>
                      <span class="author-meta">
                        <a href="{{url('')}}/pelapor/{{$artikel->kd_user}}">{{$artikel->nama_depan}} {{$artikel->nama_belakang}}</a>
                      </span>
                      <span class="pull-right">
                        <i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($artikel->tgl))}} / {{date('H:i:s',strtotime($artikel->tgl))}}
                      </span>
                      <div class="blog-meta">                   
                      <span class="">
                        Aduan {{$artikel->status}}
                      </span>
                  </div>
                  </div>
                  <div class="single-blog-img">
                    <a href="{{url('')}}/artikel/{{$artikel->id}}">
                      <img src="{{url('')}}/storage/{{$artikel->gambar}}" alt="" height="100%" width="100%">
                    </a>
                  </div>
                  <div class="blog-text">
                    <h4>
                      <a href="#">{{$artikel->judul}}</a>
                    </h4>
                    <p align="justify">
                      {{$artikel->isi}}
                    </p>
                  </div>
                  <div class="blog-meta">
                    <span class="pull-right"><b>{{$jumlah}} Komentar</b></span>
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
                      <a class="ready-btn btn-danger" href="{{url('')}}/aduan">Halaman Aduan</a>
                    </div>
                  </div>
              </div>
              @endif             
            </div>
            @if(!empty($rkp))
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="single-blog  left-blog">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="blog-meta">
                        <div class="recent-single-post">
                          Aduan Sudah Diajukan dalam Rencana Kerja Pemerintah
                          <span class="pull-right">
                            <i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($rkp->tgl))}} / {{date('H:i:s',strtotime($rkp->tgl))}}
                          </span>
                        </div>  
                      </div>
                      <div class="recent-post">
                        <div class="blog-text">
                          <b>Berikut ini Rincian Pengajuan Rencana Kerja Pemerintah</b>
                          <p></p>
                          <div class="blog-text">
                            <div class="box-body table-responsive mailbox-messages">              
                                <table id="example1" class="table table-bordered table-striped">
                                    <tbody>
                                       <tr>
                                            <td colspan="2">{{$rkp->uraian}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kegiatan</td>
                                            <td>{{$rkp->nm_kegiatan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Lokasi</td>
                                            <td>{{$rkp->lokasi}}</td>
                                        </tr>
                                        <tr>
                                            <td>Perkiraan Volume</td>
                                            <td>{{$rkp->volume}} {{$rkp->nm_satuan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Sasaran / Manfaat</td>
                                            <td>{{$rkp->sasaran}}</td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Pelaksanaan</td>
                                            <td>{{date('d-m-Y',strtotime($rkp->tgl_awal))}} sd {{date('d-m-Y',strtotime($rkp->tgl_akhir))}}</td>
                                        </tr>
                                         <tr>
                                            <td>Prakiraan Biaya</td>
                                            <td>{{number_format($rkp->biaya,0,',','.')}}</td>
                                        </tr>
                                        <?php 
                                          $sumber= App\Tb_master_apbdes::where(['kd_rekening'=>$rkp->sumber])->first();
                                        ?>
                                         <tr>
                                            <td>Sumber Dana</td>
                                            <td>{{$sumber->uraian}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pola Pelaksanaan</td>
                                            <td>@if($rkp->pola_pelaksanaan==1){{'Swa Kelola'}}@elseif($rkp->pola_pelaksanaan==2){{'Kerja Sama'}}@else{{'Pihak Ketiga'}}@endif</td>
                                        </tr>
                                        <tr>
                                            <td>Rencana Pelaksanaan Kegiatan</td>
                                            <td>{{$rkp->pelaksana}}</td>
                                        </tr>
                                    </tbody> 
                                  </table> 
                              </div>
                          </div>
                          <span>
                            <a href="{{url('')}}/{{$rkp->kd_kegiatan}}/rkp/detail" class="ready-btn">Lihat Selengkapnya</a>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
               </div>
            </div>
            @endif
            @foreach($komentar as $kmt)
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="single-blog  left-blog">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="blog-meta">
                        <div class="recent-single-post">
                          <span class="date-type">
                            <img src="{{url('')}}/storage/{{$kmt->foto_profil}}" class="avatar">
                          </span>
                          <span class="author-meta">
                            {{$kmt->nm_pegawai}} (Admin)
                          </span>
                          <span class="pull-right">
                            <i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($kmt->tgl))}} / {{date('H:i:s',strtotime($kmt->tgl))}}
                          </span>
                        </div>  
                      </div>
                      <div class="recent-post">
                        <div class="blog-text">
                          <b>{{$kmt->sts}}</b>
                          <p align="justify">
                            {{$kmt->komentar}}
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
               </div>
            </div>
            @endforeach
          </div>
          <!-- End single blog -->

@endsection  