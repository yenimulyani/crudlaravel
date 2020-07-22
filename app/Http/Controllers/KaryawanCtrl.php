<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Users;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Hash;
use DB;

class KaryawanCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Karyawan::all()->sortByDesc('karyawan_id');

        return view('Karyawanctrl.tampil',[
            'karyawan'=> $data
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['jabatan']= Jabatan::all();
        return view('Karyawanctrl.tambah', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|confirmed|min:3',
            'nama'=>'required',

            'gender'=>'required',
            'alamat'=>'required',
            'status' => 'required',
            'jabatan' => 'required',
        ]);


        // simpan ke user , dan karyawan

        $userdata=["username"=>$request->email, 'password'=>Hash::make($request->password)];
        $increment_id = Users::create($userdata)->user_id; ///save ke table user dan ambil id autoincrement
        $dataKaryawan = [

            'karyawan_gender'=>$request->gender,
            'karyawan_nama' =>$request->nama,
            'karyawan_alamat' => $request->alamat,
            'karyawan_jab_id' => 2,
            'karyawan_user_id'=>$increment_id,
            'karyawan_image' => "/images/default.jpg",
            'karyawan_jab_id'=>$request->jabatan,
            'karyawan_status' => $request->status,


        ];
        Karyawan::create($dataKaryawan);
        return redirect('karyawan')->with('succes','Data Tersimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null, $no = null, $nama = null)

    {
      if ('POST' == $_SERVER['Request_Method']){
        echo "IDnya adl :$id diambil dari post method";
      }
      elseif('GET'== $_SERVER['REQUEST_METHOD']){
        echo "IDnya adalah GET : $id <br>";
        echo "IDnya adalah GET : $no <br>";
        echo "IDnya adalah GET : $nama <br>";
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= DB::table('karyawan')
        ->join('users', 'users.user_id','=','karyawan.karyawan_user_id')
        ->where('karyawan_id', $id)
        ->first();
        return view('karyawanctrl.edit',[
            'data_user'=>$data,
            'jabatan' => DB::table('jabatan')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email'=>'required|email',
            'nama'=>'required',
            'gender'=>'required',
            'alamat'=>'required',
            'status' => 'required',
            'jabatan'=> 'required'
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
            'karyawan_jab_id' => $request->jabatan,
            'status' => $request->status,
        ];
        Karyawan::whereKaryawan_id($id)->update($updateKaryawan);
        return redirect('karyawan')->with('succes','Data Tersimpan');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $karyawan = Karyawan::findOrFail($id);
        $user_id = $karyawan->karyawan_user_id;
        $user= Users::findOrFail($user_id);
        $karyawan->delete();
        $user->delete();
        return redirect("karyawan")->with("success", "Data $karyawan->karyawan_nama Berhasil Dihapus");


    }
}
