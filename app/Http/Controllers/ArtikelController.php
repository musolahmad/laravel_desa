<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_berita;
use App\Tb_pegawai;
use App\Tb_pegawaiperiode;
class ArtikelController extends Controller
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
            $berita= Tb_berita::orderBy('created_at','DESC')->paginate(session('no'));
        }else{
            $berita= Tb_berita::where('id','like','%'.session('cari').'%')->orwhere('judul','like','%'.session('cari').'%')->orwhere('isi','like','%'.session('cari').'%')->orderBy('created_at','DESC')->paginate(session('no'));
        }
        $id= Tb_berita::orderBy('id','DESC')->first();
        return view('admin.artikel',['berita'=>$berita,'no'=>session('no'),'id'=>$id]);
    }

    public function jbt(Request $request)
    {
        session(['no' => $request->jml]);
        return redirect(url('/berita'));
    }
    public function coba(Request $request)
    {
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }
        session(['no' => '10']);        
        return redirect(url('/berita'));
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
        return redirect(url('/berita'));
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
        
        $this->validate($request, [
            'judul'=>'required',
            'isi_berita'=>'required'
        ]);
        $no=Tb_berita::orderBy('id', 'DESC')->first();
        if (empty($no)) {
            # code...
            $kd_berita="6";
        }elseif($no->id<6){
            $kd_berita="6";
        }else{

            $kd_berita = $no->id+1;
        }
        if (empty($request->foto_berita)) {
                 # code...
                $foto_berita='foto_berita/no_image_news.jpg';
                $tb_berita = new Tb_berita;
                $tb_berita->id = $kd_berita;
                $tb_berita->kd_admin = session('kode_admin');
                $tb_berita->judul = $request->judul;   
                $tb_berita->isi = $request->isi_berita;
                $tb_berita->foto_berita = $foto_berita;
                $tb_berita->jml_baca = '0';
                $tb_berita->save();
                $request->session()->flash('berhasil', 'Data berhasil ditambahkan');
                return redirect(url('/berita'));
        }else{
            $this->validate($request, [
                'foto_berita'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
            ]);
                $foto_berita = $request->file('foto_berita')->store('foto_berita'); 
                $tb_berita = new Tb_berita;
                $tb_berita->id = $kd_berita;
                $tb_berita->kd_admin = session('kode_admin');
                $tb_berita->judul = $request->judul;   
                $tb_berita->isi = $request->isi_berita;
                $tb_berita->foto_berita = $foto_berita;
                $tb_berita->jml_baca = '0';
                $tb_berita->save();
                $request->session()->flash('berhasil', 'Data berhasil ditambahkan');
                return redirect(url('/berita'));
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
            $judul = 'Tambah Data Artikel dan Berita';   
            $no = 'tambah';        
        }else{
            
            $no = $id;      
            $id='edit';
            $judul = 'Edit Data Artikel dan Berita';   
        }
        $data = Tb_berita::where('id', $no)->first();
        return view('admin.berita',['judul'=>$judul,'id'=>$id,'no'=>$no,'data'=>$data]);
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
        $this->validate($request, [
            'isi_berita'=>'required'
        ]);
        if (empty($request->foto_berita)) {
                 # code...
                Tb_berita::where('id', $request->no)->update([
                'kd_admin' => session('kode_admin'),
                'judul' => $request->judul,   
                'isi' => $request->isi_berita,
                ]);  
                $request->session()->flash('berhasil', 'Data berhasil diubah');
                return redirect(url('/berita')); 
        }else{
            $this->validate($request, [
                'foto_berita'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
            ]);
                if ($request->foto_lama!='foto_berita/no_image_news.jpg') {
                    # code...
                    Storage::delete($request->foto_lama);
                }
                $foto_berita = $request->file('foto_berita')->store('foto_berita'); 
                Tb_berita::where('id', $request->no)->update([
                'kd_admin' => session('kode_admin'),
                'judul' => $request->judul,   
                'isi' => $request->isi_berita,
                'foto_berita'=>$foto_berita
                ]);  
                $request->session()->flash('berhasil', 'Data berhasil diubah');
                return redirect(url('/berita'));
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
        Tb_berita::where('id',$id)->delete();
            $request->session()->flash('berhasil', 'Data berhasil dihapus');
            return redirect(url('/berita'));  
    }
}