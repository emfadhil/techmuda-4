@extends('layouts.index')
@section('content')
<h3>Ubah Password</h3>
@foreach ( $members as $mem )
{{-- <form action="/members/upass/{{ $mem->id }}" method="post"> --}}
<form action="{{url ('/members/upass',$mem->id)}}" method="post">
@csrf
@method('POST')
     <div class="form-group">
        <input type="text" readonly name="email" class="form-control form-control-user" value="{{$mem->email}}"><br/>
        <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password" value="{{$mem->password}}">
         @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
     </div>
     <button type="submit" name="proses" value="simpan" href="login.html" class="btn btn-primary">
         Ubah
    </button>
    <a href="{{ url('members') }}" class="btn btn-primary "><i class="fas fa-caret-square-left"></i> Kembali</a>
 </form>
@endsection
@endforeach