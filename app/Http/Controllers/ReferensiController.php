<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_referensi;
use App\Tb_aduan;
use App\Tb_komentar;

class ReferensiController extends Controller
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
        $Tb_referensi= New Tb_referensi;
        $Tb_referensi->kd_kegiatan=$request->kd_kegiatan_referensi;
        $Tb_referensi->kd_aduan=$request->kd_aduan_referensi;
        $Tb_referensi->save();

        Tb_aduan::where('kd_aduan', $request->kd_aduan_referensi)->update([
                'status' =>'Diajukan',
        ]);

        $tb_komentar = new Tb_komentar;
        $tb_komentar->kd_komentar =date('ymdHis');
        $tb_komentar->kd_aduan = $request->kd_aduan_referensi;   
        $tb_komentar->kd_admin = session('kode_admin');   
        $tb_komentar->status = 'Diajukan';
        $tb_komentar->komentar = 'Aduan dalam proses pengajuan';
        $tb_komentar->save();

        $request->session()->flash('berhasil', 'Data Referensi berhasil ditambahkan');
        return redirect(url('/'.$request->kd_kegiatan_referensi.'/rkp/edit'));
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
    public function destroy(Request $request,$id)
    {
        //
        Tb_referensi::where('kd_aduan',$id)->delete();

        Tb_komentar::where('kd_aduan',$id)->where('status','Diajukan')->delete();

        Tb_aduan::where('kd_aduan', $id)->update([
                'status' =>'Diterima',
        ]);

        $request->session()->flash('berhasil', 'Data Referensi berhasil dihapus');
        return redirect(url('/'.$request->kd_kegiatan_hapus.'/rkp/edit'));
    }
}
