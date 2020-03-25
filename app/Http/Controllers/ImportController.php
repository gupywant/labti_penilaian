<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use App\model\NilaiurutModel;
use App\model\NilaiurutasliModel;
use App\model\NilaiurutrefModel;
use App\Imports\NilaiurutImport;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use File;

class ImportController extends Controller
{
	public function index(){
		if(!empty(Session::get('id_urut'))){
			$id = Session::get('id_urut');
		}else{
			$id = '';
		}
		$data['urut'] = 1;
		$data['nilai'] = NilaiurutModel::where('id_urut',$id)->orderBy('nama')->get();
		return view('admin.nilaiurut',$data);

	}

    public function import(Request $request){
    	if(empty($request->file)){
            return back()->with('alert','pilih file terlebih dahulu');
        }

        if(empty($request->session)){
	        $ref = new NilaiurutrefModel;
	    	$ref->save();
	    	$id_urut = $ref->id_urut;
	    	$update = 0;
	    }else{
	    	$id_urut = $request->session;
	    	$update = 1;
	    }

        $path = public_path().'/filesdat/'.$id_urut;
        if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $file = $request->file('file');
        $file->move($path,$file->getClientOriginalName());

		// menangkap file excel
		$file = $request->file('file');

		// membuat nama file unik
		$nama_file = $file->getClientOriginalName();
	 
		// upload ke folder file_siswa di dalam folder public
	 
		// import data
		//
		$tipe = $request->tipe;
		Excel::import(new NilaiurutImport($id_urut,$tipe,$update), '/'.$path.'/'.$nama_file);
		// alihkan halaman kembali
		NilaiurutModel::where('nama','Surname')->delete();
		NilaiurutModel::where('npm',NULL)->delete();

		return back()->with('id_urut',$id_urut);
    }
}
