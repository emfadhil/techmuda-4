<?php

namespace App\Exports;

use App\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
class BukuExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $ar_buku = DB::table('buku')
        ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
        ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
        ->join('kategori', 'kategori.id', '=', 'buku.kategori_id')
        ->select('buku.isbn','buku.judul','buku.tahun_cetak','buku.stok', 
            'pengarang.nama as peng', 'penerbit.nama as pen', 'kategori.nama as kat')
        ->get();

        return $ar_buku;
        // return Buku::all();
    }
}
