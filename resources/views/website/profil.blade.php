@extends('layouts.website')

@section('content')

  <main id="main">
   <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Profil Pengguna</h2>
              </div>
            </div>       
         
            <!-- End Left contact -->            
            <div class="col-md-2 col-sm-2 col-xs-12">
              <div class="single-awesome-project">
                <div class="awesome-img">
                  <a href="#"><img src="{{url('')}}/storage/{{$user->foto_profil}}" alt="" /></a>
                  <div class="add-actions text-center">
                    <div class="project-dec">
                      <a class="venobox" data-gall="myGallery" href="{{url('')}}/storage/{{$user->foto_profil}}">
                        <h4>{{$user->nama_depan}} {{$user->nama_belakang}}</h4>
                        <span>Pengguna Aplikasi</span>
                      </a>
                    </div>
                  </div>
                  <div class="team-content text-center">
                    <h4>{{$user->nama_depan}} {{$user->nama_belakang}}</h4>
                    <p>Pengguna Aplikasi</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End column -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              @if(session('berhasil'))
                <div class="alert alert-success alert-block" id="alert-message">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ session('berhasil') }}</strong>
                </div>
              @endif 
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link @if(session('ubah')=='profil'){{'active'}}@endif" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ubah Profil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link @if(session('ubah')=='foto'){{'active'}}@endif" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ubah Foto</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link @if(session('ubah')=='password'){{'active'}}@endif" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Ubah Password</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade @if(session('ubah')=='profil'){{'show active'}}@endif" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="form contact-form">
                      <form action="{{url('')}}/ubah/profil" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label>Nama Depan</label>
                              <input type="text" class="form-control @error('nama_depan') is-invalid @enderror" name="nama_depan" id="nama_depan" placeholder="Nama Depan" value="{{$user->nama_depan}}" />
                              @error('nama_depan')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>  
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label>Nama Belakang</label>
                              <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" name="nama_belakang" id="nama_belakang" placeholder="Nama Belakang" value="{{$user->nama_belakang}}"/>                        
                              @error('nama_belakang')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror                        
                            </div>
                          </div>  
                        </div> 
                        <div class="form-group">
                          <label>Email</label>
                          <input type="text" class="form-control @error('email') is-invalid @enderror @if(session('email')){{'is-invalid'}}@endif" name="email" id="email" placeholder="Email" value="{{$user->email}}"/>
                          @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                          @if(session('email'))
                                  <div class="invalid-feedback">{{ session('email') }}</div>
                          @endif
                        </div>
                        <div class="form-group">
                          <label>Alamat</label>
                          <textarea class="form-control  @error('alamat') is-invalid @enderror" name="alamat" rows="5" placeholder="Alamat">{{$user->alamat}}</textarea>
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
                                  <option value="{{$i2}}" @if ($i == date('d',strtotime($user->tgl_lahir))) selected @endif>{{ $i2 }}</option>
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
                                  <option value="{{$i2}}" @if ($i == date('m',strtotime($user->tgl_lahir))) selected @endif>{{ $bulan[$i] }}</option>
                                @endfor
                              </select>
                            </div>
                          </div>  
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                              <select name="thn_lahir" id="thn_lahir" class="select2 form-control @if(session('umur')){{'is-invalid'}}@endif" >
                                <option value="0">Tahun</option>                          
                                @for ($i = date('Y'); $i >= 1900; $i--)
                                  <option value="{{$i}}" @if ($i == date('Y',strtotime($user->tgl_lahir))) selected @endif>{{ $i }}</option>
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
                          <input type="radio" name="jenis_kelamin" value="l" @if($user->jns_kelamin == "l") checked @endif> <label class="@error('jenis_kelamin') is-invalid @enderror">Laki - Laki</label>                     
                          <input type="radio" name="jenis_kelamin" value="p" @if($user->jns_kelamin == "p") checked @endif> <label class="@error('jenis_kelamin') is-invalid @enderror">Perempuan</label> 
                          @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror                     
                        </div>                  
                        <div class="form-group">
                          <label>No Telpon</label>
                          <input type="text" class="form-control @error('no_telpon') is-invalid @enderror" name="no_telpon" id="no_telpon" placeholder="No Telpon" value="{{$user->no_telp}}" />
                          @error('no_telpon')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror  
                        </div> 
                        <div class="text-center">   
                          <button type="submit" class="ready-btn btn-success">Ubah</button>
                        </div>
                      </form>
                    </div>
                </div>
                <div class="tab-pane fade @if(session('ubah')=='foto'){{'show active'}}@endif" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                   <div class="form contact-form">
                      <form action="{{url('')}}/ubah/foto" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                              <label>Foto Profil</label>
                              <input type="hidden" name="foto_lama" id="foto_lama" value="{{$user->foto_profil}}">
                              <input type="file" class="form-control @error('foto_profil') is-invalid @enderror" name="foto_profil" id="foto_profil" onchange="previewImage();" />
                              @error('foto_profil')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror 
                            </div>
                          </div>  
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                              <div class="single-awesome-project">
                              <div class="awesome-img">
                                <img src="{{url('')}}/storage/{{$user->foto_profil}}" alt="" id="image-preview" height="128" />
                              </div>
                            </div>
                            </div>
                          </div>  
                        </div>
                        <div class="text-center">   
                          <button type="submit" class="ready-btn btn-success">Ubah</button>
                        </div>
                      </form>
                    </div>
                </div>
                <div class="tab-pane fade @if(session('ubah')=='password'){{'show active'}}@endif" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="form contact-form">
                      <form action="{{url('')}}/ubah/password" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label>Password Lama</label>
                          <input type="password" class="form-control @error('password_lama') is-invalid @enderror" name="password_lama" id="password_lama" placeholder="Kata Sandi Lama" value="{{old('password_lama')}}"/>
                          <input id="password_" type="hidden" name="password_" value="{{Crypt::decryptString($user->password)}}">
                          @error('password_lama')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Password Baru</label>
                          <input type="password" class="form-control @error('password_baru') is-invalid @enderror" name="password_baru" id="password_baru" placeholder="Kata Sandi Baru" value="{{old('password_baru')}}"/>
                          @error('password_baru')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Konfirmasi Password Baru</label>
                          <input type="password" class="form-control @error('konfirmasi_password_baru') is-invalid @enderror" name="konfirmasi_password_baru" id="konfirmasi_password_baru" placeholder="Konfirmasi Kata Sandi Baru" value="{{old('konfirmasi_password_baru')}}"/>
                          @error('konfirmasi_password_baru')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="text-center">   
                          <button type="submit" class="ready-btn btn-success">Ubah</button>
                        </div>
                      </form>
                    </div>
                </div>
              </div>
            </div>

@endsection  
<script>
  function previewImage() {
    document.getElementById("image-preview").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("foto_profil").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    };
  };
</script>