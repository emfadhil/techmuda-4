@extends('layouts.index')
@section('content')
@if ( Auth::user()->role != 'anggota')

@php
$no = 1;
    $ar_judul = ['No', 'ISBN', 'Judul', 'Stok', 'Pengarang',
    'Penerbit','Kategori','Cover','Action'];
@endphp
<a href="{{ route('buku.create') }}" class="btn btn-info btn-user">
  Tambah Data
</a>
<a href="{{ url('bukuPDF') }}" class="btn btn-danger">
  <i class="fas fa-file-pdf"></i> Unduh Data Buku
</a>
<a href="{{ url('exportbuku') }}" class="btn btn-success">
  <i class="fas fa-file-excel"></i> Unduh Data Buku
</a>
<br/>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Koleksi Buku</h6>
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
            @foreach ($ar_buku as $buku)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $buku->isbn }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->stok }}</td>
                <td>{{ $buku->peng }}</td>
                <td>{{ $buku->pen }}</td>
                <td>{{ $buku->kat }}</td>
                @if(!empty($buku->cover))                      
                      <td><img src="{{asset ('img/buku')}}/{{ $buku->cover }}" width="30" /></td>
                      @else
                      <td><img src="{{asset ('img')}}/nobook.png" width="30" /></td>
                @endif
                <td>
                  <form method="POST" action="{{ route('buku.destroy',$buku->id) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('buku.show',$buku->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('buku.edit',$buku->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
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
@else
  @include('auth.terlarang')
@endif
@endsection
 