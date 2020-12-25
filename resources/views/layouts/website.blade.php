<?php
use App\Tb_profildesa;
$profildesa = Tb_profildesa::where('id', '1')->first();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Website Desa Jeruksari</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{url('')}}/storage/@if(!empty($profildesa)){{$profildesa->logo}}@else{{'profil_desa/favicon.png'}}@endif" rel="icon">
  <link href="{{url('')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="{{url('')}}/admin/select2/dist/css/select2.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{url('')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendor/nivo-slider/css/nivo-slider.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendor/owl.carousel{{url('')}}/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{url('')}}/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eBusiness - v2.1.1
  * Template URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== --> 
  <style>
    .avatar {
      vertical-align: middle;
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }
    .avatar1 {
          vertical-align: middle;
          width: 30px;
          height: 30px;
          border-radius: 100%;
        }
  </style>
</head>

<body data-spy="scroll" data-target="#navbar-example">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="{{url('')}}"><span>@if(!empty($profildesa)){{$profildesa->nm_desa}}@else{{'Desa'}}@endif</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="{{url('')}}/assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active">
            <a href="{{url('')}}/beranda">Beranda</a>
          </li>
          <li class="drop-down"><a href="#">Profil Desa</a>
            <ul>
              <li><a href="{{url('')}}/artikel/1">Sejarah Desa</a></li>
              <li><a href="{{url('')}}/artikel/2">Profil Wilayah Desa</a></li>
            </ul>
          </li>
          <li class="drop-down"><a href="">Pemerintah Desa</a>
            <ul>
              <li><a href="{{url('')}}/artikel/3">Visi dan Misi</a></li>
              <li><a href="{{url('')}}/artikel/4">Pemerintah Desa</a></li>
              <li><a href="{{url('')}}/artikel/5">Badan Permusyawaratan Desa</a></li>
            </ul>
          </li>
          <li class="drop-down"><a href="">Kegiatan Pemerintah</a>
            <ul>
              <li><a href="{{url('')}}/{{date('Y')}}/apbdes">APBDes</a></li>
              <li><a href="{{url('')}}/{{date('Y')}}/rkp">Rencana Kerja Pemerintah</a></li>
              <li><a href="{{url('')}}/{{date('Y')}}/realisasi">Realisasi APBDes</a></li>
            </ul>
          </li>
          <li><a href="{{url('')}}/aduan">Aduan Masyarakat</a></li>
          @if(session('berhasil_login'))
          <li class="drop-down"><a href="">Pengaturan</a>
            <ul>
              <li><a href="{{url('')}}/profil/1">Profil</a></li>
              <li><a href="{{url('')}}/logout">Logout</a></li>          
            </ul>
          </li>   
          @elseif(session('login_admin'))       
          @else
          <li><a href="{{url('')}}/login">login</a></li>
          @endif
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
@yield('content')

          <!-- Startikel right sidebar -->
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="page-head-blog">
              <div class="single-blog-page">
                <!-- search option startikel -->
                <form method="post" action="{{url('')}}/">
                  @csrf
                  <div class="search-option">
                    <input type="text" placeholder="Cari Berita..." name="cari" id="cari">
                    <button class="button" type="submit">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </form>
                <!-- search option end -->
              </div>
              <?php
              $jml = App\Tb_berita::orderBy('jml_baca','DESC')->limit(4)->get();
        
              ?>
              <div class="single-blog-page">
                <!-- recent startikel -->
                <div class="left-blog">
                  <h4>Berita Populer</h4>
                  <div class="recent-post">
                    <!-- startikel single post -->
                    @foreach ($jml as $j)
                    <div class="recent-single-post">
                      <div class="post-img">
                        <a href="{{url('')}}/artikel/{{$j->id}}">
                          <img src="{{url('')}}/storage/{{$j->foto_berita}}" alt="">
                        </a>
                      </div>
                      <div class="pst-content">
                        <p><a href="{{url('')}}/artikel/{{$j->id}}"> {{$j->judul}}</a></p>
                      </div>
                    </div>
                    @endforeach
                    @if($jml->isEmpty())
                    <div class="recent-single-post">
                      <p style="text-align: center;">Tidak ada aduan</p>
                    </div>
                    @endif
                    <!-- End single post -->                    
                  </div>
                </div>
                <!-- recent end -->
              </div>
              <?php
              $jml = App\Tb_aduan::join('tb_galeri','tb_aduan.kd_aduan','=','tb_galeri.kode')->orderBy('jml_baca','DESC')->limit(4)->get();
        
              ?>
              <div class="single-blog-page">
                <!-- recent startikel -->
                <div class="left-blog">
                  <h4>Aduan Masyarakat Populer</h4>
                  <div class="recent-post">
                    <!-- startikel single post -->
                    @foreach ($jml as $j)
                    <div class="recent-single-post">
                      <div class="post-img">
                        <a href="{{url('')}}/aduan/{{$j->kd_aduan}}">
                          <img src="{{url('')}}/storage/{{$j->gambar}}" alt="">
                        </a>
                      </div>
                      <div class="pst-content">
                        <p><a href="{{url('')}}/aduan/{{$j->kd_aduan}}"> {{$j->judul}}</a></p>
                      </div>
                    </div>
                    @endforeach
                    @if($jml->isEmpty())
                    <div class="recent-single-post">
                      <p style="text-align: center;">Tidak ada aduan</p>
                    </div>
                    @endif
                    <!-- End single post -->                    
                  </div>
                </div>
                <!-- recent end -->
              </div>
            </div>
          </div>
          <!-- End right sidebar -->
        </div>
      </div>
    </div><!-- End Blog Page -->

  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer>
    <div class="footer-area">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="footer-content">
              <div class="footer-head">
                <h4>INFORMASI</h4>
                <p>
                  @if($profildesa){{$profildesa->nm_desa}}@else{{'Desa Wisata'}}@endif
                </p>
                <div class="footer-contacts">
                  <p><span>Alamat    :</span> @if($profildesa){{$profildesa->alamat}}@endif</p>
                  <p><span>Kode Pos  :</span> @if($profildesa){{$profildesa->kd_pos}}@endif</p>
                  <p><span>Hari Kerja:</span> @if($profildesa){{$profildesa->hr_krj}}@endif</p>
                  <p><span>Jam Kerja :</span> @if($profildesa){{$profildesa->jm_krj}}@endif</p>
                </div>
              </div>
            </div>
          </div>
          <!-- end single footer -->
          <!-- Start Google Map -->
            <div class="col-md-6 col-sm-6 col-xs-12">              
              <?php if ($profildesa) {
                echo $profildesa->peta;
              } ?>
            </div>
            <!-- End Google Map -->
        </div>
      </div>
    </div>
    <div class="footer-area-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="copyright text-center">
              <p>
                &copy; Copyright <strong>Muhammad Soleh</strong>. All Rights Reserved
              </p>
            </div>
            <div class="credits">
              <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=eBusiness
            -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{url('')}}/assets/vendor/jquery/jquery.min.js"></script>
  <script src="{{url('')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{url('')}}/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="{{url('')}}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{url('')}}/assets/vendor/appear/jquery.appear.js"></script>
  <script src="{{url('')}}/assets/vendor/knob/jquery.knob.js"></script>
  <script src="{{url('')}}/assets/vendor/parallax/parallax.js"></script>
  <script src="{{url('')}}/assets/vendor/wow/wow.min.js"></script>
  <script src="{{url('')}}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{url('')}}/assets/vendor/nivo-slider/js/jquery.nivo.slider.js"></script>
  <script src="{{url('')}}/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="{{url('')}}/assets/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{url('')}}/assets/js/main.js"></script>
  <script src="{{url('')}}/admin/select2/dist/js/select2.full.min.js"></script>
  <script type="text/javascript">
    $("#alert-message").alert().delay(3000).fadeOut('slow');
    $(function () {
      $('.select2').select2()
    
    })
  </script>
</body>

</html>