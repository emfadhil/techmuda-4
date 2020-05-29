<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// tambahan
use DB;
use App\Penerbit;
use Validator,File,Redirect,Response;
use PDF; //panggil alias vendor
class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_penerbit = DB::table('penerbit')->get();
        return view('penerbit.index', compact('ar_penerbit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //hanya u/ tampilkan form insert data
        return view ('penerbit.form');
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
                'nama' => 'required|max:45',
                'email' => 'email',
                'website' => 'max:45',
                'hp' => 'max:15',
                'cp' => 'max:45'
            ],
            // menampilkan pesan error jika salah input
            [
                'nama.required' => 'Nama Wajib diisi',
                'nama.max' => 'max 45 karakter',
                'email.email' => 'Harus berformat email',
                'website.max' => 'max 45 karakter',
                'hp.max' => 'max 15 karakter',
                'cp.max' => 'max 45 karakter',
            ]
            );

        DB::table('penerbit')->insert(
            //kiri fieldname, kanan request dari name form
            [
                'nama'=>$request->nama,
                'alamat'=>$request->alamat,
                'email'=>$request->email,
                'website'=>$request->website,
                'telp'=>$request->telp,
                'cp'=>$request->cp
            ]
            );
            // landing page
            return redirect('/penerbit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_penerbit = DB::table('penerbit')
        ->where('id','=',$id)
        ->get();
        return view('penerbit.show', compact('ar_penerbit'));
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
        $data = Penerbit::where('id', $id)->get();
        return view ('penerbit.form_edit', compact('data'));
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
                'email' => 'email',
                'website' => 'max:45',
                'hp' => 'max:15',
                'cp' => 'max:45'
            ],
            // menampilkan pesan error jika salah input
            [
                'nama.required' => 'Nama Wajib diisi',
                'nama.max' => 'max 45 karakter',
                'email.email' => 'Harus berformat email',
                'website.max' => 'max 45 karakter',
                'hp.max' => 'max 15 karakter',
                'cp.max' => 'max 45 karakter',
            ]
            );
        DB::table('penerbit')->where('id',$id)->update(
            //kiri fieldname, kanan request dari name form
            [
                'nama'=>$request->nama,
                'alamat'=>$request->alamat,
                'email'=>$request->email,
                'website'=>$request->website,
                'telp'=>$request->telp,
                'cp'=>$request->cp
            ]
            );
            // landing page
            return redirect('/penerbit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('penerbit')->where('id',$id)->delete();
            // landing page
            return redirect('/penerbit');
    }

    public function penerbitPDF()
    {
        $ar_penerbit = DB::table('penerbit')->get();
        
        $pdf = PDF::loadView('penerbit.penerbitPDF',['ar_penerbit'=>$ar_penerbit]);
        return $pdf->download('dataPenerbit.pdf');
    }
}
