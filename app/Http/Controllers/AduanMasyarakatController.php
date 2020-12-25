<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_aduan;
use App\Tb_galeri;
use App\Tb_komentar;
use Storage;

class AduanMasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!session('cari')) {
            # code...
            if (session('filter')=='Semua Aduan'|| session('filter')=='Pencarian Aduan') {
                # code...
                session(['filter'=>'Semua Aduan']);  
                $berita= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->orderBy('baca','ASC')->orderBy('tgl','DESC')->paginate(session('no'));
                $total= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->join('tb_galeri','tb_aduan.kd_aduan','=','tb_galeri.kode')->count();
            }elseif (session('filter')=='Belum Dibaca') {
                # code...
                $berita= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->where('baca','1')->orderBy('baca','ASC')->orderBy('tgl','DESC')->paginate(session('no'));
                $total= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->where('baca','1')->count();
            }elseif (session('filter')=='Diterima') {
                # code...
                $berita= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->where('status','Diterima')->orwhere('status','Diajukan')->orderBy('baca','ASC')->orderBy('tgl','DESC')->paginate(session('no'));
                 $total= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->where('status','Diterima')->orwhere('status','Diajukan')->count();
            }else{
               $berita= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->where('status','Ditolak')->orderBy('baca','ASC')->orderBy('tgl','DESC')->paginate(session('no'));
               $total= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->where('status','Ditolak')->count();
            }
        }else{
            session(['filter'=>'Pencarian Aduan']);      
            $berita= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->where('kd_aduan','like','%'.session('cari').'%')->orwhere('judul','like','%'.session('cari').'%')->orwhere('isi','like','%'.session('cari').'%')->orwhere('nama_depan','like','%'.session('cari').'%')->orwhere('nama_belakang','like','%'.session('cari').'%')->orderBy('baca','ASC')->orderBy('tgl','DESC')->paginate(session('no'));
            $total= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->where('kd_aduan','like','%'.session('cari').'%')->orwhere('judul','like','%'.session('cari').'%')->orwhere('isi','like','%'.session('cari').'%')->orwhere('nama_depan','like','%'.session('cari').'%')->orwhere('nama_belakang','like','%'.session('cari').'%')->count();
        }
        $data = array('total' => $total,'berita'=>$berita,'no'=>session('no'),'filter'=>session('filter') );
        return view('admin.aduan',$data);
    }

    public function jbt(Request $request)
    {
        session(['no' => $request->jml]);
        return redirect(url('/aduan_masyarakat'));
    }
    public function filter(Request $request)
    {
        session(['filter' => $request->fill]);
        return redirect(url('/aduan_masyarakat'));
    }
    public function coba(Request $request)
    {
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }
        session(['no' => '10','filter'=>'Semua Aduan']);        
        return redirect(url('/aduan_masyarakat'));
    }

    public function cari(Request $request)
    {
        //
        if (!$request) {
            # code...
            $request->session()->forget('cari');
        }else{
            session(['cari' => $request->cari]);
        }
        return redirect(url('/aduan_masyarakat'));
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
       Tb_aduan::where('kd_aduan', $request->kd_aduan)->update([
                'status' =>$request->status,
        ]);
        $tb_komentar = new Tb_komentar;
        $tb_komentar->kd_komentar =date('ymdHis');
        $tb_komentar->kd_aduan = $request->kd_aduan;   
        $tb_komentar->kd_admin = session('kode_admin');   
        $tb_komentar->status = $request->status;
        $tb_komentar->komentar = $request->komentar;
        $tb_komentar->save();
        $request->session()->flash('berhasil', 'Aduan '.$request->status.'');
        return redirect(url('/aduan_masyarakat/'.$request->kd_aduan)); 
        
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
        $berita= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->join('tb_galeri','tb_aduan.kd_aduan','=','tb_galeri.kode')->where('kd_aduan',$id)->first();
        Tb_aduan::where('kd_aduan', $id)->update([
                'baca' =>'2',
        ]);
        $komentar= Tb_komentar::select('*', 'tb_komentar.created_at as tgl','tb_komentar.status as sts')->join('tb_aduan','tb_aduan.kd_aduan','=','tb_komentar.kd_aduan')->join('tb_admin','tb_admin.kd_admin','=','tb_komentar.kd_admin')->join('tb_pegawai','tb_pegawai.kd_pegawai','=','tb_admin.kd_pegawai')->where('tb_komentar.kd_aduan',$id)->get();
        $jumlah= Tb_komentar::select('*', 'Tb_komentar.created_at as tgl')->join('tb_aduan','tb_aduan.kd_aduan','=','tb_komentar.kd_aduan')->join('tb_admin','tb_admin.kd_admin','=','tb_komentar.kd_admin')->where('tb_komentar.kd_aduan',$id)->count();
        $data = array('berita'=>$berita,'komentar'=>$komentar,'jumlah'=>$jumlah);
        return view('admin.aduan_detail',$data);        
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
    public function update(Request $request)
    {
        //
        Tb_komentar::where('kd_komentar', $request->kd_komentar)->update([
                'komentar' =>$request->komentar_edit,
        ]);
        $request->session()->flash('berhasil', 'komentar berhasil diubah');
        return redirect(url('/aduan_masyarakat/'.$request->kd_aduan_edit)); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }
        if ($id=='hapus') {
            # code...
            Tb_komentar::where('kd_komentar',$request->kd_komentar_hapus)->delete();
            $request->session()->flash('berhasil', 'Komentar berhasil dihapus');
            return redirect(url('/aduan_masyarakat/'.$request->kd_aduan_hapus)); 
        }else{
            if ($request->gambar != 'foto_galeri/no_image_news.jpg') {
            Storage::delete($request->gambar);
            }
            Tb_galeri::where('kode',$id)->delete();
            Tb_komentar::where('kd_aduan',$id)->delete();
            Tb_aduan::where('kd_aduan',$id)->delete();
            $request->session()->flash('berhasil', 'Aduan berhasil dihapus');
            return redirect(url('/aduan_masyarakat')); 
        }
        
         
    }
}