@extends('layouts.index')
@section('content')
@foreach ( $ar_kategori as $kategori )
    <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $kategori-> nama}}</h6>
         <a href="{{ url('kategori') }}" class="btn btn-primary "><i class="fas fa-caret-square-left"></i> Kembali</a>
    </div>
    </div>
@endforeach
@endsection