<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_user;
use App\Tb_berita;
use Illuminate\Support\Facades\Crypt;
use Storage;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //  
        $user = Tb_user::where('kd_user', $request->session()->get('kode_user'))->first();
        return view('website.profil',['user'=>$user]);

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
    public function foto(Request $request)
    {
        //
        session(['ubah'=>'foto']);
        $this->validate($request, [
            'foto_profil'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
        ]);
        if ($request->foto_lama!='foto_profil/1.jpg') {
            # code...
            Storage::delete($request->foto_lama);
        }
        $foto_profil = $request->file('foto_profil')->store('foto_profil');
        Tb_user::where('kd_user', session('kode_user'))->update([
            'foto_profil' => $foto_profil,
        ]);
        $request->session()->flash('berhasil', 'Foto profil berhasil di ubah');
        return redirect(url('/profil'));

    }
    public function password(Request $request)
    {
        //
        session(['ubah'=>'password']);
        $request->validate([
            'password_lama'=>'required|required_with:password_|same:password_',
            'password_baru'=>'required|min:6|',
            'konfirmasi_password_baru'=>'required|required_with:password_baru|same:password_baru',
        ],['password_lama.same'=>'password salah']);
        Tb_user::where('kd_user', session('kode_user'))->update([
            'password' => Crypt::encryptString($request->password_baru),
        ]);
        $request->session()->flash('berhasil', 'Password berhasil di ubah');
        return redirect(url('/profil'));
    }
    public function profil(Request $request)
    {
        //
        session(['ubah'=>'profil']);
        $this->validate($request, [
            'nama_depan'=>'required|max:30',
            'nama_belakang'=>'required|max:30',
            'email'=>'required|email',
            'alamat'=>'required',
            'jenis_kelamin'=>'required|in:l,p',
            'no_telpon'=>'required|numeric'
        ]);
        $tgl_lahir= $request->tgl_lahir;
        $bln_lahir= $request->bln_lahir;
        $thn_lahir= $request->thn_lahir;
        $tgl = $thn_lahir.'-'.$bln_lahir.'-'.$tgl_lahir;
        $bts_umr = (date('Y')-17).'-'.date('m-d');
        $th=date('Y')-17;
        if(!checkdate($bln_lahir, $tgl_lahir, $thn_lahir)){
            $request->session()->flash('tgl_lahir', 'tanggal lahir tidak falid');
            echo '<script>window.history.back();</script>';
        }elseif(strtotime(date('Y-m-d'))<strtotime($tgl)){
            echo 'tidak valid';
        }elseif(strtotime($bts_umr)<strtotime($tgl)){
            $request->session()->flash('umur', 'tahun lahir maksimal '.$th);
            echo '<script>window.history.back();</script>';
        }else{
            $email=$request->email;
            $user = Tb_user::where('email', $email)->first();
            if(empty($user)||$user->kd_user==session('kode_user')){
                Tb_user::where('kd_user', session('kode_user'))->update([
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'email' => $request->email,
                'jns_kelamin'=>$request->jenis_kelamin,
                'tgl_lahir' => $tgl,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telpon,
                ]);
                $request->session()->flash('berhasil', 'Profil berhasil di ubah');
                return redirect(url('/profil'));                
            }else{
                $request->session()->flash('email', 'email sudah digunakan');
                echo '<script>window.history.back();</script>';                
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
        session(['ubah'=>'profil']);
        return redirect(url('/profil'));
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
