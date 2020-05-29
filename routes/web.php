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
// belajar routing
Route::get('/hello', function () {  //tes konsep route
    return view('salam');   
});

Route::get('/nilai', function () {  //tes konsep route
    return view('nilai_siswa');   
});

Route::get('/salam', function () {  //tes konsep route tanpa view
    return 'Assalamualaikum';   
});

Route::get('/user/{id}', function ($id) {  //tes konsep route tanpa view dengan parameter
    return 'ID User '.$id;   
});

Route::get('/user/{nama}/{pekerjaan}', function ($nama, $pekerjaan) {  //tes konsep route tanpa view dua parameter
    return 'Nama Anda: '.$nama.', Pekerjaan anda : '.$pekerjaan;   
});

Route::get('/nilai2', function () {  //tes konsep route dengan view pakai blade
    return view('nilaiSiswa');   
});

//tes konsep route dengan controller
Route::get('/siswa', 'SiswaController@dataSiswa');

Route::get('/belanja', function () {  //tes konsep route dengan view pakai blade
    return view('pembelian');   
});
// --------------------------------------------------------------------------------------

// Route::get('/', function () {
//     return view('welcome');   
// });

// clear cache
Route::get('/clear-cache',function(){
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


// routing aplikasi

// Route::get('/', 'BukuController@index')->middleware('auth');
// mengarahkan route langsung ke index buku
Route::resource('penerbit', 'PenerbitController')->middleware('auth');
Route::get('penerbitPDF','PenerbitController@penerbitPDF')->middleware('auth');

Route::resource('pengarang', 'PengarangController')->middleware('auth');  
Route::get('pengarangPDF','PengarangController@pengarangPDF')->middleware('auth');

Route::resource('buku', 'BukuController')->middleware('auth');
Route::get('/', 'BukuController@koleksibuku')->middleware('auth');
Route::get('koleksibuku','BukuController@koleksiBuku')->middleware('auth');
Route::get('pdf','BukuController@generatePDF')->middleware('auth');
Route::get('bukuPDF','BukuController@bukuPDF')->middleware('auth');
Route::get('exportbuku','BukuController@bukuExcel')->middleware('auth');

Route::resource('anggota', 'AnggotaController')->middleware('auth');
Route::get('anggotaPDF','AnggotaController@anggotaPDF')->middleware('auth');

Route::resource('members', 'MembersController')->middleware('auth');
Route::get('members/epass/{id}', 'MembersController@epass')->middleware('auth'); //route ke function buatan sendiri edit pass
Route::post('members/upass/{id}', 'MembersController@upass')->middleware('auth'); //route ke function buatan sendiri update pass
Route::get('members/no/{id}', 'MembersController@no')->middleware('auth'); //route ke function buatan sendiri update isactive
Route::get('members/yes/{id}', 'MembersController@yes')->middleware('auth'); //route ke function buatan sendiri update isactive

Route::resource('peminjaman', 'PeminjamanController')->middleware('auth');

Route::resource('kategori', 'KategoriController')->middleware('auth'); 

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/afterregister', function () {  //tes konsep route dengan view pakai blade
    return view('afterregister');   
});