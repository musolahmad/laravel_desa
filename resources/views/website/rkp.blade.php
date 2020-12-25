@extends('layouts.website')

@section('content')  
  <main id="main">
   <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Rencana Kerja Pemerintah {{$th}}</h2>
              </div>
            </div>          
          <!-- Startikel single blog -->
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="form contact-form">
                <form action="{{url('')}}/{{$th}}/rkp" method="post">
                  @csrf
                  <input type="hidden" name="kode" value="rkp">
                  <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-10">
                      <div class="form-group">
                        <select class="select2 form-control" style="width: 100%;" id="tahun" name="tahun">
                        <?php
                         $thn_skr = date('Y')+1;
                        for ($x=$thn_skr; $x >=2015; $x--) { 
                        ?> 
                        <option <?php if($x==$th) echo "selected='selected'"?> value="<?php echo $x;?>"><?php echo $x;?></option>
                        <?php } ?>
                      </select>
                      </div>
                    </div>  
                    <div class="col-md-2 col-sm-2 col-xs-2">
                      <div class="form-group">
                        <button type="submit" class="btn-primary form-control">Lihat</button>             
                      </div>
                    </div>  
                  </div> 
               </form>
            </div>
            @foreach($master as $m)
               
                <div class="single-blog">
                  <div class="blog-meta">
                    <span class="date-type">
                     Dibuat <i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($m->created_at))}} / {{date('H:i:s',strtotime($m->created_at))}}
                    </span>
                  </div>
                  <div class="blog-text">
                    <div class="box-body table-responsive mailbox-messages">              
                        <table id="example1" class="table table-bordered table-striped">
                            <tbody>
                               <tr>
                                    <td colspan="2">{{$m->uraian}}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kegiatan</td>
                                    <td>{{$m->nm_kegiatan}}</td>
                                </tr>
                                <tr>
                                    <td>Lokasi</td>
                                    <td>{{$m->lokasi}}</td>
                                </tr>
                                <tr>
                                    <td>Perkiraan Volume</td>
                                    <td>{{$m->volume}} {{$m->nm_satuan}}</td>
                                </tr>
                                <tr>
                                    <td>Sasaran / Manfaat</td>
                                    <td>{{$m->sasaran}}</td>
                                </tr>
                                <tr>
                                    <td>Waktu Pelaksanaan</td>
                                    <td>{{date('d-m-Y',strtotime($m->tgl_awal))}} sd {{date('d-m-Y',strtotime($m->tgl_akhir))}}</td>
                                </tr>
                                 <tr>
                                    <td>Prakiraan Biaya</td>
                                    <td>{{number_format($m->biaya,0,',','.')}}</td>
                                </tr>
                                <?php 
                                  $sumber= App\Tb_master_apbdes::where(['kd_rekening'=>$m->sumber])->first();
                                ?>
                                 <tr>
                                    <td>Sumber Dana</td>
                                    <td>{{$sumber->uraian}}</td>
                                </tr>
                                <tr>
                                    <td>Pola Pelaksanaan</td>
                                    <td>@if($m->pola_pelaksanaan==1){{'Swa Kelola'}}@elseif($m->pola_pelaksanaan==2){{'Kerja Sama'}}@else{{'Pihak Ketiga'}}@endif</td>
                                </tr>
                                <tr>
                                    <td>Rencana Pelaksanaan Kegiatan</td>
                                    <td>{{$m->pelaksana}}</td>
                                </tr>
                            </tbody> 
                          </table> 
                      </div>
                  </div>
                  <span>
                    <a href="{{url('')}}/{{$m->kd_kegiatan}}/rkp/detail" class="ready-btn">Lihat Selengkapnya</a>
                  </span>
                </div>
              <!-- End single blog -->             
              @endforeach
               @if($master->isEmpty())
              <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                  <div class="single-blog">
                    <div class="blog-text">
                      <h1>
                          Oops!</h1>
                      <h2>
                          404 Data Tidak Ditemukan</h2>
                      <div class="error-details">
                          Maaf, Belum Ada Rencana Kegiatan yang dibuat pada tahun {{$th}}!
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
          <!-- End single blog -->

@endsection  