@extends('layouts.index')
@section('content')
@if ( Auth::user()->role == 'admin')
@php
//panggil master data
@endphp

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
<form class="user" method="POST" action="{{ route('penerbit.store') }}">
@csrf
    <div class="form-group">
        <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" placeholder="Nama Penerbit" value="{{old('nama')}}">
         @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <textarea name="alamat" class="form-control form-control-user" placeholder="Alamat">{{old('alamat')}}</textarea>
         @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}">
         @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="text" name="website" class="form-control form-control-user @error('website') is-invalid @enderror" placeholder="Website" value="{{old('website')}}">
         @error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="number" name="telp" class="form-control form-control-user @error('telp') is-invalid @enderror" placeholder="No. Telepon" value="{{old('telp')}}">
         @error('telp')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="text" name="cp" class="form-control form-control-user @error('cp') is-invalid @enderror" placeholder="Contact Person" value="{{old('cp')}}">
         @error('cp')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <button type="submit" name="proses" value="simpan" href="login.html" class="btn btn-primary">
         Simpan
    </button>
 </form>
@else
  @include('auth.terlarang')
@endif
@endsection