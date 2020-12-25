<!doctype html>
<html lang="en">
<?php
use App\Tb_profildesa;
$profildesa = Tb_profildesa::where('id', '1')->first();
?>

<!-- Include Head START -->
<head>

    <title>Aplikasi Admin</title>

    <!-- Meta START -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    
    <!-- Meta END -->

    <!--[if lt IE 9]>
    <script src="../{{url('')}}/admin/js/html5shiv.min.js"></script>
    <![endif]-->

    <!-- Global style START -->
    <link type="text/css" rel="stylesheet" href="{{url('')}}/admin/css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="{{url('')}}/admin/css/jquery-ui.css">
    <link rel="stylesheet" href="{{url('')}}/admin/select2/dist/css/select2.min.css">
     <!-- Favicons -->
  	<link href="{{url('')}}/storage/@if(!empty($profildesa)){{$profildesa->logo}}@else{{'profil_desa/favicon.png'}}@endif" rel="icon">
    <style type="text/css">
        .avatar {
          vertical-align: middle;
          width: 50px;
          height: 50px;
          border-radius: 100%;
        }
        .avatar1 {
          vertical-align: middle;
          width: 30px;
          height: 30px;
          border-radius: 100%;
        }
        body {
            background: #fff;
        }
        .bg::before {
            content: '';
            background-image: url('{{url('')}}/admin/img/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: scroll;
            position: fixed;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0.10;
            filter:alpha(opacity=10);
        }
        #header-instansi {
            margin-top: 1%;
        }
        .ams {
            font-size: 1.8rem;
        }
        .grs {
            position: absolute;
            margin: 10px 0;
            background-color: #fff;
            height: 42px;
            width: 1px;
        }
        #menu {
            margin-left: 20px;
        }
        .title {
            background: #333;
            border-radius: 3px 3px 0 0;
            margin: -20px -20px 25px;
            padding: 20px;
        }
        .logo {
            border-radius: 50%;
            margin: 0 15px 15px 0;
            width: 90px;
            height: 90px;
        }
        .logoside {
            border-radius: 50%;
            margin: 0 auto;
            width: 125px;
            height: 125px;
        }
        .ins {
            font-size: 1.8rem;
        }
        .almt {
            font-size: 1.15rem;
        }
        .description {
            font-size: 1.4rem;
        }
        .jarak {
            height: 13.4rem;
        }
        .hidden {
            display: none;
        }
        .add {
            font-size: 1.45rem;
            padding: 0.1rem 0;
        }
        .jarak-card {
            margin-top: 1rem;
        }
        .jarak-filter {
            margin: -12px 0 5px;
        }
        #footer {
            background: #546e7a;
        }
        .warna {
            color: #444;
        }
        .agenda {
            font-size: 1.39rem;
            padding-left: 8px;
        }
        .hid {
            display: none;
        }
        .galeri {
            width: 100%;
            height: 26rem;
        }
        .gbr {
            float: right;
            width: 80%;
            height: auto;
        }
        .file {
            width: 70%;
            height: auto;
        }
        .kata {
            font-size: 1.04rem;
        }
        #alert-message {
            font-size: 0.9rem;
        }
        .notif {
            margin: -1rem 0!important;
        }
        .green-text, .red-text {
            font-weight: normal!important;
        }
        .lampiran {
            color: #444!important;
            font-weight: normal!important;
        }
        .waves-green {
            margin-bottom: -20px!important;
        }
        .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
        div.callout {
        	height: auto;
        	width: auto;
        	float: left;
        }
        div.callout {
        	position: relative;
        	padding: 13px;
        	border-radius: 3px;
        	margin: 25px;
        	min-height: 46px;
            top: -25px;
        }
        .callout::before {
        	content: "";
        	width: 0px;
        	height: 0px;
        	border: 0.8em solid transparent;
        	position: absolute;
        }
        .callout.bottom::before {
        	left: 25px;
        	top: -20px;
        	border-bottom: 10px solid #ffcdd2;
        }
        .round-in-box > input {
            color: inherit;
        }
        .round-in-box > input[type="search"] {
            background: rgba(244, 244, 244, 0.5);
            border-radius: 100px;
        }
        .dev {
            padding-left: 1rem;
        }
        .pace {
            -webkit-pointer-events: none;
            pointer-events: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            -webkit-transform: translate3d(0, -50px, 0);
            -ms-transform: translate3d(0, -50px, 0);
            transform: translate3d(0, -50px, 0);
            -webkit-transition: -webkit-transform .5s ease-out;
            -ms-transition: -webkit-transform .5s ease-out;
            transition: transform .5s ease-out;
        }
        .pace.pace-active {
            -webkit-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
        .pace .pace-progress {
            display: block;
            position: fixed;
            z-index: 2000;
            top: 0;
            right: 100%;
            width: 100%;
            height: 3px;
            background: #2196f3;
            pointer-events: none;
        }
        .footer-copyright {
            line-height: 2.25;
            padding: .75rem 0;
        }
        @media print{
            .side-nav,
            .secondary-nav,
            .jarak-form,
            .center,
            .hide-on-med-and-down,
            .dropdown-content,
            .button-collapse,
            .btn-large,
            .footer-copyright {
                display: none;
            }
            body {
                font-size: 12px;
                color: #212121;
            }
            .hid {
                display: block;
                font-size: 16px;
                text-transform: uppercase;
                margin-bottom: 0;
            }
            .add {
                font-size: 15px!important;
            }
            .agenda {
                font-size: 13px;
                text-align: center;
                color: #212121;
            }
            th, td{
                border: 1px solid #444 !important;
            }
            th{
                padding: 5px;
                display: table-cell;
                text-align: center;
                vertical-align: middle;
            }
            td{
                padding: 5px;
            }
            table {
              border-collapse: collapse;
              border-spacing: 0;
              font-size: 12px;
              color: #212121;
            }
            .container {
                margin-top: -20px !important;
            }
        }
        noscript{
            color: #fff;
        }
        @media only screen and (max-width: 701px) {
            #colres{
                width: 100%;
                overflow-x: scroll!important;
            }
            #tbl{
                width: 600px!important;
            }
        }
    </style>
    <!-- Global style END -->

