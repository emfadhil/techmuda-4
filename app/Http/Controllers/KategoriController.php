<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// tambahan
use DB;
use App\Kategori;
use Validator,File,Redirect,Response;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_kategori = DB::table('kategori')->get();
        return view('kategori.index', compact('ar_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //hanya u/ tampilkan form insert data
        return view ('kategori.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validasi = $request->validate(
            // mendefinisikan rule validasi data
            [
                'nama' => 'required|unique:kategori|max:45',
            ],
            // menampilkan pesan error jika salah input
            [
                'nama.required' => 'Kategori harus diisi',
                'nama.unique' => 'Kategori sudah ada',
                'nama.max' => 'Max 45 karakter',
            ]
            );
        DB::table('kategori')->insert(
            //kiri fieldname, kanan request dari name form
            [
                'nama'=>$request->nama
            ]
            );
            // landing page
            return redirect('/kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_kategori = DB::table('kategori')
        ->where('id','=',$id)
        ->get();
        return view('kategori.show', compact('ar_kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // ambil 1 baris data yg mau diedit
        $data = Kategori::where('id', $id)->get();
        return view ('kategori.form_edit', compact('data'));
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
        $validasi = $request->validate(
            // mendefinisikan rule validasi data
            [
                'nama' => 'required|max:45',
            ],
            // menampilkan pesan error jika salah input
            [
                'nama.required' => 'Kategori harus diisi',
                'nama.max' => 'Max 45 karakter',
            ]
            );
        DB::table('kategori')->where('id',$id)->update(
            //kiri fieldname, kanan request dari name form
            [
                'nama'=>$request->nama
            ]
            );
            // landing page
            return redirect('/kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('kategori')->where('id',$id)->delete();
            // landing page
            return redirect('/kategori');
    }
}
