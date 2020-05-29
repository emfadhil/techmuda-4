@extends('layouts.index')
@section('content')

@php
$ar_gender = ['L'=>'Laki-laki','P'=>'Perempuan'];
@endphp
@foreach ( $data as $rs )    
<h3>Form Input Anggota</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('anggota.update',$rs->id) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
    <div class="form-group">
        <input type="text" name="no_anggota" class="form-control form-control-user @error('no_anggota') is-invalid @enderror" placeholder="Nomor Anggota" value="{{ $rs->no_anggota}}">
         @error('no_anggota')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="text" name="nama" class="form-control form-control-user @error('nama') is-invalid @enderror" placeholder="Nama Anggota" value="{{ $rs->nama }}">
         @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <select  class="form-control @error('gender') is-invalid @enderror" name="gender">
            <option value="">-- jenis kelamin --</option>
        @foreach ($ar_gender as $gender=>$jk )
        @php
        $sel = ($gender == $rs->gender)? 'selected' : '';
        @endphp
            <option value="{{ $gender }}" {{ $sel }} >{{ $jk }}</option>
        @endforeach
        </select>
        @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email" value="{{ $rs->email }}">
         @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <textarea  class="form-control form-control-user @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat Anggota">{{ $rs->alamat }}</textarea>
         @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="number" name="hp" class="form-control form-control-user @error('hp') is-invalid @enderror" placeholder="No. HP" value="{{ $rs->hp }}">
         @error('hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="text" name="tempat_lahir" class="form-control form-control-user @error('tempat_lahir') is-invalid @enderror" placeholder="Tempat Lahir" value="{{ $rs->tempat_lahir }}">
         @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
     <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control form-control-user @error('tanggal_lahir') is-invalid @enderror" value="{{ $rs->tanggal_lahir }}">
         @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
      <label>Foto Anggota</label>
        <input  class="form-control form-control-user @error('foto') is-invalid @enderror" type="file" name="foto" class="form-control" value="{{ $rs->foto }}">
         @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <button type="submit" name="proses" value="update" href="login.html" class="btn btn-primary">
         Simpan
    </button>
 </form>
@endforeach
@endsection