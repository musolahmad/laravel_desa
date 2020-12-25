<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_pegawai;
use App\Tb_admin;
use App\Tb_user;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
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
            $admin= Tb_admin::join('tb_pegawai', 'tb_admin.kd_pegawai', '=', 'tb_pegawai.kd_pegawai')->where('tb_pegawai.kd_pegawai','!=','ADM001')->paginate(session('no'));
        }else{
            $admin= Tb_admin::where('kd_admin','like','%'.session('cari').'%')->orwhere('nm_pegawai','like','%'.session('cari').'%')->orwhere('email','like','%'.session('cari').'%')->join('tb_pegawai', 'tb_admin.kd_pegawai', '=', 'tb_pegawai.kd_pegawai')->paginate(session('no'));
        }
        return view('admin.admin',['admin'=>$admin,'no'=>session('no')]);
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

    public function cari(Request $request)
    {
        //
        if (!$request) {
            # code...
            $request->session()->forget('cari');
        }else{
            session(['cari' => $request->cari]);
        }
        return redirect(url('/admin_data'));
    }

    public function adm(Request $request)
    {
        if (session('cari')) {
            $request->session()->forget('cari'); 
        }
        session(['no' => '10']);        
        return redirect(url('/admin_data'));
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
        $request->validate([
                'password'=>'required|min:6',
                'email'=>'required|email',
        ]);
        $admin = Tb_admin::where('email',$request->email)->first();
        if ($admin) {
            # code...
            $request->validate([
                'email'=>'same:'.$admin,
                ],['email.same'=>'email sudah dipakai']);
            
        }else{
            $user = Tb_user::where('email',$request->email)->first();
            if ($user) {
                $request->validate([
                'email'=>'same:'.$admin,
                ],['email.same'=>'email sudah dipakai']);
            }else{
                if (session('cari')) {
                    $request->session()->forget('cari'); 
                }
               $no = Tb_admin::orderBy('kd_admin', 'DESC')->first();
                if (empty($no)) {
                    # code...
                    $kd_admin="ADM001";
                }else{
                    $nilai = substr($no['kd_admin'], 3)+1;

                    if ($nilai<10) {
                      # code...
                      $kd_admin="ADM00".$nilai;
                    }elseif ($nilai<100) {
                    
                      $kd_admin="ADM0".$nilai;
                    }else{
                      $kd_admin="ADM".$nilai;
                    }
                }

                $tb_admin = new Tb_admin;
                $tb_admin->kd_admin =$kd_admin;
                $tb_admin->kd_pegawai = $request->kd_pegawai;   
                $tb_admin->email = $request->email;
                $tb_admin->password = Crypt::encryptString($request->password);
                $tb_admin->save();
                $request->session()->flash('berhasil', 'Data berhasil disimpan');
                return redirect(url('/admin_data'));    
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //
        if ($id=='tambah') {
            # code...
            $admin = Tb_admin::get();
            foreach ($admin as $adm) {
                        $data[] = $adm->kd_pegawai;
            }
            $pegawai= Tb_pegawai::whereNotIn('kd_pegawai', $data)->get();
            if (!$pegawai->isEmpty()) {
                # code...
                 return view('admin.admin_tambah',['pegawai'=>$pegawai]);
            }else{
                $request->session()->flash('gagal', 'Tidak bisa menambahkan Admin karena semua pegawai sudah menjadi admin');
                return redirect(url('/admin_data'));    
            }
            
        }else{
            $admin= Tb_admin::where('kd_admin',$id)->join('tb_pegawai', 'tb_admin.kd_pegawai', '=', 'tb_pegawai.kd_pegawai')->first();
             return view('admin.admin_tambah',['admin'=>$admin]);
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
        $request->validate([
                'password'=>'required|min:6',
                'email'=>'required|email',
        ]);
        if ($request->email==$request->email_lama) {
            # code...
            if (session('cari')) {
                $request->session()->forget('cari'); 
            }
            Tb_admin::where('kd_admin', $request->kd_admin)->update([
                'password' => Crypt::encryptString($request->password)
            ]);
            $request->session()->flash('berhasil', 'Data berhasil diubah');
            return redirect(url('/admin_data'));      
        }else{
            $admin = Tb_admin::where('email',$request->email)->first();
            if ($admin) {
                # code...
                $request->validate([
                    'email'=>'same:'.$admin,
                    ],['email.same'=>'email sudah dipakai']);
                
            }else{
                $user = Tb_user::where('email',$request->email)->first();
                if ($user) {
                    $request->validate([
                    'email'=>'same:'.$admin,
                    ],['email.same'=>'email sudah dipakai']);
                }else{
                    if (session('cari')) {
                        $request->session()->forget('cari'); 
                    }
                    Tb_admin::where('kd_admin', $request->kd_admin)->update([
                         'password' => Crypt::encryptString($request->password),
                         'email'=>$request->email
                    ]);
                    $request->session()->flash('berhasil', 'Data berhasil diubah');
                    return redirect(url('/admin_data'));    
                }
            }
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
        Tb_admin::where('kd_admin',$id)->delete();
            $request->session()->flash('berhasil', 'Data berhasil dihapus');
            return redirect(url('/admin_data'));
    }
}
