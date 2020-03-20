<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\model\UserModel;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class loginAsistenController extends Controller
{
	public function test(){
            echo str_random(8);
	}
    public function index(){
        if(Session::get('asisten')){
            return redirect('asisten/dashboard');
        }else{
            return view('asisten.login');
        }
    }
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $user = UserModel::where('username',$username)->first();
        if(!empty($user)){
	        if(Hash::check($password, $user->password)){
	            Session::put('username',$user->username);
	            Session::put('asisten',TRUE);
	            return redirect('asisten/dashboard');
	        }
	    }else{
           	return redirect('asisten/dashboard')->with('alert','Username atau password salah!!');
        }
    }
    public function logout(){
        Session::flush();
        return redirect(route('asisten.loginpage'))->with('alert','Kamu sudah logout');
    }
}

