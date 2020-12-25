<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_jabatan;
use App\Tb_pegawai;
use App\Tb_periode;
use App\Tb_pegawaiperiode;

class PegawaiPeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $jml= count($request->kd_pegawai); 
        for($x=0;$x<$jml;$x++){
            $tb_pegawaiperiode = new Tb_pegawaiperiode;
            $tb_pegawaiperiode->kd_periode =$request->kd_periode;
            $tb_pegawaiperiode->kd_jabatan = $request->kd_jabatan[$x];   
            $tb_pegawaiperiode->kd_pegawai = $request->kd_pegawai[$x];
            $tb_pegawaiperiode->save();
        }
        $request->session()->flash('berhasil', 'Data berhasil disimpan');
        return redirect(url('/pegawai_periode/'.$request->kd_periode));

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
        $jabatan = Tb_jabatan::get();
        $pegawai = Tb_pegawai::get();
        $periode= Tb_periode::where('kd_periode',$id)->first();
        $pegawaiperiode= Tb_pegawaiperiode::where('kd_periode',$id)->first();
        return view('admin.pegawai_periode_tambah',['periode'=>$periode, 'jabatan'=>$jabatan,'pegawai'=>$pegawai,'pegawaiperiode'=>$pegawaiperiode]);
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
        $jml= count($request->kd_pegawai); 
        for($x=0;$x<$jml;$x++){
            Tb_pegawaiperiode::where(['id'=> $request->id[$x]])->update([
                'kd_pegawai' => $request->kd_pegawai[$x],
            ]);
        }
        $request->session()->flash('berhasil', 'Data berhasil diubah');
        return redirect(url('/pegawai_periode/'.$request->kd_periode));
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
