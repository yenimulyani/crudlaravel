<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'Publik\LoginCtrl@index');

Route::get("hal",function(){
    // echo "hello";
    return view('hal');
});
Route::get('ctrl1', 'Controller1@index');
Route::get('welcome', 'Controller1@welcome');

Route::get('ctrl2','Latihan\Controller2@index');
Route::get('welcome2','Latihan\Controller2@welcome');
Route::get('login','Publik\LoginCtrl@index');
Route::get('register','Publik\RegisterCtrl@index');

Route::get('hal3',function(){
    return view('hal3');
});

Route::get('template',function(){
    return view('layout/template');
});

Route::post('daftar','Publik\RegisterCtrl@store');
Route::post('doLogin','Publik\LoginCtrl@doLogin');
// Route::get('dashboard', 'DashboardCtrl@index');
Route::get('logout','Publik\LoginCtrl@logout');


Route::group(["middleware"=>'cekLogin'], function(){
        Route::get('dashboard','DashboardCtrl@index');
        Route::get('profile','ProfileCtrl@index');
        Route::patch('profile/ubah/{id}',['as'=>'profile.ubah', 'uses'=>'ProfileCtrl@update']);
        Route::post('profile/gambar',['as'=>'profile.gambar', 'uses'=>'ProfileCtrl@gambar']);

        // routing admin
        Route::group(["middleware"=>'isAdmin'], function(){

        // Route::get('karyawan','KaryawanCtrl@index');
        Route::resource('karyawan','KaryawanCtrl');
    });

});
