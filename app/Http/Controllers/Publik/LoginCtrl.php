<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB;
class LoginCtrl extends Controller
{

    public function index(){
    // $parse = ['email'=>'yens@gmail.com'];
    // return view('publik/login', $parse);
    if(session('level')){
        return redirect('dashboard');

    }else
    // return redirect('publik/login');

        return view('publik/login');
    }
    public function doLogin(Request $req){
        $req->validate([
            'username'=>'required|email',
            'password'=>'required|min:3',
            
        ]);
            $username = $req->username;
            $password = $req->password;
            $dataUser= DB::table('users')
            ->join('karyawan','users.user_id', '=', 'karyawan.karyawan_user_id')
            ->where([['username','=', $username],
                    ['status','=', 1]
            ])->first();
            // echo $dataUser->password;
            if($dataUser && Hash::check($password, $dataUser->password)){
                Session(['username'=>$username,
                'level'=>$dataUser->karyawan_jab_id,
                'nama'=>$dataUser->karyawan_nama
            ]);
                return redirect('dashboard');
            }
            else{
                return redirect('login')->with("error", 'Username atau password tidak valid');
            }

   
        
    }
    public function logout(){
        auth()->logout();
        session()->flush();
        return redirect('login')->with('error','Berhasil logout');
    }
}
