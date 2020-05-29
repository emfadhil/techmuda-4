<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Buku;
use Validator,File,Redirect,Response;
//panggil alias vendor
use PDF; 
use App\Exports\BukuExport;
use Maatwebsite\Excel\Facades\Excel;
class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $ar_buku = DB::table('buku')->get();
        
        // join tabel
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.kategori_id')
        ->select('buku.*', 'pengarang.nama as peng', 'penerbit.nama as pen', 'kategori.nama as kat')
        ->get();
        return view('buku.index', compact('ar_buku'));
    }

    public function koleksiBuku()
    {
        // $ar_buku = DB::table('buku')->get();
        
        // join tabel
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.kategori_id')
        ->select('buku.*', 'pengarang.nama as peng', 'penerbit.nama as pen', 'kategori.nama as kat')
        ->get();
        return view('buku.koleksi', compact('ar_buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //hanya u/ tampilkan form insert data
        return view ('buku.form');
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
            'isbn' => 'required|unique:buku|max:100',
            'judul' => 'required|max:100',
            'tahun_cetak' => 'required|integer',
            'stok' => 'required|integer',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'kategori' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ],
        // menampilkan pesan error jika salah input
        [
            'isbn.required' => 'ISBN Wajib diisi',
            'isbn.unique' => 'ISBN su ada',
            'isbn.max' => 'ISBN maksimal 100 karakter',
            'judul.required' => 'Judul buku wajib diisi',
            'judul.max' => 'Judul maksimal 100 karakter',
            'tahun_cetak.required' => 'Tahun cetak wajib diisi',
            'tahun_cetak.integer' => 'Tahun cetak berupa angka',
            'stok.required' => 'Stok wajib diisi',
            'stok.integer' => 'Stok berupa angka',
            'cover.image' => 'Ekstensi file harus jpg, jpeg,png',
            'cover.max' => 'Ukuran buku terlalu besar',
            'penerbit.required' => 'penerbit Wajib diisi',
            'pengarang.required' => 'pengarang Wajib diisi',
            'kategori.required' => 'kategori Wajib diisi'
            ]
        );


        if(!empty($request->cover)){//proses upload file
            
            $fileName = $request->isbn.'.'.$request->cover->extension();  
            $request->cover->move(public_path('img/buku'), $fileName);
        }
        else{ //tidak ada upload file
            $fileName = '';
        }

        DB::table('buku')->insert(
            //kiri fieldname, kanan request dari name form
            [
                'isbn'=>$request->isbn,
                'judul'=>$request->judul,
                'tahun_cetak'=>$request->tahun_cetak,
                'stok'=>$request->stok,
                'idpenerbit'=>$request->penerbit,
                'idpengarang'=>$request->pengarang,
                'kategori_id'=>$request->kategori,
                'cover'=>$fileName
            ]
            );
            // landing page
            return redirect('/buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.kategori_id')
        ->select('buku.*', 'pengarang.nama as peng', 'penerbit.nama as pen', 'kategori.nama as kat')
        ->where('buku.id','=',$id)
        ->get();
        return view('buku.show', compact('ar_buku'));
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
        $data = Buku::where('id', $id)->get();
        return view ('buku.form_edit', compact('data'));
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
                'isbn' => 'required|max:100',
                'judul' => 'required|max:100',
                'tahun_cetak' => 'required|integer',
                'stok' => 'required|integer',
                'penerbit' => 'required',
                'pengarang' => 'required',
                'kategori' => 'required',
                'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ],
            // menampilkan pesan error jika salah input
            [
                'isbn.required' => 'ISBN Wajib diisi',
                'isbn.max' => 'ISBN maksimal 100 karakter',
                'judul.required' => 'Judul buku wajib diisi',
                'judul.max' => 'Judul maksimal 100 karakter',
                'tahun_cetak.required' => 'Tahun cetak wajib diisi',
                'tahun_cetak.integer' => 'Tahun cetak berupa angka',
                'stok.required' => 'Stok wajib diisi',
                'stok.integer' => 'Stok berupa angka',
                'cover.image' => 'Ekstensi file harus jpg, jpeg,png',
                'cover.max' => 'Ukuran buku terlalu besar',
                'penerbit.required' => 'penerbit Wajib diisi',
                'pengarang.required' => 'pengarang Wajib diisi',
                'kategori.required' => 'kategori Wajib diisi'
                ]
            );
       
        //ambil isi kolom cover untuk hapus fisik file covernya atau sekedar ambil nama filenya
        $cover = DB::table('buku')->select('cover')->where('id',$id)->get();
        foreach($cover as $c){
            $namaFile = $c->cover;
        }
        if(!empty($request->cover)){
            //hapus fisik file cover lama di folder img/pengarang
            File::delete(public_path('img/buku/'.$namaFile));
            //proses upload file cover baru
            $request->validate([
                'file' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $fileName = $request->isbn.'.'.$request->cover->extension();  
            $request->cover->move(public_path('img/buku'), $fileName);
        }
        else{ //tidak ganti cover, nama file tetap foto yg lama
            $fileName = $namaFile;
        }

        DB::table('buku')->where('id',$id)->update(
            //kiri fieldname, kanan request dari name form
            [
                'isbn'=>$request->isbn,
                'judul'=>$request->judul,
                'tahun_cetak'=>$request->tahun_cetak,
                'stok'=>$request->stok,
                'idpenerbit'=>$request->penerbit,
                'idpengarang'=>$request->pengarang,
                'kategori_id'=>$request->kategori,
                'cover'=>$fileName
            ]
            );
            // landing page
            return redirect('/buku'.'/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //ambil isi kolom cover lalu hapus file covernya 
        //di folder img/pengarang
        $cover = DB::table('buku')->select('cover')
                ->where('id',$id)->get();
        foreach($cover as $c){
            $namaFile = $c->cover;
        }
        //hapus fisik file di folder img/buku
        File::delete(public_path('img/buku/'.$namaFile));

        //hapus fisik file di folder img/buku
        File::delete(public_path('img/buku/'.$namaFile));
        DB::table('buku')->where('id',$id)->delete();
            // landing page
            return redirect('/buku');
    }

    public function generatePDF()
    {
        $data = ['title' => 'Coba PDF'];
        $pdf = PDF::loadView('buku/pdf', $data);
  
        return $pdf->download('coba.pdf');
    }

    public function bukuPDF()
    {
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.kategori_id')
        ->select('buku.*', 'pengarang.nama as peng', 'penerbit.nama as pen', 'kategori.nama as kat')
        ->get();

        $pdf = PDF::loadView('buku.bukuPDF',['ar_buku'=>$ar_buku]);
        return $pdf->download('dataBuku.pdf');
    }

    public function bukuExcel() 
    {
        return Excel::download(new BukuExport, 'buku.xlsx');
    }

    
}
