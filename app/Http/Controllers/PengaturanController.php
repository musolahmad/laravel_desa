<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_berita;
use Storage;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        # code...
        
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
        $this->validate($request, [
            'isi_berita'=>'required'
        ]);
        if (empty($request->foto_berita)) {
                 # code...
                $foto_berita='foto_berita/no_image_news.jpg';
                $tb_berita = new tb_berita;
                $tb_berita->id = $request->no;
                $tb_berita->kd_admin = session('kode_admin');
                $tb_berita->judul = $request->judul;   
                $tb_berita->isi = $request->isi_berita;
                $tb_berita->foto_berita = $foto_berita;
                $tb_berita->save();
                $request->session()->flash('berhasil', 'Data berhasil disimpan');
                return redirect(url('/pengaturan/'.$request->menu));  
        }else{
            $this->validate($request, [
                'foto_berita'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
            ]);
                $foto_berita = $request->file('foto_berita')->store('foto_berita'); 
                $tb_berita = new tb_berita;
                $tb_berita->id = $request->no;
                $tb_berita->kd_admin = session('kode_admin');
                $tb_berita->judul = $request->judul;   
                $tb_berita->isi = $request->isi_berita;
                $tb_berita->foto_berita = $foto_berita;
                $tb_berita->save();
                $request->session()->flash('berhasil', 'Data berhasil disimpan');
                return redirect(url('/pengaturan/'.$request->menu));  
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
        if ($id=='sejarah') {
            # code...
            $judul = 'Sejarah Desa';
            $no=1;           
        }elseif ($id=='profilwilayah'){
            $judul = 'Profil Wilayah Desa';
            $no=2;           
        }elseif ($id=='visimisi'){
            $judul = 'Visi Misi Desa';
            $no=3;           
        }elseif ($id=='pemerintahdesa'){
            $judul = 'Pemerintah Desa';
            $no=4;           
        }elseif ($id=='bpd'){
            $judul = 'Badan Permusyawaratan Desa';
            $no=5;           
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
                return redirect(url('/pengaturan/'.$request->menu));  
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
                return redirect(url('/pengaturan/'.$request->menu));  
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
