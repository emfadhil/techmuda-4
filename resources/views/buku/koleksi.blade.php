@extends('layouts.index')
@section('content')
@php
$no = 1;
    $ar_judul = ['No', 'ISBN', 'Judul', 'Stok', 'Pengarang',
    'Penerbit','Kategori','Cover','Action'];
@endphp
<a href="{{ url('bukuPDF') }}" class="btn btn-info btn-user">
  <i class="fas fa-file-pdf"></i>Unduh Data Buku
</a>
<a href="{{ url('exportbuku') }}" class="btn btn-info btn-user">
  <i class="fas fa-file-excel"></i>Unduh Data Buku
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
                    <a href="{{ route('buku.show',$buku->id) }}"><i class="fas fa-eye"></i></a>&nbsp;
                </td>
              </tr>          
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>  
@endsection