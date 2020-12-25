<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_periode;

class MasaPeriodeController extends Controller
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
            $periode= Tb_periode::paginate(session('no'));
        }else{
            $periode= Tb_periode::where('kd_periode','like','%'.session('cari').'%')->orwhere('awal','like','%'.session('cari').'%')->orwhere('akhir','like','%'.session('cari').'%')->paginate(session('no'));
        }
        return view('admin.periode',['periode'=>$periode,'no'=>session('no')]);
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
        return redirect(url('/periode'));
    }

    public function prd(Request $request)
    {
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }
        session(['no' => '10']);        
        return redirect(url('/periode'));
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
            'tgl_awal'=>'required',
            'tgl_akhir'=>'required'
        ]);
       if(strtotime($request->tgl_awal) >= strtotime($request->tgl_akhir)){
            $tgl_akhir="";
            $this->validate($request, [
                'tgl_akhir'=>'same:'.$tgl_akhir
            ],['tgl akhir tidak boleh kurang atau sama dengan tgl awal']);
       }else{
            if (session('cari')) {
                $request->session()->forget('cari'); 
            }
            $no=Tb_periode::orderBy('kd_periode', 'DESC')->first();
                if (empty($no)) {
                    # code...
                    $kd_periode="PRD001";
                }else{

                    $nilai = substr($no['kd_periode'], 3)+1;

                    if ($nilai<10) {
                      # code...
                      $kd_periode="PRD00".$nilai;
                    }elseif ($nilai<100) {
                    
                      $kd_periode="PRD0".$nilai;
                    }else{
                      $kd_periode="PRD".$nilai;
                    }
                }
            $tb_periode = new Tb_periode;
            $tb_periode->kd_periode =$kd_periode;
            $tb_periode->awal = $request->tgl_awal;   
            $tb_periode->akhir = $request->tgl_akhir;
            $tb_periode->save();
            $request->session()->flash('berhasil', 'Data berhasil disimpan');
            return redirect(url('/periode'));      
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
             return view('admin.periode_tambah');
        }else{
            $periode= Tb_periode::where('kd_periode',$id)->first();
             return view('admin.periode_tambah',['periode'=>$periode]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$detail)
    {
        //
        return $id;
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
        $this->validate($request, [
            'tgl_awal'=>'required',
            'tgl_akhir'=>'required'
        ]);
       if(strtotime($request->tgl_awal) >= strtotime($request->tgl_akhir)){
            $tgl_akhir="";
            $this->validate($request, [
                'tgl_akhir'=>'same:'.$tgl_akhir
            ],['tgl akhir tidak boleh kurang atau sama dengan tgl awal']);
       }else{
            if (session('cari')) {
                $request->session()->forget('cari'); 
            }
            
            Tb_periode::where('kd_periode', $request->kd_periode)->update([
                'awal' => $request->tgl_awal,
                'akhir'=>$request->tgl_akhir
            ]);
            $request->session()->flash('berhasil', 'Data berhasil diubah');
            return redirect(url('/periode'));      
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }
        $cek=Tb_pegawaiperiode::where('kd_periode',$id)->first();
        if ($cek) {
            # code...
            $request->session()->flash('gagal', 'Data gagal dihapus');
            return redirect(url('/periode'));   
        }else{
            Tb_periode::where('kd_periode',$id)->delete();
            $request->session()->flash('berhasil', 'Data berhasil dihapus');
            return redirect(url('/periode'));
        }
    }
}
