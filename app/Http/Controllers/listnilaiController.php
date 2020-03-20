<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Mhs18Model;
use App\model\PraktikumModel;
use App\model\UserModel;
use App\model\UseraksesModel;
use App\model\NilaiModel;
use Session;

class listnilaiController extends Controller
{
	private $page = 15;
    public function index(Request $request){
        $data['search'] = "";
    	$data['kelas'] = Mhs18Model::select("kelas")->groupBy("kelas")->get();
        $user = UserModel::where('username',Session::get('username'))->first();
    	$data['list'] = PraktikumModel::where('id_user',$user->id_user)->orderBy('kelas')->paginate($this->page);
    	return view('admin.listnilai',$data);
    }
    public function nilai($id){
    	$data['nilai'] = NilaiModel::select("nilai.*","mhs18.nama")->leftJoin('mhs18','mhs18.npm','=','nilai.npm')->where('id_praktikum',$id)->orderBy('mhs18.no')->get();
    	$data['p'] = PraktikumModel::where('id_praktikum',$id)->first();
    	return view('admin.nilai',$data);	
    	//print_r($data['nilai'][0]['nama']);
    }
}
