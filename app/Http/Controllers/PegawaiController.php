<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_jabatan;
use App\Tb_pegawai;
use App\Tb_admin;

class PegawaiController extends Controller
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
            $pegawai= Tb_pegawai::where('kd_pegawai','!=','ADM001')->paginate(session('no'));
        }else{
            $pegawai= Tb_pegawai::where('kd_pegawai','like','%'.session('cari').'%')->orwhere('nm_pegawai','like','%'.session('cari').'%')->orwhere('alamat','like','%'.session('cari').'%')->orwhere('tgl_lahir','like','%'.session('cari').'%')->orwhere('jns_kelamin','like','%'.session('cari').'%')->paginate(session('no'));
        }
        return view('admin.pegawai',['pegawai'=>$pegawai,'no'=>session('no')]);
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

    public function cari(Request $request)
    {
        //
        if (!$request) {
            # code...
            $request->session()->forget('cari');
        }else{
            session(['cari' => $request->cari]);
        }
        return redirect(url('/pegawai'));
    }

    public function pgw(Request $request)
    {
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }
        session(['no' => '10']);        
        return redirect(url('/pegawai'));
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
        $request->validate([
            'nip_atau_nik'=>'required|max:30',
            'nama_pegawai'=>'required|max:30',
            'tgl_lahir'=>'required',
            'alamat'=>'required',
            'jenis_kelamin'=>'required',
        ]);
        $pegawai=Tb_pegawai::where('nip_nik',$request->nip_atau_nik)->first();
        if ($pegawai) {
            # code...
            $request->validate([
            'nip_atau_nik'=>'same:'.$pegawai,
            ],['nip_atau_nik.same'=>'nip atau nik sudah ada ']);
        }else{
            $no=Tb_pegawai::orderBy('kd_pegawai', 'DESC')->first();
                if (empty($no)) {
                    # code...
                    $kd_pegawai="PGW001";
                }else{

                    $nilai = substr($no['kd_pegawai'], 3)+1;

                    if ($nilai<10) {
                      # code...
                      $kd_pegawai="PGW00".$nilai;
                    }elseif ($nilai<100) {
                    
                      $kd_pegawai="PGW0".$nilai;
                    }else{
                      $kd_pegawai="PGW".$nilai;
                    }
                }
            if (empty($request->foto_admin)) {
                    # code...
                    $foto_admin='foto_admin/1.jpg';
                    $tb_pegawai = new Tb_pegawai;
                    $tb_pegawai->kd_pegawai =$kd_pegawai;
                    $tb_pegawai->nip_nik = $request->nip_atau_nik;   
                    $tb_pegawai->nm_pegawai = $request->nama_pegawai;
                    $tb_pegawai->tgl_lahir = $request->tgl_lahir;
                    $tb_pegawai->alamat = $request->alamat;
                    $tb_pegawai->jns_kelamin = $request->jenis_kelamin;
                    $tb_pegawai->foto_profil = $foto_admin;
                    $tb_pegawai->save();
                    $request->session()->flash('berhasil', 'Data berhasil disimpan');
                    return redirect(url('/pegawai'));      
                }else{
                    $this->validate($request, [
                    'foto_admin'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
                    ]); 
                    $foto_admin = $request->file('foto_admin')->store('foto_admin'); 
                    $tb_pegawai = new tb_pegawai;
                    $tb_pegawai->kd_pegawai =$kd_pegawai;
                    $tb_pegawai->nip_nik = $request->nip_atau_nik;      
                    $tb_pegawai->nm_pegawai = $request->nama_pegawai;
                    $tb_pegawai->tgl_lahir = $request->tgl_lahir;
                    $tb_pegawai->alamat = $request->alamat;
                    $tb_pegawai->jns_kelamin = $request->jenis_kelamin;
                    $tb_pegawai->foto_profil = $foto_admin;
                    $tb_pegawai->save();
                    $request->session()->flash('berhasil', 'Data berhasil disimpan');
                    return redirect(url('/pegawai'));                    
                }   
            }            
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
             return view('admin.pegawai_tambah');
        }else{
            $pegawai= Tb_pegawai::where('kd_pegawai',$id)->first();
             return view('admin.pegawai_tambah',['pegawai'=>$pegawai]);
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
        $request->validate([
            'nip_atau_nik'=>'required|max:30',
            'nama_pegawai'=>'required|max:30',
            'tgl_lahir'=>'required',
            'alamat'=>'required',
            'jenis_kelamin'=>'required',
        ]);
        if ($request->nip_atau_nik==$request->nip_atau_nik_) {
            # code...
            if (empty($request->foto_admin)) {
                Tb_pegawai::where('kd_pegawai', $request->kd_pegawai)->update([
                    'nm_pegawai' => $request->nama_pegawai,
                    'tgl_lahir'=>$request->tgl_lahir,
                    'alamat'=>$request->alamat,
                    'jns_kelamin'=>$request->jenis_kelamin
                ]);
            }else{
                $this->validate($request, [
                    'foto_admin'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
                ]);
                $foto_admin = $request->file('foto_admin')->store('foto_admin');
                if ($request->foto_lama!='foto_admin/1.jpg') {
                # code...
                    Storage::delete($request->foto_lama);
                } 
                Tb_pegawai::where('kd_pegawai', $request->kd_pegawai)->update([
                    'nm_pegawai' => $request->nama_pegawai,
                    'tgl_lahir'=>$request->tgl_lahir,
                    'alamat'=>$request->alamat,
                    'jns_kelamin'=>$request->jenis_kelamin,
                    'foto_profil'=>$foto_admin
                ]);
            }
            
                $request->session()->flash('berhasil', 'Profil berhasil diubah');
                    return redirect(url('/pegawai'));
        }else{
            $cari= Tb_pegawai::where('nip_nik',$request->nip_atau_nik)->first();
            if ($cari) {
                # code...
                $request->validate([
                'nip_atau_nik'=>'same:'.$cari,
                ],['nip_atau_nik.same'=>'nip atau nik sudah ada ']);
            }else{
                if (empty($request->foto_admin)) {
                    Tb_pegawai::where('kd_pegawai', $request->kd_pegawai)->update([
                        'nip_nik'=>$request->nip_atau_nik,
                        'nm_pegawai' => $request->nama_pegawai,
                        'tgl_lahir'=>$request->tgl_lahir,
                        'alamat'=>$request->alamat,
                        'jns_kelamin'=>$request->jenis_kelamin
                    ]);
                }else{
                    $this->validate($request, [
                        'foto_admin'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
                    ]);
                    $foto_admin = $request->file('foto_admin')->store('foto_admin');
                    if ($request->foto_lama!='foto_admin/1.jpg') {
                    # code...
                        Storage::delete($request->foto_lama);
                    } 
                    Tb_pegawai::where('kd_pegawai', $request->kd_pegawai)->update([
                        'nip_nik'=>$request->nip_atau_nik,
                        'nm_pegawai' => $request->nama_pegawai,
                        'tgl_lahir'=>$request->tgl_lahir,
                        'alamat'=>$request->alamat,
                        'jns_kelamin'=>$request->jenis_kelamin,
                        'foto_profil'=>$foto_admin
                    ]);
                }
                $request->session()->flash('berhasil', 'Profil berhasil diubah');
                return redirect(url('/pegawai'));
            }
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
        $cari= Tb_admin::where('kd_pegawai',$id)->first();
        if ($cari) {
            $request->session()->flash('gagal', 'Data gagal dihapus');
            return redirect(url('/pegawai'));
        }else{
            $cari= Tb_pegawai::where('kd_pegawai',$id)->first();
            $foto_lama=$cari->foto_profil;
            if ($foto_lama!='foto_admin/1.jpg') {
            # code...
                Storage::delete($foto_lama);
            }
            Tb_pegawai::where('kd_pegawai',$id)->delete();
            $request->session()->flash('berhasil', 'Data berhasil dihapus');
            return redirect(url('/pegawai'));
        }     
    }
}
