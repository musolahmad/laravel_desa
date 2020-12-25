<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_aduan;
use App\Tb_user;
use App\Tb_rkp;
use App\Tb_komentar;
use App\Tb_galeri;
use App\Tb_berita;

class AduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $artikel = Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->join('tb_galeri','tb_aduan.kd_aduan','=','tb_galeri.kode')->where('status','!=','Masuk')->orderBy('tb_aduan.created_at','DESC')->paginate(12);
        return view('website.aduan',['artikel'=>$artikel]);
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
        $this->validate($request, [
            'judul'=>'required|max:50',
            'lokasi'=>'required',
            'isi'=>'required',
            'gambar'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
        ]);
        $kd_aduan=date('ymdHis');
        $tb_aduan = new Tb_aduan;
        $tb_aduan->kd_aduan =$kd_aduan;
        $tb_aduan->kd_user = session('kode_user');
        $tb_aduan->judul = $request->judul;   
        $tb_aduan->lokasi = $request->lokasi;
        $tb_aduan->isi = $request->isi;
        $tb_aduan->baca = '1';
        $tb_aduan->status = 'Masuk';
        $tb_aduan->jml_baca = '0';
        $tb_aduan->save();

        $foto_galeri = $request->file('gambar')->store('foto_galeri');
        $tb_galeri = new Tb_galeri;
        $tb_galeri->kode = $kd_aduan;   
        $tb_galeri->gambar = $foto_galeri;
        $tb_galeri->save();

        $request->session()->flash('berhasil', 'Aduan berhasil ditambahkan');
        return redirect(url('/aduan'));    
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
        if ($id=='tambah') {
            # code...
             if(session('berhasil_login')) {
                 # code...
                return view('website.aduan_tambah');
             }else{
                return redirect('/aduan');
             }
        }else{
            $artikel =Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->join('tb_galeri','tb_aduan.kd_aduan','=','tb_galeri.kode')->where('kd_aduan',$id)->where('status','!=','Masuk')->first(); 
            $komentar= Tb_komentar::select('*', 'tb_komentar.created_at as tgl','tb_komentar.status as sts')->join('tb_aduan','tb_aduan.kd_aduan','=','tb_komentar.kd_aduan')->join('tb_admin','tb_admin.kd_admin','=','tb_komentar.kd_admin')->join('tb_pegawai','tb_pegawai.kd_pegawai','=','tb_admin.kd_pegawai')->where('tb_komentar.kd_aduan',$id)->get(); 
            $jumlah= Tb_komentar::select('*', 'tb_komentar.created_at as tgl')->join('tb_aduan','tb_aduan.kd_aduan','=','tb_komentar.kd_aduan')->join('tb_admin','tb_admin.kd_admin','=','tb_komentar.kd_admin')->where('tb_komentar.kd_aduan',$id)->count();    
            $rkp = Tb_rkp::select('*', 'tb_rkp.created_at as tgl')->join('tb_referensi','tb_referensi.kd_kegiatan','=','tb_rkp.kd_kegiatan')->join('tb_master_apbdes','tb_master_apbdes.kd_rekening','=','tb_rkp.kd_rekening')->where('tb_referensi.kd_aduan',$id)->first(); 
            $data = array('artikel'=>$artikel,'komentar'=>$komentar,'jumlah'=>$jumlah,'rkp'=>$rkp);

            if (empty($artikel)) {
                # code...
                 return view('website.aduan_detail',$data);
            }else{   
                 $jml_baca=$artikel->jml_baca+1;
                    Tb_aduan::where('kd_aduan', $id)->update([
                        'jml_baca' => $jml_baca
                    ]);    
                return view('website.aduan_detail',$data);
            }
        }
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
