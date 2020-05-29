<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Members;
use Validator,File,Redirect,Response;
class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_members = DB::table('users')->get();
        return view('members.index', compact('ar_members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.form');
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
                'name' => 'required|unique:users|max:45',
                'email' => 'required|email',
                'role' => 'required',
                'isactive' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ],
            // menampilkan pesan error jika salah input
            [
                'name.required' => 'Nama harus diisi',
                'name.unique' => 'Nama sudah ada',
                'name.max' => 'maksimal 45 karakter',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Harus berformat email',
                'role.required' => 'Role masih kosong',
                'isactive.required' => 'Status masih kosong',
                'foto.image' => 'Harus berformat jpg, jpeg, atau png',
                'foto.max' => 'Maksimal berukuran 2048kb'
            ]
            );

        if(!empty($request->foto)){//proses upload file
            
            $fileName = $request->name.'.'.$request->foto->extension();  
            $request->foto->move(public_path('img/members'), $fileName);
        }
        else{ //tidak ada upload file
            $fileName = '';
        }
        DB::table('users')->insert(
            [ 
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'isactive' => $request->isactive,
                'foto'=>$fileName
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
        $ar_members = DB::table('users')->where('id','=', $id)->get(); 
        return view('members.show', compact('ar_members'));
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
        $data = Members::where('id',$id)->get();
        return view('members.form_edit',compact('data'));
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
                'name' => 'required|max:45',
                'email' => 'required|email',
                'password' => 'required',
                'role' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ],
            // menampilkan pesan error jika salah input
            [
                'name.required' => 'Nama harus diisi',
                'name.max' => 'maksimal 45 karakter',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Harus berformat email',
                'password.required' => 'Password masih kosong',
                'role.required' => 'Role masih kosong',
                'foto.image' => 'Harus berformat jpg, jpeg, atau png',
                'foto.max' => 'Maksimal berukuran 2048kb'
            ]
            );
            //ambil isi kolom foto untuk hapus fisik file fotonya atau sekedar ambil nama filenya
        $foto = DB::table('users')->select('foto')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFile = $f->foto;
        }
        if(!empty($request->foto)){
            //hapus fisik file foto lama di folder img/anggota
            File::delete(public_path('img/members/'.$namaFile));
            //proses upload file foto baru
            $request->validate([
                'file' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);
            $fileName = $request->name.'.'.$request->foto->extension();  
            $request->foto->move(public_path('img/members'), $fileName);
        }
        else{ //tidak ganti foto, nama file tetap foto yg lama
            $fileName = $namaFile;
        }
        DB::table('users')->where('id',$id)->update(
            [ 
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
                'foto'=>$fileName
            ]);
            //landing page
            return redirect('/members');
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
        //di folder img/member
        $foto = DB::table('users')->select('foto')
                ->where('id',$id)->get();
        foreach($foto as $f){
            $namaFile = $f->foto;
        }
        //hapus fisik file di folder img/anggota
        File::delete(public_path('img/members/'.$namaFile));
        //hapus data anggota
        DB::table('users')->where('id',$id)->delete();
        //landing page
        return redirect('/members');
    }

// pembuatan function crud manual 
    public function epass($id){
        $members = DB::table('users')->where('id', $id )->get();
        return view('members.edit_pass',['members' => $members]);
    }

    public function upass(Request $request, $id)
	{
        // update password saja
		DB::table('users')->where('id',$id)->update(
        [
			'password' =>Hash::make($request->input('password')),
		]);
		// alihkan halaman ke halaman member
        return redirect('/members');
    }
    
    public function no(Request $request, $id)
	{
        // merubah isactive jadi no
		DB::table('users')->where('id',$id)->update(
        [
			'isactive' => 'no',
		]);
		// alihkan halaman ke halaman member
        return redirect('/members');
    }
    // merubah isactive jadi yes
    public function yes(Request $request, $id)
	{
        // update password saja
		DB::table('users')->where('id',$id)->update(
        [
			'isactive' => 'yes',
		]);
		// alihkan halaman ke halaman member
        return redirect('/members');
    }
}
