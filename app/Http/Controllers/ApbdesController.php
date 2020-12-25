<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_master_apbdes;
use App\Tb_apbdes;
use App\Tb_rkp;
use Storage;

class ApbdesController extends Controller
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
        return view('admin.apbdes',['th'=>$th,'master'=>$master]);
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
         return redirect(url('/apbdes/'.$request->th));     
    }

    public function master(Request $request)
    {
        //
        $master = Tb_master_apbdes::where('kd_induk', '0')->orderBy('kd_rekening', 'DESC')->first();
        if (empty($master)) {
            # code...
            $kd_rek="1";
        }else{
            $kd_rek=$master->kd_rekening+1;
        }
        $tb_master = new Tb_master_apbdes;
        $tb_master->kd_rekening = $kd_rek;
        $tb_master->uraian = $request->uraian;   
        $tb_master->jns_akun = $request->jns_akun;
        $tb_master->kd_induk = '0';
        $tb_master->tipe_akun = $request->tipe_akun;
        $tb_master->no_urut = $kd_rek;
        $tb_master->save();
        $request->session()->flash('berhasil', 'Data berhasil disimpan');
        return redirect(url('/apbdes/master'));      
    }
    public function mastersub(Request $request)
    {
        //
        $master = Tb_master_apbdes::where('kd_induk', $request->kd_induk_)->orderBy('kd_rekening', 'DESC')->first();
        if (empty($master)) {
            # code...
            $kd_rek=$request->kd_induk_.".1";
            $no_urut=1;
        }else{
            $no_urut=$master->no_urut+1;
            $kd_rek=$master->kd_induk.".".$no_urut;
        }
        $tb_master = new Tb_master_apbdes;
        $tb_master->kd_rekening = $kd_rek;
        $tb_master->uraian = $request->uraian_;   
        $tb_master->jns_akun = $request->jns_akun_;
        $tb_master->kd_induk = $request->kd_induk_;
        $tb_master->tipe_akun = $request->tipe_akun_;
        $tb_master->no_urut = $no_urut;
        $tb_master->save();
        $request->session()->flash('berhasil', 'Data berhasil disimpan');
        return redirect(url('/apbdes/master'));      
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
        if ($id=='master') {
            # code...
            $master= Tb_master_apbdes::get();
            return view('admin.apbdesmaster',['master'=>$master]);
        }else{
            
            $master = Tb_master_apbdes::get();
            return view('admin.apbdes',['th'=>$id,'master'=>$master]);
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
    public function masterupdate(Request $request)
    {
        //
        Tb_master_apbdes::where('kd_rekening', $request->kd_rekening_edit)->update([
                'uraian' => $request->uraian_edit
        ]);
        $request->session()->flash('berhasil', 'Data berhasil diubah');
        return redirect(url('/apbdes/master'));
        
    }
    public function updatemaster(Request $request)
    {
        //
        Tb_master_apbdes::where('kd_rekening', $request->kd_rekening_editm)->update([
                'uraian' => $request->uraian_editm,
                'tipe_akun' =>$request->tipe_akun_editm
        ]);
        $request->session()->flash('berhasil', 'Data berhasil diubah');
        return redirect(url('/apbdes/master'));
        
    }
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
            $tb_apbdes->pagu_rencana = 0;
            $tb_apbdes->pagu_realisasi = str_replace('.', '', $request->pagu);
            $tb_apbdes->save();
                 
        }else{
            Tb_apbdes::where('kd_apbdes', $request->th_edit.$request->kd_rekening_edit)->update([
                'pagu_realisasi' => str_replace('.', '', $request->pagu)
            ]);
        }
        return redirect(url('/realisasi/'.$request->th_edit.'/'.$request->kd_induk_edit));
    }
    public function updatepagu(Request $request,$th,$kd_induk)
    {
        //
        $apbdes = Tb_apbdes::where('kd_apbdes', $th.$kd_induk)->first();
        $sum = Tb_apbdes::join('tb_master_apbdes','tb_master_apbdes.kd_rekening','=','tb_apbdes.kd_rekening')->where(['th_anggaran'=>$th,'tb_master_apbdes.kd_induk'=>$kd_induk])->get()->sum('pagu_realisasi');
        if (empty($apbdes)) {
            # code...
            $tb_apbdes = new Tb_apbdes;
            $tb_apbdes->kd_apbdes = $th.$kd_induk;
            $tb_apbdes->kd_rekening = $kd_induk;   
            $tb_apbdes->th_anggaran = $th;
            $tb_apbdes->pagu_rencana = 0;
            $tb_apbdes->pagu_realisasi = $sum;
            $tb_apbdes->save();
        }else{
            Tb_apbdes::where('kd_apbdes', $th.$kd_induk)->update([
                'pagu_realisasi' => $sum
            ]);
        }

        $master = Tb_master_apbdes::where('kd_rekening',$kd_induk)->first();
        $kd = $master->kd_induk;

        if ($kd==0) {
            # code...
            $request->session()->flash('berhasil', 'Data berhasil diubah');
            return redirect(url('/realisasi/'.$th));
        }else{
            return redirect(url('/realisasi/'.$th.'/'.$kd));
        }
    }

    public function masterhapus(Request $request, $id)
    {
        //
       $master = Tb_master_apbdes::where('kd_induk', $id)->first();
        if (empty($master)) {
            # code...
            $rkp = Tb_rkp::where('kd_rekening',$id)->orwhere('sumber',$id)->first();
            if (empty($rkp)) {
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
