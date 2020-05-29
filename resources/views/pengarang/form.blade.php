@extends('layouts.index')
@section('content')
@if ( Auth::user()->role == 'admin')
@php
//panggil master data
@endphp

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
<form class="user" method="POST" action="{{ route('pengarang.store') }}" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" placeholder="Nama Pengarang" value="{{old('nama')}}">
         @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}">
         @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="number" name="hp" class="form-control form-control-user @error('hp') is-invalid @enderror" placeholder="No. HP" value="{{old('hp')}}">
         @error('hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
      <label>Foto Pengarang</label>
        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
         @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <button type="submit" name="proses" value="simpan" href="login.html" class="btn btn-primary">
         Simpan
    </button>
 </form>
@else
  @include('auth.terlarang')
@endif
@endsection