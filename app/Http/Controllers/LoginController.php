<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_user;
use App\Tb_admin;
use App\Tb_berita;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    //
     public function index()
    {
        return view('website.login');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);
        $email=$request->post('email');
        $password=$request->post('password');
        $user = Tb_user::where('email', $email)->first();
        if (empty($user)) {
            $admin = Tb_admin::where('email', $email)->join('tb_pegawai', 'tb_admin.kd_pegawai', '=', 'tb_pegawai.kd_pegawai')->first();
            if (empty($admin)) {
                $request->session()->flash('email', 'email salah');
                echo '<script>window.history.back();</script>';
            }else{
                $pass=Crypt::decryptString($admin->password);             
                if ($pass!=$password) {
                    $request->session()->flash('password', 'password salah');
                    echo '<script>window.history.back();</script>';
                }else{
                    session(['login_admin' => true,'kode_admin'=>$admin->kd_admin,'nm_admin'=>$admin->nm_pegawai,'lvl_admin'=>$admin->lvl_admin]);
                    return redirect('/');
                }
            }
        }else{
        	$pass=Crypt::decryptString($user->password);        	 
        	if ($pass!=$password) {
	            $request->session()->flash('password', 'password salah');
	            echo '<script>window.history.back();</script>';
	        }else{
	        	$status_user= $user->status_user;
	        	if ($status_user==1) {
	        	   $request->session()->flash('error', 'Akun belum diaktifasi');
            		echo '<script>window.history.back();</script>';
	        	}elseif ($status_user==3) {
	        		$request->session()->flash('error', 'Akun anda terblokir');
            		echo '<script>window.history.back();</script>';
	        	}else{
                    session(['berhasil_login' => true,'kode_user'=>$user->kd_user]);
                    return redirect('/');
                }   	
	        }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect(url(''));
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
    public function destroy($id)
    {
        //
    }
}
