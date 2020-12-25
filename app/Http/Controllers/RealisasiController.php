<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_master_apbdes;
use App\Tb_apbdes;
use Storage;

class RealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $th=date('Y');
        $master = Tb_master_apbdes::get();
        return view('admin.apbdes_realisasi',['th'=>$th,'master'=>$master]);
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
         return redirect(url('/realisasi/'.$request->th));     
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
        $master = Tb_master_apbdes::get();
        return view('admin.apbdes_realisasi',['th'=>$id,'master'=>$master]);
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
        $apbdes = Tb_apbdes::where('kd_apbdes', $request->th_edit.$request->kd_rekening_edit)->first();
        if (empty($apbdes)) {
            # code...
            $tb_apbdes = new Tb_apbdes;
            $tb_apbdes->kd_apbdes = $request->th_edit.$request->kd_rekening_edit;
            $tb_apbdes->kd_rekening = $request->kd_rekening_edit;   
            $tb_apbdes->th_anggaran = $request->th_edit;
            $tb_apbdes->pagu_rencana = str_replace('.', '', $request->pagu);
            $tb_apbdes->pagu_realisasi = 0;
            $tb_apbdes->save();
                 
        }else{
            Tb_apbdes::where('kd_apbdes', $request->th_edit.$request->kd_rekening_edit)->update([
                'pagu_rencana' => str_replace('.', '', $request->pagu)
            ]);
        }
        return redirect(url('/apbdes/'.$request->th_edit.'/'.$request->kd_induk_edit));
    }
    public function updatepagu(Request $request,$th,$kd_induk)
    {
        //
        $apbdes = Tb_apbdes::where('kd_apbdes', $th.$kd_induk)->first();
        $sum = Tb_apbdes::join('tb_master_apbdes','tb_master_apbdes.kd_rekening','=','tb_apbdes.kd_rekening')->where(['th_anggaran'=>$th,'tb_master_apbdes.kd_induk'=>$kd_induk])->get()->sum('pagu_rencana');
        if (empty($apbdes)) {
            # code...
            $tb_apbdes = new Tb_apbdes;
            $tb_apbdes->kd_apbdes = $th.$kd_induk;
            $tb_apbdes->kd_rekening = $kd_induk;   
            $tb_apbdes->th_anggaran = $th;
            $tb_apbdes->pagu_rencana = $sum;
            $tb_apbdes->pagu_realisasi = 0;
            $tb_apbdes->save();
        }else{
            Tb_apbdes::where('kd_apbdes', $th.$kd_induk)->update([
                'pagu_rencana' => $sum
            ]);
        }

        $master = Tb_master_apbdes::where('kd_rekening',$kd_induk)->first();
        $kd = $master->kd_induk;

        if ($kd==0) {
            # code...
            $request->session()->flash('berhasil', 'Data berhasil diubah');
            return redirect(url('/apbdes/'.$th));
        }else{
            return redirect(url('/apbdes/'.$th.'/'.$kd));
        }
    }

    public function masterhapus(Request $request, $id)
    {
        //
       $master = Tb_master_apbdes::where('kd_induk', $id)->first();
        if (empty($master)) {
            # code...
            $kd_induk = Tb_master_apbdes::where('kd_induk', '0')->orderBy('kd_rekening', 'DESC')->first();
            if ($kd_induk->kd_rekening>$id) {
                # code...
                $request->session()->flash('gagal', 'Data tidak bisa dihapus');
                return redirect(url('/apbdes/master'));    
            }else{
                Tb_master_apbdes::where('kd_rekening',$id)->delete();
                $request->session()->flash('berhasil', 'Data berhasil dihapus');
                return redirect(url('/apbdes/master'));
            }
            
        }else{
           $request->session()->flash('gagal', 'Data tidak bisa dihapus');
            return redirect(url('/apbdes/master'));      
        }
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
