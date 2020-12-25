<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_aduan;
use App\Tb_user;
class PelaporController extends Controller
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
        $user=Tb_user::where('kd_user',$id)->first();
        $artikel = Tb_aduan::select('*', 'tb_aduan.created_at as tgl')->join('tb_user','tb_user.kd_user','=','tb_aduan.kd_user')->join('tb_galeri','tb_aduan.kd_aduan','=','tb_galeri.kode')->where('status','!=','Masuk')->where('tb_user.kd_user',$id)->orderBy('tb_aduan.created_at','DESC')->paginate(12);
        return view('website.pelapor',['artikel'=>$artikel,'user'=>$user]);
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
    public function destroy($id)
    {
        //
    }
}
