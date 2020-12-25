<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_user;
use App\Tb_galeri;
use App\Tb_berita;
use App\Tb_profildesa;
use App\Tb_master_apbdes;
use App\Tb_apbdes;
use App\Tb_rkp;
use App\Tb_aduan;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('login_admin')) {
        $data = array(
            'artikel' => Tb_berita::count(), 
            'galeri' => Tb_galeri::count(),
            'masuk' => Tb_aduan::count(),
            'desa' => Tb_profildesa::where('id', '1')->first()
        );
            return view('admin.index',$data);
        }else{
            if (!session('cari')) {
            # code...
                $artikel = Tb_berita::select('*', 'tb_berita.created_at as tgl')->orderBy('tgl','DESC')->join('tb_admin', 'tb_admin.kd_admin', '=', 'tb_berita.kd_admin')->join('tb_pegawai', 'tb_pegawai.kd_pegawai', '=', 'tb_admin.kd_pegawai')->paginate(12);
                return view('website.index',['artikel'=>$artikel]);
            }else{
                $artikel = Tb_berita::select('*', 'tb_berita.created_at as tgl')->orderBy('tgl','DESC')->join('tb_admin', 'tb_admin.kd_admin', '=', 'tb_berita.kd_admin')->join('tb_pegawai', 'tb_pegawai.kd_pegawai', '=', 'tb_admin.kd_pegawai')->where('judul','like','%'.session('cari').'%')->orwhere('isi','like','%'.session('cari').'%')->paginate(12);
                return view('website.cari',['artikel'=>$artikel]);
            }
            
            
        }
    }

    public function artikel($id)
    {
        # code...
        $artikel = Tb_berita::select('*', 'tb_berita.created_at as tgl')->join('tb_admin', 'tb_admin.kd_admin', '=', 'tb_berita.kd_admin')->join('tb_pegawai', 'tb_pegawai.kd_pegawai', '=', 'tb_admin.kd_pegawai')->where('id',$id)->first();       

        if (empty($artikel)) {
            # code...
             return view('website.artikel',['artikel'=>$artikel]);
        }else{   
             $jml_baca=$artikel->jml_baca+1;
                Tb_berita::where('id', $id)->update([
                    'jml_baca' => $jml_baca
                ]);    
            return view('website.artikel',['artikel'=>$artikel]);
        }
    }
    public function apbdes($id)
    {
        # code...
      $master=Tb_master_apbdes::get(); 
      return view('website.apbdes',['th'=>$id,'master'=>$master]);
    }
    public function realisasi($id)
    {
        # code...
      $master=Tb_master_apbdes::get(); 
      return view('website.realisasi',['th'=>$id,'master'=>$master]);
    }
    public function rkp($id)
    {
        # code...
      $master=Tb_rkp::join('tb_master_apbdes','tb_master_apbdes.kd_rekening','=','tb_rkp.kd_rekening')->join('tb_satuan','tb_satuan.kd_satuan','=','tb_rkp.kd_satuan')->where('th_anggaran',$id)->get(); 
      return view('website.rkp',['th'=>$id,'master'=>$master]);
    }

    public function rkp_detail($id)
    {
        # code...
      $master=Tb_rkp::join('tb_master_apbdes','tb_master_apbdes.kd_rekening','=','tb_rkp.kd_rekening')->join('tb_satuan','tb_satuan.kd_satuan','=','tb_rkp.kd_satuan')->where('kd_kegiatan',$id)->first(); 
      return view('website.rkp_detail',['master'=>$master]);
    }

    public function th(Request $request, $id)
    {
        # code...
        if ($request->kode=='realisasi') {
            # code...
            return redirect(url('/'.$request->tahun.'/realisasi'));
        }elseif ($request->kode=='apbdes'){

            return redirect(url('/'.$request->tahun.'/apbdes'));
        }else{
            return redirect(url('/'.$request->tahun.'/rkp'));
        }
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        session(['cari' => $request->cari]);
        return redirect(url('/'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
