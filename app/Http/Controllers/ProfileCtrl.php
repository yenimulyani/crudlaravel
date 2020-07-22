<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Users;
use App\Models\Jabatan;
use DB;

class ProfileCtrl extends Controller
{
    //
    public function index(){
        $dataUser = DB::table('karyawan')
        ->join("users", "users.user_id","=","karyawan.karyawan_user_id")
        ->join("jabatan", "jabatan.jabatan_id","=","karyawan.karyawan_jab_id")
        ->where('username', session('username'))->first();
        // dd($dataUser); die();
        return view('profile.profile',[
            'data_user' => $dataUser,
            'jabatan' => DB::table('jabatan')->get(),
        ]);
    }

    public function update($id,Request $request){
        $request->validate([
            'email'=>'required|email',
            'nama'=>'required',
            'gender'=>'required',
            'alamat'=>'required',
            // 'status' => 'required',
            // 'jabatan' => 'required',
        ]);
        $user_id= DB::table('karyawan')
        ->join('users', 'users.user_id','=','karyawan.karyawan_user_id')
        ->where('karyawan_id', $id)
        ->first()->user_id;

        Users::whereUser_id($user_id)->update(['username'=>$request->email]);

        $updateKaryawan = [
            'karyawan_nama' => $request->nama,
            'karyawan_alamat' => $request->alamat,
            'karyawan_gender' => $request->gender,

            'status' => $request->status,
        ];
        Karyawan::whereKaryawan_id($id)->update($updateKaryawan);
        return redirect('profile')->with('succes','Data Tersimpan');
    }
        public function gambar(Request $request){
            $request->validate([
                'image'=>'required|image|max:2048',

            ]);

            $image = $request->file('image');
            $new_name = rand().'.'. $image->getClientOriginalExtension();
            if(!$image->move(public_path('images'),$new_name)){
                return redirect('profile')->with('error','Gambar gagal upload');

            }
            Karyawan::whereKaryawan_id($request->karyawan_id)->update(["karyawan_image"=>"/images/$new_name"]);
            return redirect('profile')->with("success", "Data Profile Berhasil DI Ubah, Silahkan refresh");
        }

}
