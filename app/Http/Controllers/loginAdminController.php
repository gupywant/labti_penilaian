<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\model\UserModel;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class loginAdminController extends Controller
{
	public function test(){
            echo str_random(8);
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
        $user = UserModel::where('username',$username)->first();
        if(!empty($user)){
	        if(Hash::check($password, $user->password)){
	            Session::put('username',$user->username);
	            Session::put('admin',TRUE);
	            return redirect('admin/dashboard');
	        }
	    }elseif(empty($user)) {
            $process = new Process('python 12jsj.py '.$username.' '.$password);
			$process->run();

			// executes after the command finishes
			if (!$process->isSuccessful()) {
			    throw new ProcessFailedException($process);
			}
	        $json = json_decode($process->getOutput(), true);
	        $status = $json['status'];
	    	if($status=="loged"){
	    		$user = new UserModel;
	    		$user->username = $username;
	    		$user->password = Hash::make($password);
	    		$user->role = 1;
	    		$user->save();
	            Session::put('username',$username);
	            Session::put('admin', TRUE);
	            return redirect('admin/dashboard');
	        }else{
            	return redirect('admin/dashboard')->with('alert','Username atau password salah!!');
        	}
        }
    }
    public function logout(){
        Session::flush();
        return redirect(route('admin.loginpage'))->with('alert','Kamu sudah logout');
    }
}
