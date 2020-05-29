@extends('layouts.index')
@section('content')
@if ( Auth::user()->role == 'admin')
@php
$no = 1;
    $ar_judul = ['No', 'Nama', 'Email', 'Role', 'Status', 'Foto', 'Action'];
@endphp
<a href="{{ route('members.create') }}" class="btn btn-info btn-user">
  Tambah Member
</a>
<br/>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Member Perpus</h6>
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
            @foreach ($ar_members as $mem)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $mem->name }}</td>
                <td>{{ $mem->email }}</td>
                <td>{{ $mem->role }}</td>
                <td>{{ $mem->isactive }}</td>
                @if(!empty($mem->foto))                      
                      <td><img src="{{asset ('img/members')}}/{{ $mem->foto }}" width="30" /></td>
                      @else
                      <td><img src="{{asset ('img')}}/nophoto.png" width="30" /></td>
                @endif
                <td>
                  <form method="POST" action="{{ route('members.destroy',$mem->id) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('members.show',$mem->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('members.edit',$mem->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    {{-- <a href="members/epass/{{ $mem->id }}" class="btn btn-warning">Edit Password</a> --}}
                    <a href="{{ url('members/epass',$mem->id) }}" class="btn btn-warning"><i class="fas fa-key"></i></a>
                    @if($mem->isactive == 'yes')
                    <a href="{{ url('members/no',$mem->id) }}" class="btn btn-success"><i class="fas fa-ban"></i></a>
                    <input type="hidden" name="status" value="{{ $mem->isactive }}" />
                    @else
                    <a href="{{ url('members/yes',$mem->id) }}" class="btn btn-warning"><i class="fas fa-check"></i></a>
                    <input type="hidden" name="status" value="{{ $mem->isactive }}" />
                    @endif
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