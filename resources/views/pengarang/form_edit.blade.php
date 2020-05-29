@extends('layouts.index')
@section('content')

@php
//panggil master data
@endphp
@foreach ( $data as $rs )
<h3>Form Input Pengarang</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('pengarang.update',$rs->id) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
    <div class="form-group">
        <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" placeholder="Nama Pengarang" value="{{ $rs->nama }}">
         @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
     <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email" value="{{ $rs->email }}">
         @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="text" name="hp" class="form-control form-control-user @error('hp') is-invalid @enderror" placeholder="No. HP" value="{{ $rs->hp }}">
         @error('hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" value="{{ $rs->foto }}">
        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <button type="submit" name="proses" value="update" href="login.html" class="btn btn-primary">
         Simpan
    </button>
 </form>
@endforeach
@endsection