@extends('layouts.website')

@section('content')

  <main id="main">
   <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Registrasi</h2>
              </div>
          </div>          
          <!-- Start  contact -->
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="form contact-form">
                <form action="{{url('')}}/registrasi" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <input type="text" class="form-control @error('nama_depan') is-invalid @enderror" name="nama_depan" id="nama_depan" placeholder="Nama Depan" value="{{old('nama_depan')}}" />
                        @error('nama_depan')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>  
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" name="nama_belakang" id="nama_belakang" placeholder="Nama Belakang" value="{{old('nama_belakang')}}"/>                        
                        @error('nama_belakang')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror                        
                      </div>
                    </div>  
                  </div> 
                  <div class="form-group">
                    <input type="text" class="form-control @error('email') is-invalid @enderror @if(session('email')){{'is-invalid'}}@endif" name="email" id="email" placeholder="Email" value="{{old('email')}}"/>
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(session('email'))
                            <div class="invalid-feedback">{{ session('email') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control @error('password_baru') is-invalid @enderror" name="password_baru" id="password_baru" placeholder="Kata sandi" value="{{old('password_baru')}}"/>
                    @error('password_baru')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <textarea class="form-control  @error('alamat') is-invalid @enderror" name="alamat" rows="5" placeholder="Alamat">{{old('alamat')}}</textarea>
                    @error('alamat')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <label>Tanggal Lahir</label>                      
                    </div>  
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <select name="tgl_lahir" id="tgl_lahir" class="select2 form-control @if(session('tgl_lahir')){{'is-invalid'}}@endif" >
                            <option value="0">Tanggal</option>
                          @for ($i = 1; $i <= 31; $i++) <?php if ($i <=9 ) {$i2="0$i";}else{$i2="$i";}?>                           
                            <option value="{{$i2}}" @if ($i == date("j")) selected @endif>{{ $i2 }}</option>
                          @endfor
                        </select>
                        @if(session('tgl_lahir'))
                            <div class="invalid-feedback">{{ session('tgl_lahir') }}</div>
                        @endif                        
                      </div>
                    </div>  
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <?php $bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");?>                          
                        <select name="bln_lahir" id="bln_lahir" class="select2 form-control" >
                          <option value="0">Bulan</option>                                                
                          @for ($i = 1; $i <= 12; $i++) <?php if ($i <=9 ) {$i2="0$i";}else{$i2="$i";}?>
                            <option value="{{$i2}}" @if ($i == date("m")) selected @endif>{{ $bulan[$i] }}</option>
                          @endfor
                        </select>
                      </div>
                    </div>  
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <select name="thn_lahir" id="thn_lahir" class="select2 form-control @if(session('umur')){{'is-invalid'}}@endif" >
                          <option value="0">Tahun</option>                          
                          @for ($i = date('Y'); $i >= 1900; $i--)
                            <option value="{{$i}}" @if ($i == date("Y")) selected @endif>{{ $i }}</option>
                          @endfor
                        </select>
                        @if(session('umur'))
                            <div class="invalid-feedback">{{ session('umur') }}</div>
                        @endif
                      </div>
                    </div>  
                  </div> 
                  <label>Jenis Kelamin</label>
                  <div class="form-group">
                    <input type="radio" name="jenis_kelamin" value="l" @if(old('jenis_kelamin') == "l") checked @endif> <label class="@error('jenis_kelamin') is-invalid @enderror">Laki - Laki</label>                     
                    <input type="radio" name="jenis_kelamin" value="p" @if(old('jenis_kelamin') == "p") checked @endif> <label class="@error('jenis_kelamin') is-invalid @enderror">Perempuan</label> 
                    @error('jenis_kelamin')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror                     
                  </div>                  
                  <div class="form-group">
                    <input type="text" class="form-control @error('no_telpon') is-invalid @enderror" name="no_telpon" id="no_telpon" placeholder="No Telpon" value="{{old('no_telpon')}}" />
                    @error('no_telpon')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror  
                  </div> 
                  <div class="text-center">   
                    <a class="ready-btn btn-danger" href="/">Batal</a>                 
                    <button type="submit" class="ready-btn btn-primary">Daftar</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- End Left contact -->
@endsection 