@extends('layouts.index')
@section('content')
@php
$no = 1;
    $ar_judul = ['No', 'Nama Buku', 'Nama Anggota', 'Jumlah', 'Tanggal Pinjam', 'Tanggal Kembali',
    'Keterangan','Action'];
@endphp
<a href="{{ route('peminjaman.create') }}" class="btn btn-info btn-user">
  Tambah Pinjaman
</a>
<br/>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Pinjam Buku</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
                @foreach ($ar_judul as $judul)
                <th>{{ $judul }}</th>                    
                @endforeach
            </tr>
          </thead>
          <tfoot>
            <tr>
                @foreach ($ar_judul as $judul)
                <th>{{ $judul }}</th>                    
                @endforeach
            </tr>
          </tfoot>
          <tbody>
            @foreach ($ar_peminjaman as $peminjaman)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $peminjaman->buku }}</td>
                <td>{{ $peminjaman->anggota }}</td>
                <td>{{ $peminjaman->jml }}</td>
                <td>{{ $peminjaman->tgl_pinjam }}</td>
                <td>{{ $peminjaman->tgl_kembali }}</td>
                <td>{{ $peminjaman->keterangan }}</td>
                <td>
                  <form method="POST" action="{{ route('peminjaman.destroy',$peminjaman->id) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('peminjaman.edit',$peminjaman->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" >
                    <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </td>
              </tr>          
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
 