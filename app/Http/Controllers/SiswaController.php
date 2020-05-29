<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dataSiswa(){
        $siswa1 = 'Fawaz'; $alamat1 = 'Tebet';
        $siswa2 = 'Syafiq'; $alamat2 = 'Depok';
        
        return view('siswa',
            compact('siswa1', 'siswa2', 'alamat1', 'alamat2') 
        );
    }

}
