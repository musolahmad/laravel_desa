<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Tb_user;
use App\Tb_admin;
use App\Tb_berita;
use Mail;

class LupaPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('website.lupa_password');
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
            'email'=>'required|email'
        ]);
        $email=$request->post('email');
        $user = Tb_user::where('email', $email)->first();
        if (empty($user)) {
            $admin = Tb_admin::where('email', $email)->first();
            if (empty($admin)) {
                $request->session()->flash('email', 'email tidak terdaftar');
                echo '<script>window.history.back();</script>';
            }else{
                return redirect(url('/lupa_password/'.$admin->kd_admin));
            }
        }elseif ($user->status_user=="1") {
            $request->session()->flash('email', 'akun belum diaktifasi silahkan aktifasi terlebih dahulu');
            echo '<script>window.history.back();</script>';
        }elseif ($user->status_user=="3") {
            $request->session()->flash('email', 'akun anda sudah diblokir');
            echo '<script>window.history.back();</script>';
        }else{
            return redirect(url('/lupa_password/'.$user->kd_user));
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
        if (empty($user)) {
            # code...
            $admin = Tb_admin::where('kd_admin', $id)->join('tb_pegawai', 'tb_admin.kd_pegawai', '=', 'tb_pegawai.kd_pegawai')->first();
            return view('admin.info_password',['user'=>$admin]);
        }else{
           return view('website.info_password',['user'=>$user]);
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
    public function email(Request $request, $id)
    {
        //
        $user = Tb_user::where('kd_user', $id)->first();
        if (empty($user)) {
            # code...
            $admin = Tb_admin::where('kd_admin', $id)->join('tb_pegawai', 'tb_admin.kd_pegawai', '=', 'tb_pegawai.kd_pegawai')->first();
            Mail::send('emails.sites.admin_password', ['tb_user' => $admin], function ($m) use ($admin) {
            $m->from('jeruksaridesa@gmail.com', 'Admin Desa Jeruksari');
            $m->to($admin->email, $admin->nm_pegawai)->subject('Lupa Password');
            });
            $request->session()->flash('berhasil', 'Password sudah terkirim ke email anda, silahkan cek email anda');
            $request->session()->flash('mail', $admin->email);           
            return redirect(url('/login'));
        }else{
            Mail::send('emails.sites.password', ['tb_user' => $user], function ($m) use ($user) {
            $m->from('jeruksaridesa@gmail.com', 'Admin Desa Jeruksari');
            $m->to($user->email, $user->nama_depan.' '.$user->nama_belakang)->subject('Lupa Password');
            });
            $request->session()->flash('berhasil', 'Password sudah terkirim ke email anda, silahkan cek email anda');
            $request->session()->flash('mail', $user->email);           
            return redirect(url('/login'));
        }        
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
