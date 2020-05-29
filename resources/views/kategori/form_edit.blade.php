@extends('layouts.index')
@section('content')

@php
//panggil master data
@endphp
@foreach ( $data as $rs )
    
<h3>Form Input Kategori</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('kategori.update', $rs->id) }}">
@csrf
@method('PUT')
    <div class="form-group">
        <input type="text" name="nama" class="form-control form-control-user form-control-user @error('nama') is-invalid @enderror" placeholder="Kategori" value="{{ $rs->nama}}">
        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <button type="submit" name="proses" value="ubah" href="login.html" class="btn btn-primary">
         Simpan
    </button>
 </form>
@endforeach
@endsection