@extends('layouts.index')
@section('content')
@if ( Auth::user()->role == 'admin')
@php
    $ar_role = ['admin'=>'admin','staff'=>'staff','anggota'=>'anggota'];
    $ar_isactive = ['yes'=>'yes','no'=>'no'];
@endphp
<h3>Form Input Members</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <input type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" placeholder="Nama Member" value="{{old('name')}}">
         @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email Member" value="{{old('email')}}">
         @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Email Member" value="{{old('password')}}">
         @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <select  class="form-control @error('role') is-invalid @enderror" name="role">
            <option value="">-- Hak Akses --</option>
               @foreach ( $ar_role as $role => $val )
               @php $sel = (old('role')==$val)? 'selected' : ''; @endphp
            <option value="{{$val}}" {{$sel}}>{{$role}}</option>
               @endforeach
        </select>
        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
        <select  class="form-control @error('isactive') is-invalid @enderror" name="isactive">
            <option value="">-- status --</option>
               @foreach ( $ar_isactive as $isactive => $val )
               @php $sel = (old('isactive')==$val)? 'selected' : ''; @endphp
            <option value="{{$val}}" {{$sel}}>{{$isactive}}</option>
               @endforeach
        </select>
        @error('isactive')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <div class="form-group">
      <label>Foto Member</label>
        <input  class="form-control form-control-user @error('foto') is-invalid @enderror" type="file" name="foto" class="form-control">
         @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <button type="submit" name="proses" value="simpan" href="login.html" class="btn btn-primary">
         Simpan
    </button>
    <a href="{{ url('members') }}" class="btn btn-primary "><i class="fas fa-caret-square-left"></i> Kembali</a>
 </form>
@else
  @include('auth.terlarang')
@endif 
@endsection