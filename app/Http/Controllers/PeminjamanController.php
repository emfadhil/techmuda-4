<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Peminjaman;
use App\Anggota;
use App\Buku;
use Validator,File,Redirect,Response;
class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_peminjaman = DB::table('peminjaman')
        ->join('anggota', 'anggota.id', '=', 'peminjaman.idanggota')
        ->join('buku', 'buku.id', '=', 'peminjaman.idbuku')
        ->select('peminjaman.*', 'anggota.nama as anggota', 'buku.judul as buku')
        ->get();
        return view('peminjaman.index', compact('ar_peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //hanya u/ tampilkan form insert data
        return view ('peminjaman.form');
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
                'idbuku' => 'required',
                'idanggota' => 'required',
                'jml' => 'required|integer',
                'tgl_pinjam' => 'required|date',
                'tgl_kembali' => 'required|date',
            ],
            // menampilkan pesan error jika salah input
            [
                'idbuku.required' => 'Buku belum dipilih',
                'idanggota.required' => 'Anggota belum dipilih',
                'jml.required' => 'Jumlah harus dipilih',
                'jml.integer' => 'Harus berupa angka',
                'tgl_pinjam.required' => 'Tanggal pinjam masih kosong',
                'tgl_pinjam.date' => 'Harus berupa tanggal',
                'tgl_kembali.required' => 'Tanggal kembali harus diisi',
                'tgl_kembali.date' => 'Harus berupa tanggal'
            ]
            );

        DB::table('peminjaman')->insert(
            //kiri fieldname, kanan request dari name form
            [
                'idbuku'=>$request->idbuku,
                'idanggota'=>$request->idanggota,
                'jml'=>$request->jml,
                'tgl_pinjam'=>$request->tgl_pinjam,
                'tgl_kembali'=>$request->tgl_kembali,
                'keterangan'=>$request->keterangan
            ]
            );
            // landing page
            return redirect('/peminjaman');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_peminjaman = DB::table('peminjaman')
        ->where('id','=',$id)
        ->get();
        return view('peminjaman.show', compact('ar_peminjaman'));
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
        $data = Peminjaman::where('id', $id)->get();
        return view ('peminjaman.form_edit', compact('data'));
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
                'idbuku' => 'required',
                'idanggota' => 'required',
                'jml' => 'required|integer',
                'tgl_pinjam' => 'required|date',
                'tgl_kembali' => 'required|date',
            ],
            // menampilkan pesan error jika salah input
            [
                'idbuku.required' => 'Buku belum dipilih',
                'idanggota.required' => 'Anggota belum dipilih',
                'jml.required' => 'Jumlah harus dipilih',
                'jml.integer' => 'Harus berupa angka',
                'tgl_pinjam.required' => 'Tanggal pinjam masih kosong',
                'tgl_pinjam.date' => 'Harus berupa tanggal',
                'tgl_kembali.required' => 'Tanggal kembali harus diisi',
                'tgl_kembali.date' => 'Harus berupa tanggal'
            ]
            );
        DB::table('peminjaman')->where('id',$id)->update(
            //kiri fieldname, kanan request dari name form
            [
                'idbuku'=>$request->idbuku,
                'idanggota'=>$request->idanggota,
                'jml'=>$request->jml,
                'tgl_pinjam'=>$request->tgl_pinjam,
                'tgl_kembali'=>$request->tgl_kembali,
                'keterangan'=>$request->keterangan
            ]
            );
            // landing page
            return redirect('/peminjaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('peminjaman')->where('id',$id)->delete();
            // landing page
            return redirect('/peminjaman');
    }
}
