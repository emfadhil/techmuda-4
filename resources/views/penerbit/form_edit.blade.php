@extends('layouts.index')
@section('content')

@php
//panggil master data
@endphp
@foreach ( $data as $rs )
<h3>Form Input Penerbit</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('penerbit.update', $rs->id) }}">
@csrf
@method('PUT')
    <div class="form-group">
        <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" placeholder="Nama Penerbit" value="{{ $rs->nama }}">
         @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <textarea name="alamat" class="form-control form-control-user @error('alamat') is-invalid @enderror" placeholder="Alamat">{{ $rs->alamat }}</textarea>
         @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email" value="{{ $rs->email }}">
         @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="text" name="website" class="form-control form-control-user @error('website') is-invalid @enderror" placeholder="Website" value="{{ $rs->website }}">
        @error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="text" name="telp" class="form-control form-control-user @error('telp') is-invalid @enderror" placeholder="No. Telepon" value="{{ $rs->telp }}">
        @error('telp')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="text" name="cp" class="form-control form-control-user @error('cp') is-invalid @enderror" placeholder="Contact Person" value="{{ $rs->cp }}">
        @error('cp')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <button type="submit" name="proses" value="ubah_" href="login.html" class="btn btn-primary">
         Simpan
    </button>
 </form>
@endforeach
@endsection