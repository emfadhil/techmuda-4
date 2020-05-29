@extends('layouts.index')
@section('content')
@php
$no = 1;
$ar_judul = ['No', 'Nama', 'Action'];
@endphp
<a href="{{ route('kategori.create') }}" class="btn btn-primary ">
    Tambah Kategori
</a>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
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
                    @foreach ( $ar_kategori as $kategori )
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $kategori->nama }}</td>
                      <td>
                        <form method="POST" action="{{ route('kategori.destroy', $kategori->id)}}">
                        @csrf
                        @method('DELETE')
                          <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                          <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
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

@endsection