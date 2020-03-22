<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Mhs18Model;
use App\model\PraktikumModel;
use App\model\PraktikumlaModel;
use App\model\UserModel;
use App\model\UseraksesModel;
use App\model\NilaiModel;
use Session;
use File;
use Illuminate\Support\Facades\Hash;

class praktikumController extends Controller
{
	private $page = 15;
    public function index(){
    	$user = UserModel::where('username',Session::get('username'))->first();
    	$data['kelas'] = Mhs18Model::select("kelas")->groupBy("kelas")->get();
    	$data['list'] = PraktikumModel::where('id_user',$user->id_user)->orderBy('kelas')->paginate($this->page);

    	return view('admin.listpraktikum',$data);
    }
    public function tambah(Request $request){
    	$user = UserModel::where("username",Session::get('username'))->first();

    	$praktikum = new PraktikumModel;
    	$praktikum->id_akses = 0;
    	$praktikum->id_user = $user->id_user;
    	$praktikum->nama_praktikum = $request->nama_praktikum;
    	$praktikum->kelas = $request->kelas;
    	$praktikum->pertemuan = $request->pertemuan;
    	$praktikum->save();

        for($i=1;$i<=$request->pertemuan;$i++){
            $la = new PraktikumlaModel;
            $la->id_praktikum = $praktikum->id_praktikum;
            $la->pertemuan = $i;
            $la->save();
        }

    	$usernameNew = $request->kelas.$request->nama_praktikum.$praktikum->id_praktikum;
    	$passwordNew = "nilai123";

    	$addUser = new UserModel;
    	$addUser->username = $usernameNew;
    	$addUser->password = Hash::make($passwordNew);
    	$addUser->role = 2;
    	$addUser->save();

    	$akses = new UseraksesModel;
    	$akses->id_user = $user->id_user;
    	$akses->id_praktikum = $praktikum->id_praktikum;
    	$akses->save();


    	$mhs = Mhs18Model::where('kelas',$request->kelas)->get();

		foreach ($mhs as $key => $value) {
    		$nilai = new NilaiModel;
    		$nilai->id_praktikum = $praktikum->id_praktikum;
    		$nilai->npm = $value->npm;
    		$nilai->kelas = $request->kelas;
    		$nilai->save();
    	}

    	$akses = new UseraksesModel;
    	$akses->id_user = $addUser->id_user;
    	$akses->id_praktikum = $praktikum->id_praktikum;
    	$akses->save();

        $data = array(
            'id_akses' => $akses->id_akses
        );

        PraktikumModel::where('id_praktikum',$praktikum->id_praktikum)->update($data);

    	return back()->with('alert','Praktikum berhasil ditambahkan<br>Silahkan Asisten login dengan :<br> username : '.$usernameNew.'<br>Password : '.$passwordNew);
    }
    public function resetUser($id){
    	$user = UserModel::where('username',Session::get('username'))->first();
    	$akses = UseraksesModel::where([['id_praktikum',"=",$id],["id_user","<>",$user->id_user]])->first();
    	$passwordNew = str_random(8);
    	$data = array(
    		'password' => Hash::make($passwordNew)
    	);
    	$user = UserModel::where('id_user',$akses->id_user)->update($data);
    	$user = UserModel::where('id_user',$akses->id_user)->first();
    	return back()->with('alert','Password telah diupdate<br>Silahkan Asisten login dengan :<br>Username :'.$user->username.'<br>Password : '.$passwordNew);
    }
    public function delete($id){
    	$user = UserModel::where('username',Session::get('username'))->first();
    	$akses = UseraksesModel::where([['id_praktikum',"=",$id],["id_user","<>",$user->id_user]])->first();
    	$user = UserModel::where('id_user',$akses->id_user)->delete();
    	$akses = UseraksesModel::where('id_praktikum',$id)->delete();
    	$praktikum = PraktikumModel::where('id_praktikum',$id)->delete();
    	$nilai = NilaiModel::where('id_praktikum',$id)->delete();
    	return back()->with('alert','Praktikum telah di delete');
    }

    /////file LA
    public function indexLa($id){
        $data['p'] = PraktikumModel::where('id_praktikum',$id)->first();
        $data['file'] = PraktikumlaModel::where('id_praktikum',$id)->get();

        return view('admin.la',$data);
    }
    public function uploadLa(Request $request){
        if(empty($request->file)){
            return back()->with('alert','pilih file terlebih dahulu');
        }
        $path = public_path().'/files/'.$request->id_praktikum;
        if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $file = $request->file('file');
        $file->move($path,$file->getClientOriginalName());


        $data = array(
            "file" => $file->getClientOriginalName()
        );

        PraktikumlaModel::where('id_la',$request->id_la)->update($data);

        return back()->with('alert','File berhasil diunggah');
    }
    public function deleteLa($id){
        $model = PraktikumlaModel::where('id_la',$id);
        $file = $model->first();
        $path = public_path().'/files/'.$file->id_praktikum.'/'.$file->file;
        unlink($path);

        $data = array(
            "file" => '#'
        );

        $model->update($data);

        return back()->with('alert','file berhasil dihapus');
    }
    public function asistenLa(){
        $user = UserModel::where('username',Session::get('username'))->first();
        $akses = UseraksesModel::where('id_user',$user->id_user)->first();
        $data['p'] = PraktikumModel::where('id_akses',$akses->id_akses)->first();
        $data['file'] = PraktikumlaModel::where('id_praktikum',$data['p']->id_praktikum)->get();

        return view('asisten.la',$data);
    }
    public function downloadLa($id){
        $model = PraktikumlaModel::where('id_la',$id);
        $file = $model->first();
        return response()->download(public_path().'/files/'.$file->id_praktikum.'/'.$file->file);
    }
}
