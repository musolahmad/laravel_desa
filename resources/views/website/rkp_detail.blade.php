@extends('layouts.website')

@section('content')  
  <main id="main">
   <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>@if(!empty($master)){{$master->nm_kegiatan}}@else{{'Rencana Kegiatan Pemerintah'}}@endif</h2>
              </div>
            </div>          
          <!-- Startikel single blog -->

          <div class="col-md-8 col-sm-8 col-xs-12 fix">
              @if(!empty($master))
                <div class="single-blog">
                  <div class="blog-meta">
                    <span class="date-type">
                     Dibuat <i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($master->created_at))}} / {{date('H:i:s',strtotime($master->created_at))}}
                    </span>
                  </div>
                  <div class="blog-text">
                    <div class="box-body table-responsive mailbox-messages">              
                        <table id="example1" class="table table-bordered table-striped">
                            <tbody>
                               <tr>
                                    <td colspan="2">{{$master->uraian}}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kegiatan</td>
                                    <td>{{$master->nm_kegiatan}}</td>
                                </tr>
                                <tr>
                                    <td>Lokasi</td>
                                    <td>{{$master->lokasi}}</td>
                                </tr>
                                <tr>
                                    <td>Perkiraan Volume</td>
                                    <td>{{$master->volume}} {{$master->nm_satuan}}</td>
                                </tr>
                                <tr>
                                    <td>Sasaran / Manfaat</td>
                                    <td>{{$master->sasaran}}</td>
                                </tr>
                                <tr>
                                    <td>Waktu Pelaksanaan</td>
                                    <td>{{date('d-m-Y',strtotime($master->tgl_awal))}} sd {{date('d-m-Y',strtotime($master->tgl_akhir))}}</td>
                                </tr>
                                 <tr>
                                    <td>Prakiraan Biaya</td>
                                    <td>{{number_format($master->biaya,0,',','.')}}</td>
                                </tr>
                                <?php 
                                  $sumber= App\Tb_master_apbdes::where(['kd_rekening'=>$master->sumber])->first();
                                ?>
                                 <tr>
                                    <td>Sumber Dana</td>
                                    <td>{{$sumber->uraian}}</td>
                                </tr>
                                <tr>
                                    <td>Pola Pelaksanaan</td>
                                    <td>@if($master->pola_pelaksanaan==1){{'Swa Kelola'}}@elseif($master->pola_pelaksanaan==2){{'Kerja Sama'}}@else{{'Pihak Ketiga'}}@endif</td>
                                </tr>
                                <tr>
                                    <td>Rencana Pelaksanaan Kegiatan</td>
                                    <td>{{$master->pelaksana}}</td>
                                </tr>
                            </tbody> 
                          </table> 
                      </div>
                  </div>
                </div>
              <!-- End single blog -->
               <div class="blog-text">
                <div class="section-headline text-center">
                            <h2>Rencana Anggaran Biaya</h2>
                    </div>
                  
                    <div class="box-body table-responsive mailbox-messages">              
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%" rowspan="2" style="text-align: center;">No / Kode Rekening</th>
                                    <th width="30%" rowspan="2" style="text-align: center;">Uraian</th>
                                    <th width="40%" colspan="3" style="text-align: center;">Rincian Perhitungan</th>
                                    <th width="20%" rowspan="2" style="text-align: center;">Jumlah (Rp)</th>
                                </tr>  
                                <tr>
                                    <th style="text-align: center;">Volume</th>
                                    <th style="text-align: center;">Satuan</th>
                                    <th style="text-align: center;">Harga Satuan (Rp)</th>
                                </tr>                       
                            </thead>
                            <tbody> 
                                <tr>
                                    <td style="text-align: center;">1</td>
                                    <td style="text-align: center;">2</td>
                                    <td style="text-align: center;">3</td>
                                    <td style="text-align: center;">4</td>
                                    <td style="text-align: center;">5</td>
                                    <td style="text-align: center;">6 = (3X5)</td>
                                </tr>                   
                                <?php 
                                    $rab = App\Tb_rab::join('tb_rkp','tb_rkp.kd_kegiatan','=','tb_rab.kd_kegiatan')->where('tb_rab.kd_kegiatan',$master->kd_kegiatan)->groupBy('jns_belanja')->get();
                                    $tot=0;
                                    $no=0;
                                ?>    
                                @foreach($rab as $ra)
                                <tr>
                                    <td><b>{{$ra->kd_rekening}}.{{$ra->no_urut_kegiatan}}.{{$ra->jns_belanja}}</b></td>
                                    <td colspan="5"><b>@if($ra->jns_belanja=='1'){{'Belanja Pegawai'}}@elseif($ra->jns_belanja=='2'){{'Belanja Barang dan Jasa'}}@else{{'Belanja Modal'}}@endif</b></td>
                                </tr>
                                <?php 
                                    $detail = App\Tb_rab::join('tb_rkp','tb_rkp.kd_kegiatan','=','tb_rab.kd_kegiatan')->join('tb_satuan','tb_satuan.kd_satuan','=','tb_rab.kd_satuan')->where('tb_rab.kd_kegiatan',$master->kd_kegiatan)->where('jns_belanja',$ra->jns_belanja)->get();
                                    $jumlah=0; 
                                ?>
                                @foreach($detail as $det) 
                                 <tr>
                                    <td>{{$ra->kd_rekening}}.{{$ra->no_urut_kegiatan}}.{{$ra->jns_belanja}}.{{$det->no_urut}}</td>
                                    <td>{{$det->uraian}}</td>
                                    <td style="text-align: center;">{{$det->vol_rab}}</td>
                                    <td style="text-align: center;">{{$det->nm_satuan}}</td>
                                    <td style="text-align: right;">{{number_format($det->hrg_satuan,0,',','.')}}</td>
                                    <td style="text-align: right;">{{number_format($det->vol_rab*$det->hrg_satuan,0,',','.')}}</td>
                                </tr>
                                <?php 
                                    $jumlah = $jumlah+($det->vol_rab*$det->hrg_satuan);
                                    $tot = $tot+$jumlah;
                                ?>
                               @endforeach 
                               <?php $no=$no+1; ?>
                                <tr>
                                    <th colspan="5" style="text-align: right;">Sub Total ({{$no}})</th>
                                    <th style="text-align: right;">{{number_format($jumlah,0,',','.')}}</th>
                                </tr>        
                                @endforeach                   
                                @if($rab->isEmpty())
                                    <tr><td colspan="6"><center>Tidak ada data yang ditemukan</center></td></tr>
                                @endif
                            </tbody>
                            <thead class="blue lighten-4" id="head">
                                <tr>
                                    <th colspan="5" style="text-align: right;">Jumlah (Rp.)</th>
                                    <th style="text-align: right;">{{number_format($tot,0,',','.')}}</th>
                                </tr>                  
                            </thead>
                          </table> 
                      </div>
                  </div>
              <!-- ======= Portfolio Section ======= -->
                 <div class="container">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="section-headline text-center">
                            <h2>Foto Lokasi</h2>
                          </div>
                        </div>
                      </div>
                      <div class="row wesome-project-1 fix">
                        <!-- Start Portfolio -page -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="awesome-menu ">
                            <ul class="project-menu">
                              <li>
                                <a href="#" class="active" data-filter="*">Semua</a>
                              </li>
                              <li>
                                <a href="#" data-filter=".development">Sebelum</a>
                              </li>
                              <li>
                                <a href="#" data-filter=".design">Sesudah</a>
                              </li>
                              <li>
                                <a href="#" data-filter=".photo">Kiriman Masyarakat</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>

                      <div class="row awesome-project-content">
                         <?php 
                            $foto_sblm = App\Tb_galeri::where('kode',$master->kd_gbr_awl)->get();
                        ?>
                        <!-- single-awesome-project start -->
                        @foreach($foto_sblm as $glr)
                        <div class="col-md-4 col-sm-4 col-xs-12 development">
                          <div class="single-awesome-project">
                            <div class="awesome-img">
                              <a href="#"><img src="{{url('')}}/storage/{{$glr->gambar}}" alt="" width="100%" /></a>
                              <div class="add-actions text-center">
                                <div class="project-dec">
                                  <a class="venobox" data-gall="myGallery" href="{{url('')}}/storage/{{$glr->gambar}}">
                                    <h4>Foto Kegiatan</h4>
                                    <span>Sebelum</span>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        <!-- single-awesome-project end -->
                        <?php 
                            $foto_sdh = App\Tb_galeri::where('kode',$master->kd_gbr_akh)->get();
                        ?>
                        <!-- single-awesome-project start -->
                        @foreach($foto_sdh as $glr)
                        <!-- single-awesome-project start -->
                        <div class="col-md-4 col-sm-4 col-xs-12 design">
                          <div class="single-awesome-project">
                            <div class="awesome-img">
                              <a href="#"><img src="{{url('')}}/storage/{{$glr->gambar}}" alt="" width="100%" /></a>
                              <div class="add-actions text-center">
                                <div class="project-dec">
                                  <a class="venobox" data-gall="myGallery" href="{{url('')}}/storage/{{$glr->gambar}}">
                                    <h4>Foto Kegiatan</h4>
                                    <span>Sesudah</span>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- single-awesome-project end -->
                        @endforeach
                      </div>
                  </div><!-- End Portfolio Section -->
              @else
              <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                  <div class="single-blog">
                    <div class="blog-text">
                      <h1>
                          Oops!</h1>
                      <h2>
                          404 Data Tidak Ditemukan</h2>
                      <div class="error-details">
                          Maaf, Data yang anda cari tidak ada!
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