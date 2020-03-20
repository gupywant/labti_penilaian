<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function indexAsisten(){
        return view('asisten.dashboard');
    }
}
