<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_master_apbdes;
use App\Tb_apbdes;
use App\Tb_rkp;
use App\Tb_satuan;
use App\Tb_galeri;
use App\Tb_aduan;
use Storage;

class RkpController extends Controller
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
        $master = Tb_master_apbdes::where('kd_induk','=','2')->get();
        return view('admin.rkp',['th'=>$th,'master'=>$master]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah($th,$kd_rekening)
    {
        # code...
        $satuan = Tb_satuan::get();
        $apbdes = Tb_master_apbdes::where(['tipe_akun'=>'2','jns_akun'=>'1'])->get();
        $master = Tb_master_apbdes::where('kd_rekening','=',$kd_rekening)->first();
        return view('admin.rkp_tambah',['bidang'=>$master,'th'=>$th,'satuan'=>$satuan,'apbdes'=>$apbdes]);
    }
    public function create(Request $request)
    {
        //        
        return redirect(url('/rkp/tambah/'.$request->th_anggaran.'/'.$request->kd_rekening));
        
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
        return redirect(url('/rkp/'.$request->th));     
    }

    public function simpan(Request $request)
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
           }elseif(date('Y',strtotime($request->tgl_awal))!=$request->th){
                $tgl_awal="";
                $this->validate($request, [
                    'tgl_awal'=>'same:'.$tgl_awal
                ],['Tahun pada tanggal awal tidak sesuai dengan tahun anggaran. tahun anggaran saat ini '.$request->th]);
           }else{
                $no=Tb_rkp::where(['kd_rekening'=>$request->kd_rekening,'th_anggaran'=>$request->th])->orderBy('kd_rekening', 'DESC')->first();
                if (empty($no)) {
                    # code...
                    $nilai = 1;
                }else{

                    $nilai = $no->no_urut_kegiatan+1;
                }

                $kd_kegiatan=$request->th.$request->kd_rekening.".".$nilai;
                $Tb_rkp= New Tb_rkp;
                $Tb_rkp->kd_kegiatan=$kd_kegiatan;
                $Tb_rkp->no_urut_kegiatan=$nilai;
                $Tb_rkp->kd_rekening=$request->kd_rekening;      
                $Tb_rkp->th_anggaran=$request->th;        
                $Tb_rkp->nm_kegiatan=$request->nm_kegiatan;        
                $Tb_rkp->lokasi=$request->lokasi;                
                $Tb_rkp->volume=str_replace('.', '', $request->volume);       
                $Tb_rkp->kd_satuan=$request->kd_satuan;        
                $Tb_rkp->sasaran=$request->sasaran;        
                $Tb_rkp->tgl_awal=$request->tgl_awal;        
                $Tb_rkp->tgl_akhir=$request->tgl_akhir;                
                $Tb_rkp->biaya=str_replace('.', '', $request->biaya);    
                $Tb_rkp->sumber=$request->sumber;          
                $Tb_rkp->pola_pelaksanaan=$request->pola_pelaksanaan; 
                $Tb_rkp->pelaksana=$request->pelaksana;
                $Tb_rkp->kd_gbr_awl=$kd_kegiatan.'1'; 
                $Tb_rkp->kd_gbr_akh=$kd_kegiatan.'2'; 
                $Tb_rkp->save();
                $request->session()->flash('berhasil', 'Data berhasil ditambahkan');
                return redirect(url('/rkp/'.$request->th));
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
        $jumlah_karakter = strlen($id);
        if ($jumlah_karakter==4) {
            # code...
            $master = Tb_master_apbdes::where('kd_induk','=','2')->get();
            return view('admin.rkp',['th'=>$id,'master'=>$master]);
        }else{
            $rkp = Tb_rkp::where('kd_kegiatan','=',$id)->first();
            if (empty($rkp)) {
                # code...
            }else{
                $th = $rkp->th_anggaran;
                $satuan = Tb_satuan::get();
                $apbdes = Tb_master_apbdes::where(['tipe_akun'=>'2','jns_akun'=>'1'])->get();
                $master = Tb_master_apbdes::where('kd_rekening','=',$rkp->kd_rekening)->first();
                return view('admin.rkp_tambah',['bidang'=>$master,'th'=>$th,'satuan'=>$satuan,'apbdes'=>$apbdes,'rkp'=>$rkp]);
            }
            
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tambahfoto(Request $request,$id)
    {
        # code...
        $this->validate($request, [
            'gambar'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
        ]);

        $foto_galeri = $request->file('gambar')->store('foto_galeri'); 
        $tb_galeri = new Tb_galeri;
        $tb_galeri->kode = $request->kode;
        $tb_galeri->gambar = $foto_galeri;
        $tb_galeri->save();
        $request->session()->flash('berhasil', 'Gambar berhasil ditambahkan');
        return redirect(url('/'.$id.'/rkp/edit'));
    }
    public function edit($id)
    {
        //
        $referensi = Tb_aduan::select('*', 'Tb_aduan.created_at as tgl')->join('tb_galeri','tb_aduan.kd_aduan','=','tb_galeri.kode')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->orderBy('baca','ASC')->orderBy('tgl','DESC')->where('status','Diterima')->whereNotIn('kd_aduan', function($q){ $q->select('kd_aduan')->from('tb_referensi');})->get();
        $satuan = Tb_satuan::get();
        $r= Tb_rkp::join('tb_master_apbdes','tb_master_apbdes.kd_rekening','=','tb_rkp.kd_rekening')->join('tb_satuan','tb_satuan.kd_satuan','=','tb_rkp.kd_satuan')->where(['tb_rkp.kd_kegiatan'=>$id])->first();
        $listreferensi  = Tb_aduan::select('*', 'Tb_aduan.created_at as tgl')->join('tb_galeri','tb_aduan.kd_aduan','=','tb_galeri.kode')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->join('tb_referensi','tb_referensi.kd_aduan','=','tb_aduan.kd_aduan')->orderBy('tgl','DESC')->where('tb_referensi.kd_kegiatan',$id)->get();
        if (!empty($r)) {
            # code...
            $foto_sblm = Tb_galeri::where('kode',$r->kd_gbr_awl)->get();
            $foto_sdh = Tb_galeri::where('kode',$r->kd_gbr_akh)->get();
        
        }else{
            $foto_sblm = Tb_galeri::where('kode','')->get();
            $foto_sdh = Tb_galeri::where('kode','')->get();
        }
        $data = array('satuan' => $satuan, 'r'=>$r, 'referensi'=>$referensi,'foto_sblm'=>$foto_sblm,'foto_sdh'=>$foto_sdh,'listreferensi'=>$listreferensi );
        return view('admin.rkp_tambah_detail',$data);
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
           }elseif(date('Y',strtotime($request->tgl_awal))!=$request->th){
                $tgl_awal="";
                $this->validate($request, [
                    'tgl_awal'=>'same:'.$tgl_awal
                ],['Tahun pada tanggal awal tidak sesuai dengan tahun anggaran. tahun anggaran saat ini '.$request->th]);
           }else{               

                Tb_rkp::where('kd_kegiatan', $id)->update([
                    'nm_kegiatan'=>$request->nm_kegiatan,       
                    'lokasi'=>$request->lokasi,               
                    'volume'=>str_replace('.', '', $request->volume),      
                    'kd_satuan'=>$request->kd_satuan,       
                    'sasaran'=>$request->sasaran,       
                    'tgl_awal'=>$request->tgl_awal,       
                    'tgl_akhir'=>$request->tgl_akhir,               
                    'biaya'=>str_replace('.', '', $request->biaya),   
                    'sumber'=>$request->sumber,         
                    'pola_pelaksanaan'=>$request->pola_pelaksanaan,
                    'pelaksana'=>$request->pelaksana,
                ]);                
                $request->session()->flash('berhasil', 'Data berhasil diubah');
                return redirect(url('/rkp/'.$request->th));
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
        $no=Tb_rkp::where(['kd_rekening'=>$request->kd_rekening,'th_anggaran'=>$request->th_anggaran])->orderBy('no_urut_kegiatan', 'DESC')->first();
        if ($no->no_urut_kegiatan>$request->no_urut_kegiatan) {
            # code...
            $request->session()->flash('gagal', 'Data gagal dihapus');
        }else{
            Tb_rkp::where('kd_kegiatan',$id)->delete();
            $request->session()->flash('berhasil', 'Data berhasil dihapus');
        }
        return redirect(url('/rkp/'.$request->th_anggaran));
    }

     public function hapusfoto(Request $request,$kd_kegiatan,$kode,$id)
    {
        //
        if ($kode=="sebelum") {
            if ($request->file_sblm != 'foto_galeri/no_image_news.jpg') {
                Storage::delete($request->file_sblm);
            }
        }else{
             if ($request->file_sdh != 'foto_galeri/no_image_news.jpg') {
                Storage::delete($request->file_sdh);
            }
        }
        
        Tb_galeri::where('kode',$id)->delete();
        $request->session()->flash('berhasil', 'Gambar berhasil dihapus');
        return redirect(url('/'.$kd_kegiatan.'/rkp/edit'));
    }
}