</head>
<!-- Include Head END -->

<!-- Body START -->
<body class="bg">

<script src="{{url('')}}/admin/ckeditor/ckeditor.js"></script>

<!-- Header START -->
<header>

<!-- Include Navigation START -->
<nav class="blue-grey darken-1">
    <div class="nav-wrapper">
        <a href="{{url('/')}}" class="brand-logo center hide-on-large-only">@if(!empty($profildesa)){{$profildesa->nm_desa}}@else{{'Desa'}}@endif</a>
        <ul id="slide-out" class="side-nav" data-simplebar-direction="vertical">
            <li class="no-padding">
                <div class="logo-side center blue-grey darken-3">
                	<div class="circle center"><img class="logo" src="{{url('')}}/storage/@if(!empty($profildesa)){{$profildesa->logo}}@else{{'profil_desa/favicon.png'}}@endif"/></div>
                    <p class="description-side">@if(!empty($profildesa)){{$profildesa->alamat}}@else{{'Alamat belum di update'}}@endif</p>
                </div>
            </li>
            <li class="no-padding blue-grey darken-4">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header"><i class="material-icons">account_circle</i>{{session('nm_admin')}}</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{url('')}}/admin_profil">Profil</a></li>
                                <li><a href="{{url('')}}/logout" class="tombol-confirm">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li><a href="">Beranda</a></li> 
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header">Profil Desa</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{url('')}}/pengaturan/sejarah">Sejarah Desa</a></li>
                                <li><a href="{{url('')}}/pengaturan/profilwilayah">Profil Wilayah Desa</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header">Pemerintah Desa</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{url('')}}/pengaturan/visimisi">Visi dan Misi</a></li>
                                <li><a href="{{url('')}}/pengaturan/pemerintahdesa">Pemerintah Desa</a></li>
                                <li><a href="{{url('')}}/pengaturan/bpd">Badan Permusyawaratan Desa</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header">Kegiatan Pemerintah</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{url('')}}/apbdes">APBDes</a></li>
                                <li><a href="{{url('')}}/rkp">Rencana Kerja Pemerintah</a></li>
                                <li><a href="{{url('')}}/realisasi">Realisasi APBDes</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li><a href="{{url('')}}/adn">Aduan Masyarat</a></li> 
            @if(session('lvl_admin')=='1')
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header">Pengaturan</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{url('')}}/profildesa">Profil Desa</a></li>
                                <li><a href="{{url('')}}/jbt">Jabatan</a></li>
                                <li><a href="{{url('')}}/pgw">Pegawai</a></li>
                                <li><a href="{{url('')}}/prd">Masa Jabatan</a></li>
                                <li><a href="{{url('')}}/adm">Admin</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header">Master Data</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{url('')}}/stn">Master Satuan</a></li>
                                <li><a href="{{url('')}}/apbdes/master">Master APBDes</a></li>
                                <li><a href="{{url('')}}/masyarakat/aduan">Kelola User (Masyarakat)</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
        <!-- Menu on medium and small screen END -->

        <!-- Menu on large screen START -->
        <ul class="center hide-on-med-and-down" id="nv">
            <li><a href="{{url('/')}}" class="ams hide-on-med-and-down">@if(!empty($profildesa)){{$profildesa->nm_desa}}@else{{'Desa'}}@endif</a></li>
            <li><div class="grs"></></li>
            <li><a href="{{url('')}}">Beranda</a></li> 
            <li><a class="dropdown-button" href="#!" data-activates="profil">Profil Desa <i class="material-icons md-18">arrow_drop_down</i></a></li>
                <ul id='profil' class='dropdown-content'>
                    <li><a href="{{url('')}}/pengaturan/sejarah">Sejarah Desa</a></li>
                    <li><a href="{{url('')}}/pengaturan/profilwilayah">Profil Wilayah Desa</a></li>
                </ul>
            <li><a class="dropdown-button" href="#!" data-activates="pemerintah">Pemerintah Desa <i class="material-icons md-18">arrow_drop_down</i></a></li>
                <ul id='pemerintah' class='dropdown-content'>
                    <li><a href="{{url('')}}/pengaturan/visimisi">Visi dan Misi</a></li>
                    <li><a href="{{url('')}}/pengaturan/pemerintahdesa">Pemerintah Desa</a></li>
                    <li><a href="{{url('')}}/pengaturan/bpd">Badan Permusyawaratan Desa</a></li>
                </ul>
            <li><a class="dropdown-button" href="#!" data-activates="kegiatan">Kegiatan Pemerintah <i class="material-icons md-18">arrow_drop_down</i></a></li>
                <ul id='kegiatan' class='dropdown-content'>
                    <li><a href="{{url('')}}/apbdes">APBDes</a></li>
                    <li><a href="{{url('')}}/rkp">Rencana Kerja Pemerintah</a></li>
                    <li><a href="{{url('')}}/realisasi">Realisasi APBDes</a></li>
                </ul>
            <li><a href="{{url('')}}/adn">Aduan Masyarakat</a></li> 
            @if(session('lvl_admin')=='1')
            <li><a class="dropdown-button" href="#!" data-activates="pengaturan">Pengaturan <i class="material-icons md-18">arrow_drop_down</i></a></li>
                <ul id='pengaturan' class='dropdown-content'>
                    <li><a href="{{url('')}}/profildesa">Profil Desa</a></li>
                    <li><a href="{{url('')}}/jbt">Jabatan</a></li>
                    <li><a href="{{url('')}}/pgw">Pegawai</a></li>
                    <li><a href="{{url('')}}/prd">Masa Jabatan</a></li>
                    <li><a href="{{url('')}}/adm">Admin</a></li>
                </ul>
            </li>
            <li><a class="dropdown-button" href="#!" data-activates="master">Master Data <i class="material-icons md-18">arrow_drop_down</i></a></li>
                <ul id='master' class='dropdown-content'>
                    <li><a href="{{url('')}}/stn">Master Satuan</a></li>
                    <li><a href="{{url('')}}/apbdes/master">Master APBDes</a></li>
                    <li><a href="{{url('')}}/masyarakat/aduan">Kelola User (Masyarakat)</a></li>
                </ul>
            </li>
            @endif         
            <li class="right" style="margin-right: 10px;"><a class="dropdown-button" href="#!" data-activates="logout"><i class="material-icons">account_circle</i> {{session('nm_admin')}}<i class="material-icons md-18">arrow_drop_down</i></a></li>
                <ul id='logout' class='dropdown-content'>
                    <li><a href="{{url('')}}/admin_profil/profil">Profil</a></li>
                    <li class="divider"></li>
                    <li><a href="{{url('')}}/logout" class="tombol-confirm"><i class="material-icons">settings_power</i> Logout</a></li>
                </ul>
        </ul>
        <!-- Menu on large screen END -->
        <a href="#" data-activates="slide-out" class="button-collapse" id="menu"><i class="material-icons">menu</i></a>
    </div>
