<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_jabatan;
use App\Tb_pegawai;
use App\Tb_pegawaiperiode;
class JabatanController extends Controller
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
            $jabatan= Tb_jabatan::paginate(session('no'));
        }else{
            $jabatan= Tb_jabatan::where('kd_jabatan','like','%'.session('cari').'%')->orwhere('nm_jabatan','like','%'.session('cari').'%')->paginate(session('no'));
        }
        return view('admin.jabatan',['jabatan'=>$jabatan,'no'=>session('no')]);
    }

    public function jbt(Request $request)
    {
        session(['no' => $request->jml]);
        return redirect(url('/jabatan'));
    }
    public function coba(Request $request)
    {
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }
        session(['no' => '10']);        
        return redirect(url('/jabatan'));
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
        return redirect(url('/jabatan'));
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
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }

        $no=Tb_jabatan::orderBy('kd_jabatan', 'DESC')->first();
        if (empty($no)) {
            # code...
            $kd_jabatan="JBT001";
        }else{

            $nilai = substr($no['kd_jabatan'], 3)+1;

            if ($nilai<10) {
              # code...
              $kd_jabatan="JBT00".$nilai;
            }elseif ($nilai<100) {
            
              $kd_jabatan="JBT0".$nilai;
            }else{
              $kd_jabatan="JBT".$nilai;
            }
        }

        $Tb_jabatan= New Tb_jabatan;
        $Tb_jabatan->kd_jabatan=$kd_jabatan;
        $Tb_jabatan->nm_jabatan=$request->nm_jabatan;
        $Tb_jabatan->save();
        $request->session()->flash('berhasil', 'Data berhasil ditambahkan');
        return redirect(url('/jabatan'));
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
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }
        Tb_jabatan::where('kd_jabatan', $request->kd_jabatan)->update([
            'nm_jabatan' => $request->nm_jabatan_edit
        ]);
        $request->session()->flash('berhasil', 'Data berhasil diubah');
        return redirect(url('/jabatan'));
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
        $cari= Tb_pegawaiperiode::where('kd_jabatan',$id)->first();
        if ($cari) {
            $request->session()->flash('gagal', 'Data gagal dihapus');
            return redirect(url('/jabatan'));
        }else{
            Tb_jabatan::where('kd_jabatan',$id)->delete();
            $request->session()->flash('berhasil', 'Data berhasil dihapus');
            return redirect(url('/jabatan'));
        }        
    }
}
