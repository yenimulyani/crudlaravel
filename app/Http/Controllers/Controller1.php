<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controller1 extends Controller
{
    public function index(){
        return view('halCtrl1');
    }

    function welcome(){
        echo "selamat datang di training ";
    }
    
}
