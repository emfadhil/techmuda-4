@extends('layouts.index')
@section('content')
@if ( Auth::user()->role == 'admin')
@php
$no = 1;
$ar_judul = ['No', 'Nama', 'Alamat', 'Email', 'Website', 'Telepon', 'Kontak','Action'];
@endphp
<a href="{{ route('penerbit.create') }}" class="btn btn-primary ">
    Tambah Penerbit
</a>
<a href="{{ url('bukuPDF') }}" class="btn btn-danger">
  <i class="fas fa-file-pdf"></i> Unduh Data Buku
</a>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Penerbit</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    @foreach ($ar_judul as $jdl )
                      <th>{{ $jdl }}</th>  
                    @endforeach
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    @foreach ($ar_judul as $jdl )
                      <th>{{ $jdl }}</th>  
                    @endforeach
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ( $ar_penerbit as $penerbit )
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $penerbit->nama }}</td>
                      <td>{{ $penerbit->alamat }}</td>
                      <td>{{ $penerbit->email }}</td>
                      <td>{{ $penerbit->website }}</td>
                      <td>{{ $penerbit->telp }}</td>
                      <td>{{ $penerbit->cp }}</td>
                      <td>
                        <form method="POST" action="{{ route('penerbit.destroy', $penerbit->id)}}">
                        @csrf
                        @method('DELETE')
                          <a href="{{ route('penerbit.show', $penerbit->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                          <a href="{{ route('penerbit.edit', $penerbit->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin dihapus ?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@else
  @include('auth.terlarang')
@endif
@endsection