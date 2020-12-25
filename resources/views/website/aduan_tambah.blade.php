@extends('layouts.website')

@section('content')

  <main id="main">
   <!-- ======= Blog Page ======= -->
    <div class="blog-page area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Lapor Aduan</h2>
              </div>
          </div>          
          <!-- Start  contact -->
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="form contact-form">
                <form action="{{url('')}}/aduan" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" placeholder="Judul Aduan" value="{{old('judul')}}" />
                   @error('judul')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>                  
                  <div class="form-group">
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" placeholder="RT / RW / Dusun" value="{{old('lokasi')}}"/>
                    @error('lokasi')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(session('lokasi'))
                            <div class="invalid-feedback">{{ session('lokasi') }}</div>
                    @endif
                  </div>
                  <div class="form-group">
                    <textarea class="form-control  @error('isi') is-invalid @enderror" name="isi" rows="5" placeholder="Tuliskan Aduan Anda">{{old('isi')}}</textarea>
                    @error('isi')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div> 
                  <label>Foto Lokasi</label>
                  <div class="form-group">
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" id="gambar" value="{{old('gambar')}}" />
                    @error('gambar')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>                 
                  <div class="text-center">   
                    <a class="ready-btn btn-danger" href="/aduan">Batal</a>                 
                    <button type="submit" class="ready-btn btn-primary">Tambah</button>
                  </div>
                  </form>
                </div>

</div>
            <!-- End Left contact -->
@endsection 