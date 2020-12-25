<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_admin;
use App\Tb_user;
use App\Tb_pegawai;
use Storage;
use Illuminate\Support\Facades\Crypt;

class AdminProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admin = Tb_admin::where('kd_admin',session('kode_admin'))->join('tb_pegawai', 'tb_admin.kd_pegawai', '=', 'tb_pegawai.kd_pegawai')->first();
        return view('admin.profil', ['admin'=>$admin]);
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
        if (session('ubah')=='password') {
            # code...
            $request->validate([
                'password'=>'required|required_with:password_lama|same:password_lama',
                'password_baru'=>'required|min:6',
                'konfirmasi_password_baru'=>'required|required_with:password_baru|same:password_baru',
            ],['password.same'=>'password salah']);
            
            Tb_admin::where('kd_admin', session('kode_admin'))->update([
                'password' => Crypt::encryptString($request->password_baru),
            ]);
            $request->session()->flash('berhasil', 'Data berhasil diubah');
            return redirect(url('/admin_profil'));
        }elseif (session('ubah')=='foto') {
            # code...
            $this->validate($request, [
                'logo'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
                ]); 
            if ($request->foto_profil!='profil_admin/1.jpg') {
                    # code...
                Storage::delete($request->foto_profil);
            }
            $foto_profil = $request->file('logo')->store('foto_admin');
            Tb_pegawai::where('kd_pegawai', $request->kd_pegawai)->update([
                'foto_profil' => $foto_profil,
            ]);
            $request->session()->flash('berhasil', 'Foto Profil berhasil diubah');
                return redirect(url('/admin_profil'));
        }elseif (session('ubah')=='profil') {
            $request->validate([
                'nama'=>'required|max:30',
                'tgl_lahir'=>'required',
                'alamat'=>'required',
                'jenis_kelamin'=>'required',
                'email'=>'required|email',
            ]);
            if ($request->email==$request->email_) {
                # code...
                Tb_pegawai::where('kd_pegawai', $request->kd_pegawai_)->update([
                    'nm_pegawai' => $request->nama,
                    'tgl_lahir'=>$request->tgl_lahir,
                    'alamat'=>$request->alamat,
                    'jns_kelamin'=>$request->jenis_kelamin
                ]);
                session(['nm_admin'=>$request->nama]);
                $request->session()->flash('berhasil', 'Profil berhasil diubah');
                    return redirect(url('/admin_profil'));
            }else{
                $admin=Tb_admin::where('email', $request->email)->first();
                if ($admin) {
                    # code...
                    $request->session()->flash('email', 'email sudah digunakan');
                    echo '<script>window.history.back();</script>';
                }else{
                    $user=Tb_user::where('email', $request->email)->first();
                    if ($user) {
                        # code...
                        $request->session()->flash('email', 'email sudah digunakan');
                        echo '<script>window.history.back();</script>';
                    }else{
                        Tb_pegawai::where('kd_pegawai', $request->kd_pegawai_)->update([
                            'nm_pegawai' => $request->nama,
                            'tgl_lahir'=>$request->tgl_lahir,
                            'alamat'=>$request->alamat,
                            'jns_kelamin'=>$request->jenis_kelamin
                        ]);
                        Tb_admin::where('kd_admin', session('kode_admin'))->update([
                            'email' => $request->email,
                        ]);
                        session(['nm_admin'=>$request->nama]);
                        $request->session()->flash('berhasil', 'Profil berhasil diubah');
                        return redirect(url('/admin_profil'));
                    }
                }
            }
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
        if ($id=='foto') {
            # code...
            session(['ubah'=>'foto']);
        }elseif ($id=='password') {
            # code...
            session(['ubah'=>'password']);
        }else{
            # code...
            session(['ubah'=>'profil']);
        }
        return redirect(url('/admin_profil'));
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
