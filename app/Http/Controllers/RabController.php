<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_rab;

class RabController extends Controller
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
        $no = Tb_rab::where('kd_kegiatan',$request->kd_kegiatan)->where('jns_belanja',$request->jns_belanja)->orderBy('no_urut', 'DESC')->first();
        if (empty($no)) {
            # code...
            $no_urut=1;
        }else{
            $no_urut=$no->no_urut+1;
        }
        $Tb_rab= New Tb_rab;
        $Tb_rab->kd_kegiatan=$request->kd_kegiatan;
        $Tb_rab->uraian=$request->uraian;
        $Tb_rab->no_urut= $no_urut;
        $Tb_rab->jns_belanja=$request->jns_belanja;
        $Tb_rab->vol_rab=str_replace('.', '', $request->volume);       
        $Tb_rab->kd_satuan=$request->kd_satuan;        
        $Tb_rab->hrg_satuan=str_replace('.', '', $request->hrg_satuan);  
        $Tb_rab->save();
        $request->session()->flash('berhasil', 'Data RAB berhasil ditambahkan');
        return redirect(url('/'.$request->kd_kegiatan.'/rkp/edit'));
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
        Tb_rab::where('id', $request->id_edit)->update([
            'uraian'=>$request->uraian_edit,          
            'vol_rab'=>str_replace('.', '', $request->volume_edit),      
            'kd_satuan'=>$request->kd_satuan_edit,       
            'hrg_satuan'=>str_replace('.', '', $request->hrg_satuan_edit)
        ]);                
        $request->session()->flash('berhasil', 'Data RAB berhasil diubah');         
        return redirect(url('/'.$request->kd_kegiatan_edit.'/rkp/edit'));
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
        Tb_rab::where('id',$id)->delete();
        $request->session()->flash('berhasil', 'Data RAB berhasil dihapus');
         return redirect(url('/'.$request->kd_kegiatan_hapus.'/rkp/edit'));
    }
}
