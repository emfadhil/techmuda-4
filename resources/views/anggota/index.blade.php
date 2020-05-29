@extends('layouts.index')
@section('content')
@php
$no = 1;
    $ar_judul = ['No', 'No. Anggota', 'Nama', 'Gender', 'Email', "HP", "Foto", 'Action'];
@endphp
<a href="{{ route('anggota.create') }}" class="btn btn-info btn-user">
  Tambah Anggota
</a>
<a href="{{ url('anggotaPDF') }}" class="btn btn-info btn-user">
  Unduh Data Anggota
</a>
<br/>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota Perpus</h6>
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
            @foreach ($ar_anggota as $ang)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $ang->no_anggota }}</td>
                <td>{{ $ang->nama }}</td>
                <td>{{ $ang->gender }}</td>
                <td>{{ $ang->email }}</td>
                <td>{{ $ang->hp }}</td>
                @if(!empty($ang->foto))                      
                      <td><img src="{{asset ('img/anggota')}}/{{ $ang->foto }}" width="30" /></td>
                      @else
                      <td><img src="{{asset ('img')}}/nophoto.png" width="30" /></td>
                @endif
                <td>
                  <form method="POST" action="{{ route('anggota.destroy',$ang->id) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('anggota.show',$ang->id) }} "class="btn btn-primary"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('anggota.edit',$ang->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
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