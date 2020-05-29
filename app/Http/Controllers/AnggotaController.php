<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Anggota;
use Validator,File,Redirect,Response;
use PDF; //panggil alias vendor
class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_anggota = DB::table('anggota')->get();
        return view('anggota.index', compact('ar_anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anggota.form');
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
                'no_anggota' => 'required|unique:anggota|max:45',
                'nama' => 'required|max:45',
                'gender' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required',
                'email' => 'required|email',
                'hp' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ],
            // menampilkan pesan error jika salah input
            [
                'no_anggota.required' => 'No. Anggota Wajib diisi',
                'no_anggota.unique' => 'No. Anggota sudah terpakai',
                'no_anggota.max' => 'No. Anggota lebih dari 45 karakter',
                'nama.required' => 'Nama harus diisi',
                'nama.max' => 'Nama lebih dari 45 karakter',
                'gender.required' => 'Gender harus diisi',
                'tempat_lahir.required' => 'Tempat lahir wajib diisi',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
                'tanggal_lahir.date' => 'Tanggal lahir diisi tanggal',
                'alamat.required' => 'Alamat wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Belum berformat email',
                'hp.required' => 'No. HP wajib diisi',
                'foto.image' => 'Foto harus berekstensi JPG, JPEG, PNG',
                'foto.max' => 'Foto max berukuran 2048kb'
            ]
            );

        if(!empty($request->foto)){//proses upload file
            
            $fileName = $request->nama.'.'.$request->foto->extension();  
            $request->foto->move(public_path('img/anggota'), $fileName);
        }
        else{ //tidak ada upload file
            $fileName = '';
        }
        DB::table('anggota')->insert(
            [ 
                'no_anggota'=>$request->no_anggota,
                'nama'=>$request->nama,
                'gender'=>$request->gender,
                'tempat_lahir'=>$request->tempat_lahir,
                'tanggal_lahir'=>$request->tanggal_lahir,
                'alamat'=>$request->alamat,
                'email'=>$request->email,
                'hp'=>$request->hp,
                'foto'=>$fileName
                //'foto'=>$request->foto,     
            ]);
            //landing page
            return redirect('/anggota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_anggota = DB::table('anggota')->where('id','=', $id)->get(); 
        return view('anggota.show', compact('ar_anggota'));
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
        $data = Anggota::where('id',$id)->get();
        return view('anggota.form_edit',compact('data'));
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
                'no_anggota' => 'required|max:45',
                'nama' => 'required|max:45',
                'gender' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required',
                'email' => 'required|email',
                'hp' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ],
            // menampilkan pesan error jika salah input
            [
                'no_anggota.required' => 'No. Anggota Wajib diisi',
                'no_anggota.max' => 'No. Anggota lebih dari 45 karakter',
                'nama.required' => 'Nama harus diisi',
                'nama.max' => 'Nama lebih dari 45 karakter',
                'gender.required' => 'Gender harus diisi',
                'tempat_lahir.required' => 'Tempat lahir wajib diisi',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
                'tanggal_lahir.date' => 'Tanggal lahir diisi tanggal',
                'alamat.required' => 'Alamat wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Belum berformat email',
                'hp.required' => 'No. HP wajib diisi',
                'foto.image' => 'Foto harus berekstensi JPG, JPEG, PNG',
                'foto.max' => 'Foto max berukuran 2048kb'
            ]
            );
        //ambil isi kolom foto untuk hapus fisik file fotonya atau sekedar ambil nama filenya
        $foto = DB::table('anggota')->select('foto')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFile = $f->foto;
        }
        if(!empty($request->foto)){
            //hapus fisik file foto lama di folder img/anggota
            File::delete(public_path('img/anggota/'.$namaFile));
            //proses upload file foto baru
            $request->validate([
                'file' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $fileName = $request->nama.'.'.$request->foto->extension();  
            $request->foto->move(public_path('img/anggota'), $fileName);
        }
        else{ //tidak ganti foto, nama file tetap foto yg lama
            $fileName = $namaFile;
        }
        DB::table('anggota')->where('id',$id)->update(
            [ 
                'nama'=>$request->nama,
                'gender'=>$request->gender,
                'alamat'=>$request->alamat,
                'tempat_lahir'=>$request->tempat_lahir,
                'tanggal_lahir'=>$request->tanggal_lahir,
                'email'=>$request->email,
                'hp'=>$request->hp,
                'foto'=>$fileName,  
                //'foto'=>$request->foto,
            ]);
        //landing page
        return redirect('/anggota'.'/'.$id);
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
        $foto = DB::table('anggota')->select('foto')
                ->where('id',$id)->get();
        foreach($foto as $f){
            $namaFile = $f->foto;
        }
        //hapus fisik file di folder img/anggota
        File::delete(public_path('img/anggota/'.$namaFile));
        //hapus data anggota
        DB::table('anggota')->where('id',$id)->delete();
        //landing page
        return redirect('/anggota');
    }

    public function anggotaPDF()
    {
        $ar_anggota = DB::table('anggota')->get();
        
        $pdf = PDF::loadView('anggota.anggotaPDF',['ar_anggota'=>$ar_anggota]);
        return $pdf->download('dataAnggota.pdf');
    }
}
