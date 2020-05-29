@extends('layouts.index')
@section('content')
@foreach ( $ar_pengarang as $pengarang )
    <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pengarang-> nama}}</h6>
         </div>
         <div class="card-body">
            <div class="text-center">
                @if(!empty($pengarang->foto))                      
                <td><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width:25rem;" src="{{asset ('img/pengarang')}}/{{ $pengarang->foto }}" width="30" /></td>
                @else
                <td><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width:25rem;" src="{{asset ('img')}}/nophoto.png" /></td>
                @endif
            </div>          
                  Email : {{$pengarang->email}}<br/>
                  No. HP : {{$pengarang->hp}}<br/>
         <a href="{{ url('pengarang') }}" class="btn btn-primary "><i class="fas fa-caret-square-left"></i> Kembali</a>
         </div>
    </div>
@endforeach
@endsection