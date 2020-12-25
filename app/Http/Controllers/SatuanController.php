<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_satuan;
use App\Tb_rkp;

class SatuanController extends Controller
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
            $satuan= Tb_satuan::paginate(session('no'));
        }else{
            $satuan= Tb_satuan::where('kd_satuan','like','%'.session('cari').'%')->orwhere('nm_satuan','like','%'.session('cari').'%')->paginate(session('no'));
        }
        return view('admin.satuan',['satuan'=>$satuan,'no'=>session('no')]);
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

     public function coba(Request $request)
    {
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }
        session(['no' => '10']);        
        return redirect(url('/satuan'));
    }

    public function stn(Request $request)
    {
        session(['no' => $request->jml]);
        return redirect(url('/satuan'));
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
        return redirect(url('/satuan'));
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
        $no=Tb_satuan::orderBy('kd_satuan', 'DESC')->first();
        if (empty($no)) {
                 # code...
            $kd_satuan=1;
        }else{
            $kd_satuan=$no->kd_satuan+1;
        }

        $tb_satuan = new tb_satuan;
        $tb_satuan->kd_satuan =$kd_satuan;
        $tb_satuan->nm_satuan = $request->nm_satuan; 
        $tb_satuan->save();
        $request->session()->flash('berhasil', 'Data berhasil ditambahkan');
        return redirect(url('/satuan'));
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
        Tb_satuan::where('kd_satuan', $request->kd_satuan)->update([
            'nm_satuan' => $request->nm_satuan_edit
        ]);
        $request->session()->flash('berhasil', 'Data berhasil diubah');
        return redirect(url('/satuan'));
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
        $cari= Tb_rkp::where('kd_satuan',$id)->first();
        if ($cari) {
            $request->session()->flash('gagal', 'Data gagal dihapus');
            return redirect(url('/satuan'));
        }else{
            Tb_satuan::where('kd_satuan',$id)->delete();
            $request->session()->flash('berhasil', 'Data berhasil dihapus');
            return redirect(url('/satuan'));
        }        
    }
}