</nav>
<!-- Include Navigation END -->

</header>
<!-- Header END -->
@yield('content')
<noscript>
    <meta http-equiv="refresh" content="0;URL='./enable-javascript.html'" />
</noscript>

<!-- Footer START -->
<footer class="page-footer">
    <div class="container">
           <div class="row">
               <br/>
           </div>
    </div>
    <div class="footer-copyright blue-grey darken-1 white-text">
        <div class="container" id="footer">
           Muhammad <span class="white-text">Soleh</span>
        </div>
    </div>
</footer>
<!-- Footer END -->

<!-- Javascript START -->
<script type="text/javascript" src="{{url('')}}/admin/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="{{url('')}}/admin/js/materialize.min.js"></script>
<script type="text/javascript" src="{{url('')}}/admin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('')}}/admin/js/jquery.autocomplete.min.js"></script>
<script type="text/javascript" src="{{url('')}}/admin/js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="{{url('')}}/admin/js/myscript.js"></script>
<!-- page script -->
<script data-pace-options='{ "ajax": false }' src="{{url('')}}/admin/js/pace.min.js"></script>
<script src="{{url('')}}/admin/select2/dist/js/select2.min.js"></script>
<script src="{{url('')}}/admin/js/jquery.mask.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

    //jquery dropdown
    $(".dropdown-button").dropdown({ hover: false });

    //jquery sidenav on mobile
    $('.button-collapse').sideNav({
        menuWidth: 240,
        edge: 'left',
        closeOnClick: true
    });

    //jquery datepicker
    $('#tgl_lahir,#tgl_awal,#tgl_akhir').pickadate({
        selectMonths: true,
        selectYears: 10,
        format: "yyyy-mm-dd"
    });

    //jquery teaxtarea
    $('#isi_ringkas').val('');
    $('#isi_ringkas').trigger('autoresize');

    //jquery dropdown select dan tooltip
    $('select').material_select();
    $('.tooltipped').tooltip({delay: 10});

    //jquery autocomplete
    $( "#kode" ).autocomplete({
        serviceUrl: "kode.php",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            $( "#kode" ).val(suggestion.kode);
        }
    });

    //jquery untuk menampilkan pemberitahuan
    $("#alert-message").alert().delay(3000).fadeOut('slow');

    //jquery modal
    $('.modal-trigger').leanModal();
    // Format mata uang.
    $( '.uang' ).mask('0.000.000.000', {reverse: true});
 });
$(function () {
    $('.select2').select2();
  })

</script>
<!-- Javascript END -->
</body>
<!-- Body END -->

</html>