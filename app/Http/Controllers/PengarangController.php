<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pengarang;
use Validator,File,Redirect,Response;
use PDF; //panggil alias vendor
class PengarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_pengarang = DB::table('pengarang')->get(); 
        return view('pengarang.index', compact('ar_pengarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //hanya u/ tampilkan form insert data
         return view('pengarang.form');
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
                'hp' => 'max:45',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ],
            // menampilkan pesan error jika salah input
            [
                'nama.required' => 'Nama harus diisi',
                'nama.max' => 'Nama lebih dari 45 karakter',
                'email.email' => 'Belum berformat email',
                'hp.max' => 'No. HP max 15 digit',
                'foto.image' => 'Foto harus berekstensi JPG, JPEG, PNG',
                'foto.max' => 'Foto max berukuran 2048kb'
            ]
            );

        if(!empty($request->foto)){//proses upload file
           
            $fileName = $request->nama.'.'.$request->foto->extension();  
            $request->foto->move(public_path('img/pengarang'), $fileName);
        }
        else{ //tidak ada upload file
            $fileName = '';
        }
        DB::table('pengarang')->insert(
            [ 
                'nama'=>$request->nama,
                'email'=>$request->email,
                'hp'=>$request->hp,
                'foto'=>$fileName,
                //'foto'=>$request->foto,     
            ]);
            //landing page
            return redirect('/pengarang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_pengarang = DB::table('pengarang')
                        ->where('id','=', $id)
                        ->get(); 
        return view('pengarang.show', compact('ar_pengarang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //ambil 1 baris data yg mau diedit
        $data = Pengarang::where('id',$id)->get();
        return view('pengarang.form_edit',compact('data'));
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
                'hp' => 'max:45',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ],
            // menampilkan pesan error jika salah input
            [
                'nama.required' => 'Nama harus diisi',
                'nama.max' => 'Nama lebih dari 45 karakter',
                'email.email' => 'Belum berformat email',
                'hp.max' => 'No. HP max 15 digit',
                'foto.image' => 'Foto harus berekstensi JPG, JPEG, PNG',
                'foto.max' => 'Foto max berukuran 2048kb'
            ]
            );
        //ambil isi kolom foto untuk hapus fisik file fotonya atau sekedar ambil nama filenya
        $foto = DB::table('pengarang')->select('foto')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFile = $f->foto;
        }
        if(!empty($request->foto)){
            //hapus fisik file foto lama di folder img/pengarang
            File::delete(public_path('img/pengarang/'.$namaFile));
            //proses upload file foto baru
            $fileName = $request->nama.'.'.$request->foto->extension();  
            $request->foto->move(public_path('img/pengarang'), $fileName);
        }
        else{ //tidak ganti foto, nama file tetap foto yg lama
            $fileName = $namaFile;
        }
        DB::table('pengarang')->where('id',$id)->update(
            [ 
                'nama'=>$request->nama,
                'email'=>$request->email,
                'hp'=>$request->hp,
                'foto'=>$fileName,  
                //'foto'=>$request->foto,
            ]);
        //landing page
        return redirect('/pengarang'.'/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //ambil isi kolom foto lalu hapus file fotonya 
        //di folder img/pengarang
        $foto = DB::table('pengarang')->select('foto')
                ->where('id',$id)->get();
        foreach($foto as $f){
            $namaFile = $f->foto;
        }
        //hapus fisik file di folder img/pengarang
        File::delete(public_path('img/pengarang/'.$namaFile));
        //hapus data pengarang
        DB::table('pengarang')->where('id',$id)->delete();
        //landing page
        return redirect('/pengarang');
    }

    public function pengarangPDF()
    {
        $ar_pengarang = DB::table('pengarang')->get();
        
        $pdf = PDF::loadView('pengarang.pengarangPDF',['ar_pengarang'=>$ar_pengarang]);
        return $pdf->download('dataPengarang.pdf');
    }
}