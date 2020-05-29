@extends('layouts.index')
@section('content')

@php
//panggil master data
@endphp

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
<form class="user" method="POST" action="{{ route('kategori.store') }}">
@csrf
    <div class="form-group">
        <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" placeholder="Kategori" value="{{old('nama')}}">
            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <button type="submit" name="proses" value="simpan" href="login.html" class="btn btn-primary">
         Simpan
    </button>
 </form>
@endsection