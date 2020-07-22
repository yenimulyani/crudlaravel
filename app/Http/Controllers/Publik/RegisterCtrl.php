<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Karyawan;

use Hash;

class RegisterCtrl extends Controller
{
    //
    public function index(){
        return view('publik/register');
    }

    public function store(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|confirmed|min:3',
            'nama'=>'required',
            'image'=>'required|image|max:2048',
            'gender'=>'required',
            'alamat'=>'required',
        ]);
        // upload image
        $image = $request->file('image');
        $new_name = rand().'.'. $image->getClientOriginalExtension();
        if(!$image->move(public_path('images'),$new_name)){
            return redirect('RegisterCtrl')->with('error','Gambar gagal upload');

        }
        // simpan ke user , dan karyawan
        $userdata=["username"=>$request->email, 'password'=>Hash::make($request->password)];
        $increment_id = Users::create($userdata)->user_id; ///save ke table user dan ambil id autoincrement
        $dataKaryawan = [
            'karyawan_nama'=>$request->nama,
            'karyawan_image'=>"/images/".$new_name,
            'karyawan_gender'=>$request->gender,
            'karyawan_alamat'=>$request->alamat,
            'karyawan_jab_id'=>2,
            'karyawan_user_id'=>$increment_id,

        ];
        Karyawan::create($dataKaryawan);
        return redirect('login')->with('succes','Data Tersimpan');

    }
}
