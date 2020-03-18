<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class loginAdminController extends Controller
{
	public function test(){
            echo "a";
	}
    public function index(){
        if(Session::get('admin')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
    }
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $user = 1;//Admin::where('username',$username)->first();
        $process = new Process('python 12jsj.py '.$username.' '.$password);
		$process->run();

		// executes after the command finishes
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
        $json = json_decode($process->getOutput(), true);
        $status = $json['status'];
        if(!empty($user)){
            //if(Hash::check($password, $user->password)){
        	if($status=="loged"){
                /*Session::put('username',$user->username);
                Session::put('admin',TRUE);
                Session::put('id_admin',$user->id_admin);*/
                Session::put('username',$username);
                Session::put('admin', TRUE);
                return redirect('admin/dashboard');
            }else{
                return redirect('admin/dashboard')->with('alert','Username atau password salah!!');
            }
        }else{
            return redirect('admin/dashboard')->with('alert','Username atau password salah!');
        }
    }
    public function logout(){
        Session::flush();
        return redirect(route('admin.loginpage'))->with('alert','Kamu sudah logout');
    }
}
