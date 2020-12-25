<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_profildesa;
use Storage;

class ProfilDesaController extends Controller
{
    //
    public function index()
    {
    	# code...
        $profildesa = Tb_profildesa::where('id', '1')->first();
        if (session('login_admin')==true) {
            # code...
            return view('admin.profil_desa',['profildesa'=>$profildesa]);
        }else{
            
        }
    	
    }
    public function store(Request $request)
    {
    	# code...  
    	$this->validate($request, [
            'nama_desa'=>'required|max:30',
            'alamat'=>'required',
            'website'=>'required',
            'hari_kerja'=>'required',
            'jam_kerja'=>'required',
            'kode_pos'=>'required',
            'peta'=>'required'

        ]);  	
        $profildesa = Tb_profildesa::where('id', '1')->first();
        if (empty($profildesa)) {
        	# code...
        	if (empty($request->logo)) {
        		# code...
        		$logo='profil_desa/favicon.png';
        		$tb_profildesa = new Tb_profildesa;
		        $tb_profildesa->id = '1';
		        $tb_profildesa->nm_desa = $request->nama_desa;   
		        $tb_profildesa->alamat = $request->alamat;
		        $tb_profildesa->website = $request->website;
		        $tb_profildesa->logo = $logo;
		        $tb_profildesa->kd_pos = $request->kode_pos;
		        $tb_profildesa->hr_krj = $request->hari_kerja;
		        $tb_profildesa->jm_krj = $request->jam_kerja;
		        $tb_profildesa->peta = $request->peta;
		        $tb_profildesa->save();
		        $request->session()->flash('berhasil', 'Data berhasil disimpan');
		        return redirect(url('/profildesa'));      
        	}else{
        		$this->validate($request, [
            	'logo'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
	        	]); 
	        	$logo = $request->file('logo')->store('profil_desa'); 
	        	$tb_profildesa = new Tb_profildesa;
		        $tb_profildesa->id = '1';
		        $tb_profildesa->nm_desa = $request->nama_desa;   
		        $tb_profildesa->alamat = $request->alamat;
		        $tb_profildesa->website = $request->website;
		        $tb_profildesa->logo = $logo;
		        $tb_profildesa->kd_pos = $request->kode_pos;
		        $tb_profildesa->hr_krj = $request->hari_kerja;
		        $tb_profildesa->jm_krj = $request->jam_kerja;
		        $tb_profildesa->peta = $request->peta;
		        $tb_profildesa->save();
		        $request->session()->flash('berhasil', 'Data berhasil disimpan');
		        return redirect(url('/profildesa'));             	
        	}        	  	
        }else{
        	if (empty($request->logo)) {
        		# code...        		
		        Tb_profildesa::where('id', '1')->update([
                'nm_desa' => $request->nama_desa,
                'alamat' => $request->alamat,
                'website'=>$request->website,
                'kd_pos' => $request->kode_pos,
		        'hr_krj' => $request->hari_kerja,
		        'jm_krj' => $request->jam_kerja,
		        'peta' => $request->peta
                ]);
		        $request->session()->flash('berhasil', 'Data berhasil diubah');
		        return redirect(url('/profildesa'));      
        	}else{
        		$this->validate($request, [
            	'logo'=>'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
	        	]); 
	        	if ($request->logo_lama!='profil_desa/favicon.png') {
		            # code...
		            Storage::delete($request->logo_lama);
		        }
	        	$logo = $request->file('logo')->store('profil_desa'); 
	        	Tb_profildesa::where('id', '1')->update([
                'nm_desa' => $request->nama_desa,
                'alamat' => $request->alamat,
                'website'=>$request->website,
                'logo'=>$logo,
                'kd_pos' => $request->kode_pos,
		        'hr_krj' => $request->hari_kerja,
		        'jm_krj' => $request->jam_kerja,
		        'peta' => $request->peta
                ]);
		        $request->session()->flash('berhasil', 'Data berhasil diubah');
		        return redirect(url('/profildesa'));             	
        	}        	  	
        }
    }
}
