<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', 'WebsiteController');
Route::get('/beranda', 'WebsiteController@store');
Route::get('/{id}/apbdes', 'WebsiteController@apbdes');
Route::get('/{id}/realisasi', 'WebsiteController@realisasi');
Route::post('/{id}/realisasi', 'WebsiteController@th');
Route::get('/{id}/rkp', 'WebsiteController@rkp');
Route::get('/{id}/rkp/detail', 'WebsiteController@rkp_detail');
Route::post('/{id}/rkp', 'WebsiteController@th');
Route::post('/{id}/apbdes', 'WebsiteController@th');
Route::get('/artikel/{id}', 'WebsiteController@artikel');
Route::get('/logout', 'LoginController@logout');
Route::resource('/profildesa', 'ProfilDesaController');
Route::resource('/aduan', 'AduanController');
Route::resource('/pelapor', 'PelaporController');
Route::group(['middleware'=>'CekLoginMiddleware'],function()
{
	# code...
	//login
	Route::get('/login', 'LoginController@index');
	Route::post('/login', 'LoginController@store');

	//lupa pasword
	Route::resource('/lupa_password', 'LupaPasswordController');
	Route::post('/lupa_password/{id}', 'LupaPasswordController@email');

	//registrasi
	Route::resource('/registrasi', 'RegistrasiController');
	
	Route::get('/aktifasi', 'RegistrasiController@create');
	Route::post('/aktifasi', 'RegistrasiController@cek_email');
});
Route::group(['middleware'=>'CekSessionMiddleware'],function()
{
	Route::resource('/profil', 'ProfilController');

	Route::post('/ubah/profil', 'ProfilController@profil');
	Route::post('/ubah/password', 'ProfilController@password');
	Route::post('/ubah/foto', 'ProfilController@foto');
});
Route::group(['middleware'=>'CekAdminMiddleware'],function()
{
	Route::group(['middleware'=>'CekLvlAdminMiddleware'],function()
	{
		Route::resource('/aduan_masyarakat', 'AduanMasyarakatController');
		Route::get('/adn', 'AduanMasyarakatController@coba');
		Route::post('/filter', 'AduanMasyarakatController@filter');
		Route::post('/adn', 'AduanMasyarakatController@jbt');	
		Route::post('/cariadn', 'AduanMasyarakatController@cari');
		Route::get('/cariadn', 'AduanMasyarakatController@cari');

		Route::resource('/berita', 'ArtikelController');
		Route::get('/brt', 'ArtikelController@coba');
		Route::post('/brt', 'ArtikelController@jbt');	
		Route::post('/caribrt', 'ArtikelController@cari');
		Route::get('/caribrt', 'ArtikelController@cari');

		Route::resource('/satuan', 'SatuanController');
		Route::get('/stn', 'SatuanController@coba');
		Route::post('/stn', 'SatuanController@stn');	
		Route::post('/caristn', 'SatuanController@cari');
		Route::get('/caristn', 'SatuanController@cari');
		
		Route::resource('/rkp', 'RkpController');
		Route::post('/rkp/tambah', 'RkpController@create');
		Route::post('/rkp/simpan', 'RkpController@simpan');
		Route::get('/rkp/tambah/{th}/{kd_rekening}', 'RkpController@tambah');
		Route::get('/{id}/rkp/edit', 'RkpController@edit');
		Route::post('/{id}/rkp_tambah', 'RkpController@tambahfoto');
		Route::post('/rkp/{kd_kegiatan}/{kode}/{id}', 'RkpController@hapusfoto');

		Route::resource('/rab', 'RabController');

		Route::resource('/pengaturan', 'PengaturanController');

		Route::resource('/masyarakat', 'MasyarakatController');

		Route::post('/apbdes/apbdes', 'ApbdesController@update');
		Route::get('/apbdes/{th}/{kd_induk}', 'ApbdesController@updatepagu');
		Route::post('/apbdes/master', 'ApbdesController@master');
		Route::post('/apbdes/mastersub', 'ApbdesController@mastersub');
		Route::post('/apbdes/master/{id}', 'ApbdesController@masterhapus');
		Route::post('/apbdes/editmaster', 'ApbdesController@masterupdate');
		Route::post('/apbdes/masteredit', 'ApbdesController@updatemaster');
		Route::resource('/apbdes', 'ApbdesController');
		Route::post('/realisasi/apbdes', 'ApbdesController@update');
		Route::get('/realisasi/{th}/{kd_induk}', 'ApbdesController@updatepagu');	

		Route::resource('/realisasi', 'RealisasiController');
		Route::resource('/referensi', 'ReferensiController');

		Route::get('/jbt', 'JabatanController@coba');
		Route::post('/jbt', 'JabatanController@jbt');	
		Route::post('/cari', 'JabatanController@cari');
		Route::get('/cari', 'JabatanController@cari');
		Route::resource('/jabatan', 'JabatanController');

		Route::resource('/pegawai', 'PegawaiController');
		Route::get('/pgw', 'PegawaiController@pgw');
		Route::post('/pgwcari', 'PegawaiController@cari');
		Route::get('/pgwcari', 'PegawaiController@cari');

		Route::resource('/admin_profil', 'AdminProfilController');

		Route::resource('/periode', 'MasaPeriodeController');
		Route::get('/prd', 'MasaPeriodeController@prd');
		Route::post('/prdcari', 'MasaPeriodeController@cari');
		Route::get('/prdcari', 'MasaPeriodeController@cari');

		Route::resource('/pegawai_periode', 'PegawaiPeriodeController');
		
		Route::get('/adm', 'AdminController@adm');
		Route::post('/admcari', 'AdminController@cari');
		Route::get('/admcari', 'AdminController@cari');
		Route::resource('/admin_data', 'AdminController');

		Route::resource('/galeri', 'GaleriController');
		Route::get('/glr', 'GaleriController@coba');
		Route::post('/glr', 'GaleriController@jbt');	
		Route::post('/cariglr', 'GaleriController@cari');
		Route::get('/cariglr', 'GaleriController@cari');
	});
});
