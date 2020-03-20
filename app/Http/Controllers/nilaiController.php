<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Mhs18Model;
use App\model\PraktikumModel;
use App\model\UserModel;
use App\model\UseraksesModel;
use App\model\NilaiModel;
use Session;
Use Input;

class nilaiController extends Controller
{
    private $page = 15;
    public function index(Request $request){
    	$user = UserModel::where('username',Session::get('username'))->first();
    	$akses = UseraksesModel::where('id_user',$user->id_user)->first();
    	$data['kelas'] = Mhs18Model::select("kelas")->groupBy("kelas")->get();
    	$data['list'] = PraktikumModel::where('id_akses',$akses->id_akses)->orderBy('kelas')->paginate($this->page);
    	return view('asisten.listnilai',$data);
    }
    public function nilai($id){
    	$data['nilai'] = NilaiModel::select("nilai.*","mhs18.nama")->leftJoin('mhs18','mhs18.npm','=','nilai.npm')->where('id_praktikum',$id)->orderBy('mhs18.no')->get();
    	$data['p'] = PraktikumModel::where('id_praktikum',$id)->first();
    	return view('asisten.nilai',$data);	
    	//print_r($data['nilai'][0]['nama']);
    }
    public function edit(Request $request){
    	$data = array();
    	$praktikum = PraktikumModel::where('id_praktikum',$request->id_praktikum)->first();
    	for($i=1;$i<=(int)$praktikum->pertemuan;$i++){
    		$data += array('p'.$i => $request->input('p'.$i));
    	}
    	//print_r($request->id_nilai);
    	NilaiModel::where('id_nilai',$request->id_nilai)->update($data);

    	return back()->with('alert','Nilai berhasil di update');
    }
}
