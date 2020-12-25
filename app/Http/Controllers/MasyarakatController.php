<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_user;
use App\Tb_aduan;
use App\Tb_komentar;

class MasyarakatController extends Controller
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
            $user= Tb_user::paginate(session('no'));
        }else{
            $user= Tb_user::where('kd_user','like','%'.session('cari').'%')->orwhere('nama_depan','like','%'.session('cari').'%')->orwhere('nama_belakang','like','%'.session('cari').'%')->orwhere('email','like','%'.session('cari').'%')->orwhere('jns_kelamin','like','%'.session('cari').'%')->orwhere('tgl_lahir','like','%'.session('cari').'%')->orwhere('alamat','like','%'.session('cari').'%')->orwhere('no_telp','like','%'.session('cari').'%')->paginate(session('no'));
        }
        return view('admin.masyarakat',['user'=>$user,'no'=>session('no')]);
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
        return redirect(url('/masyarakat'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        if ($id=='aduan') {
            # code...
            if (session('cari')) {
            $request->session()->forget('cari'); 
            }
            session(['no' => '10']);        
            return redirect(url('/masyarakat'));
        }elseif ($id=='cari') {
            # code...
            $request->session()->forget('cari');
            return redirect(url('/masyarakat'));
        }else{

            $berita= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->where('tb_user.kd_user',$id)->paginate(session('no'));
            $total= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->where('tb_user.kd_user',$id)->count();
            $user= Tb_user::where('kd_user',$id)->first();
            if ($berita->isEmpty()) {
                # code...
                $berita= Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->join('tb_galeri','tb_aduan.kd_aduan','=','tb_galeri.kode')->where('kd_aduan',$id)->first();
                Tb_aduan::where('kd_aduan', $id)->update([
                        'baca' =>'2',
                ]);
                $komentar= Tb_komentar::select('*', 'tb_komentar.created_at as tgl','tb_komentar.status as sts')->join('tb_aduan','tb_aduan.kd_aduan','=','tb_komentar.kd_aduan')->join('tb_admin','tb_admin.kd_admin','=','tb_komentar.kd_admin')->join('tb_pegawai','tb_pegawai.kd_pegawai','=','tb_admin.kd_pegawai')->where('tb_komentar.kd_aduan',$id)->get();
                $jumlah= Tb_komentar::select('*', 'Tb_komentar.created_at as tgl')->join('tb_aduan','tb_aduan.kd_aduan','=','tb_komentar.kd_aduan')->join('tb_admin','tb_admin.kd_admin','=','tb_komentar.kd_admin')->where('tb_komentar.kd_aduan',$id)->count();
                $data = array('berita'=>$berita,'komentar'=>$komentar,'jumlah'=>$jumlah);
                return view('admin.aduan_detail_masyarakat',$data);      
            }else{
                $data = array('total' => $total,'berita'=>$berita,'no'=>session('no'),'user'=>$user);
                return view('admin.aduan_masyarakat',$data);
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
        if ($id=='page') {
            # code...
            session(['no' => $request->jml]);
            return redirect(url('/masyarakat'));
        }elseif ($id=='halaman') {
            # code...
            session(['no' => $request->jml]);
            return redirect(url('/masyarakat/'.$request->kd_user));
        }elseif ($id=='edit') {
            # code...
            Tb_komentar::where('kd_komentar', $request->kd_komentar)->update([
                'komentar' =>$request->komentar_edit,
            ]);
            $request->session()->flash('berhasil', 'komentar berhasil diubah');
        return redirect(url('/masyarakat/'.$request->kd_aduan_edit)); 
        }else{
            Tb_user::where('kd_user', $id)->update([
                'status_user' => $request->status
            ]);
            $request->session()->flash('berhasil', 'Status berhasil di ubah');
            return redirect(url('/masyarakat'));
        }
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

        $cek = Tb_aduan::where('kd_user',$id)->first();
        if (empty($cek)) {
            # code...
            $cek = Tb_user::where('kd_user',$id)->first();
            if (empty($cek)) {
                # code...
            }else{
                if ($cek->status_user=='2') {
                # code...
                    $request->session()->flash('gagal', 'Data gagal di hapus');
                }else{
                    Tb_user::where('kd_user',$id)->delete();
                    $request->session()->flash('berhasil', 'Data berhasil dihapus');
                }
            }
        }else{
            $request->session()->flash('gagal', 'Data gagal di hapus');
        }
        return redirect(url('/masyarakat'));
    }
}
