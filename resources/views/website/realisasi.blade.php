@extends('layouts.website')

@section('content')  
  <main id="main">
   <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Realisasi {{$th}}</h2>
              </div>
            </div>          
          <!-- Startikel single blog -->
          <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="form contact-form">
                <form action="{{url('')}}/{{$th}}/realisasi" method="post">
                  @csrf
                  <input type="hidden" name="kode" value="realisasi">
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
            <div class="box-body table-responsive mailbox-messages">              
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                        <th width="10%">Kode Rekening</th>
                        <th width="55%">Uraian</th>
                        <th width="15%">Pagu Anggaran</th>
                        <th width="15%">Realisasi Anggaran</th>
                        <th width="15%">Lebih / Kurang</th>
                      </tr>                    
                  </thead>
                  <tbody>
                      @foreach($master as $m)
                      <tr>
                          <td>{{$m->kd_rekening}}.</td>
                          <td>@if($m->kd_induk==0)<b style="color:red;">{{$m->uraian}}</b>@else @if($m->tipe_akun==1)<b>{{$m->uraian}}</b>@else{{$m->uraian}}@endif @endif</td>
                          <td style="text-align: right;">
                              <?php 
                                   $pagu= App\Tb_apbdes::where(['kd_rekening'=>$m->kd_rekening,'th_anggaran'=>$th])->first();
                              ?>
                              @if($m->kd_induk==0)<b style="color:red;">@if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana,0,',','.')}}@endif</b>@else @if($m->tipe_akun==1)<b> @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana,0,',','.')}}@endif</b>@else @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana,0,',','.')}}@endif @endif @endif
                          </td>                          
                          <td style="text-align: right;">
                               @if($m->kd_induk==0)<b style="color:red;">@if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_realisasi,0,',','.')}}@endif</b>@else @if($m->tipe_akun==1)<b> @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_realisasi,0,',','.')}}@endif</b>@else @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_realisasi,0,',','.')}}@endif @endif @endif
                          </td>
                          <td style="text-align: right;">
                              @if($m->kd_induk==0)<b style="color:red;">@if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana-$pagu->pagu_realisasi,0,',','.')}}@endif</b>@else @if($m->tipe_akun==1)<b> @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana-$pagu->pagu_realisasi,0,',','.')}}@endif</b>@else @if(empty($pagu)){{'0'}}@else{{number_format($pagu->pagu_rencana-$pagu->pagu_realisasi,0,',','.')}}@endif @endif @endif
                          </td>
                      </tr>
                      @endforeach
                      @if($master->isEmpty())
                          <tr><td colspan="3"><center><p class="add">Tidak ada data yang ditemukan. <u><a href="#modal" class="modal-trigger">Tambah data baru</a></u></p></center></td></tr>
                      @endif
                  </tbody> 
                </table> 
            </div>
            <br>
          </div>
          <!-- End single blog -->

@endsection  