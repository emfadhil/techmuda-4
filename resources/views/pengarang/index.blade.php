@extends('layouts.index')
@section('content')
@if ( Auth::user()->role == 'admin')
@php
$no = 1;
$ar_judul = ['No', 'Nama', 'Email', 'Telepon', 'Foto','Action'];
@endphp
<a href="{{ route('pengarang.create') }}" class="btn btn-primary ">
    Tambah Pengarang
</a>
<a href="{{ url('bukuPDF') }}" class="btn btn-danger">
  <i class="fas fa-file-pdf"></i> Unduh Data Buku
</a>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Pengarang</h6>
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
                    @foreach ( $ar_pengarang as $pengarang )
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $pengarang->nama }}</td>
                      <td>{{ $pengarang->email }}</td>
                      <td>{{ $pengarang->hp }}</td>
                      {{-- <td>{{ $pengarang->foto }}</td> --}}
                      @if(!empty($pengarang->foto))                      
                      <td><img src="{{asset ('img/pengarang')}}/{{ $pengarang->foto }}" width="30" /></td>
                      @else
                      <td><img src="{{asset ('img')}}/nophoto.png" width="30" /></td>
                      @endif
                      <td>
                        <form method="POST" action="{{ route('pengarang.destroy', $pengarang->id)}}">
                        @csrf
                        @method('DELETE')
                          <a href="{{ route('pengarang.show', $pengarang->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                          <a href="{{ route('pengarang.edit', $pengarang->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
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