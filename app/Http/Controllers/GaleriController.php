<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_galeri;
use App\Tb_aduan;
use App\Tb_rkp;
use Storage;

class GaleriController extends Controller
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
            $galeri= Tb_galeri::orderBy('created_at','DESC')->paginate(session('no'));
        }else{
            $galeri= Tb_galeri::where('kd_jabatan','like','%'.session('cari').'%')->orwhere('nm_jabatan','like','%'.session('cari').'%')->paginate(session('no'));
        }
        return view('admin.galeri',['galeri'=>$galeri,'no'=>session('no')]);
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

    public function jbt(Request $request)
    {
        session(['no' => $request->jml]);
        return redirect(url('/galeri'));
    }
    public function coba(Request $request)
    {
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }
        session(['no' => '10']);        
        return redirect(url('/galeri'));
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
        return redirect(url('/galeri'));
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
            'gambar'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
        ]);

        if (session('cari')) {
            $request->session()->forget('cari'); 
        }

        $foto_galeri = $request->file('gambar')->store('foto_galeri'); 
        $tb_galeri = new Tb_galeri;
        $tb_galeri->kode = date('ymdHis');
        $tb_galeri->gambar = $foto_galeri;
        $tb_galeri->save();
        $request->session()->flash('berhasil', 'Gambar berhasil ditambahkan');
        return redirect(url('/galeri'));

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
        $cek = Tb_aduan::where('kd_aduan',$id)->first();
        if (empty($cek)) {
            # code...
            $cek = Tb_rkp::where('kd_gbr_awl',$id)->first();
            if (empty($cek)) {
                # code...
                $cek = Tb_rkp::where('kd_gbr_akh')->first();
                if (empty($cek)) {
                    # code...
                    if ($request->file != 'foto_galeri/no_image_news.jpg') {
                        Storage::delete($request->file);
                    }
                    Tb_galeri::where('kode',$id)->delete();
                    $request->session()->flash('berhasil', 'Gambar berhasil dihapus');
                     return redirect(url('/galeri'));     
                }else{
                    $request->session()->flash('gagal', 'Gambar tidak bisa dihapus');
                    return redirect(url('/galeri'));      
                }
            }else{
                $request->session()->flash('gagal', 'Gambar tidak bisa dihapus');
                return redirect(url('/galeri'));   
            }
        }else{
            $request->session()->flash('gagal', 'Gambar tidak bisa dihapus');
            return redirect(url('/galeri'));   
        }
    }
}
