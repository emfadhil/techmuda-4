@extends('layouts.index')
@section('content')
@php
    $ar_role = ['admin'=>'admin','staff'=>'staff','anggota'=>'anggota'];
    $ar_isactive = ['yes'=>'yes','no'=>'no'];
@endphp
<h3>Form Edit Members</h3>
@foreach ( $data as $rs )
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('members.update',$rs->id) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
    <div class="form-group">
        <input type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" placeholder="Nama Member" value="{{$rs->name}}">
         @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email Member" value="{{$rs->email}}">
         @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <select  class="form-control @error('role') is-invalid @enderror" name="role">
            <option value="">-- Hak Akses --</option>
               @foreach ( $ar_role as $role => $val )
               @php $sel = ($rs->role == $val)? 'selected' : ''; @endphp
            <option value="{{$val}}" {{$sel}}>{{$role}}</option>
               @endforeach
        </select>
        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
      <label>Foto Member</label>
        <input  class="form-control form-control-user @error('foto') is-invalid @enderror" type="file" name="foto" class="form-control">
         @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <button type="submit" name="proses" value="simpan" href="login.html" class="btn btn-primary">
         Update
    </button>
    <a href="{{ url('members') }}" class="btn btn-primary "><i class="fas fa-caret-square-left"></i> Kembali</a>
 </form>
@endsection
@endforeach