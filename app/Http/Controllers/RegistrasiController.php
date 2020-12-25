<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_user;
use App\Tb_admin;
use App\Tb_berita;
use App\Mail\AktifasiAkun;
use Illuminate\Support\Facades\Crypt;
use Mail;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('website.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('website.cek_email',['jml'=>$jml]);

    }
    public function cek_email(Request $request)
    {
        //
        $this->validate($request, [
            'email'=>'required|email'
        ]);
        $email=$request->post('email');
        $user = Tb_user::where('email', $email)->first();
        if (empty($user)) {
            $request->session()->flash('email', 'email tidak terdaftar');
            echo '<script>window.history.back();</script>';
        }elseif ($user->status_user=="2") {
            $request->session()->flash('email', 'akun anda sudah aktif');
            echo '<script>window.history.back();</script>';
        }elseif ($user->status_user=="3") {
            $request->session()->flash('email', 'akun anda sudah diblokir');
            echo '<script>window.history.back();</script>';
        }else{
            Mail::send('emails.sites.aktifasi', ['tb_user' => $user], function ($m) use ($user) {
                    $m->from('jeruksaridesa@gmail.com', 'Admin Desa Jeruksari');

                    $m->to($user->email, $user->nama_depan.' '.$user->nama_belakang)->subject('Aktifasi Akun');
            });
            return redirect(url('/registrasi/'.$user->kd_user));
        }
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
            'nama_depan'=>'required|max:30',
            'nama_belakang'=>'required|max:30',
            'email'=>'required|email',
            'password_baru'=>'required|min:6',
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
            $admin = Tb_admin::where('email', $email)->first();
            if (!empty($user)) {
                $request->session()->flash('email', 'email sudah digunakan');
                echo '<script>window.history.back();</script>';
            }elseif (!empty($admin)) {
                $request->session()->flash('email', 'email sudah digunakan');
                echo '<script>window.history.back();</script>';
            }else{
                $no=Tb_user::where('tgl_daftar',date('Y-m-d'))->orderBy('kd_user', 'DESC')->first();
                if (empty($no)) {
                    # code...
                    $kd_user=date('ymd')."0001";
                }else{
                    $kd_user=$no->kd_user+1;
                }

                
                $tb_user = new Tb_user;
                $tb_user->kd_user = $kd_user;
                $tb_user->nama_depan = $request->nama_depan;
                $tb_user->nama_belakang = $request->nama_belakang;
                $tb_user->email = $request->email;
                $tb_user->password = Crypt::encryptString($request->password_baru);
                $tb_user->jns_kelamin=$request->jenis_kelamin;
                $tb_user->tgl_lahir = $tgl;
                $tb_user->alamat = $request->alamat;
                $tb_user->no_telp = $request->no_telpon;
                $tb_user->foto_profil='foto_profil/1.jpg';
                $tb_user->status_user = '1';
                $tb_user->tgl_daftar = date('Y-m-d');
                $tb_user->save();
                Mail::send('emails.sites.aktifasi', ['tb_user' => $tb_user], function ($m) use ($tb_user) {
                    $m->from('jeruksaridesa@gmail.com', 'Admin Desa Jeruksari');

                    $m->to($tb_user->email, $tb_user->nama_depan.' '.$tb_user->nama_belakang)->subject('Aktifasi Akun');
                });
                return redirect(url('/registrasi/'.$tb_user->kd_user));
                
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
        $user = Tb_user::where('kd_user', $id)->first();
        return view('website.aktifasi',['user'=>$user]);
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
            'kd_user'=>'required'
        ]);
        $user = Tb_user::where('kd_user', $request->kd_user)->first();
        if (empty($user)) {
            $request->session()->flash('kd_user', 'Kode aktifasi salah');
            echo '<script>window.history.back();</script>';
        }elseif ($user->status_user=="2") {
            $request->session()->flash('kd_user', 'Akun sudah aktif');
            echo '<script>window.history.back();</script>';
        }elseif ($user->status_user=="3") {
            $request->session()->flash('kd_user', 'Akun diblokir');
            echo '<script>window.history.back();</script>';
        }else{
            Tb_user::where('kd_user', $request->kd_user)->update(['status_user'=>'2']);
            session(['berhasil_login' => true,'kode_user'=>$user->kd_user]);
            return redirect('/');
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
