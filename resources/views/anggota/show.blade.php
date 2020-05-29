@extends('layouts.index')
@section('content')
@foreach ( $ar_anggota as $anggota )
    <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $anggota-> nama}}</h6>
         </div>
         <div class="card-body">
            <div class="text-center">
                @if(!empty($anggota->foto))                      
                <td><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width:25rem;" src="{{asset ('img/anggota')}}/{{ $anggota->foto }}" width="30" /></td>
                @else
                <td><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width:25rem;" src="{{asset ('img')}}/nophoto.png" /></td>
                @endif
            </div>          
                  No Anggota: {{$anggota->no_anggota}}<br/>
                  Gender: {{$anggota->gender}}<br/>
                  Alamat: {{$anggota->alamat}}<br/>
                  Tempat Lahir: {{$anggota->tempat_lahir}}<br/>
                  Tanggal Lahir: {{$anggota->tanggal_lahir}}<br/>
                  Email : {{$anggota->email}}<br/>
                  No. HP : {{$anggota->hp}}<br/>
         <a href="{{ url('anggota') }}" class="btn btn-primary "><i class="fas fa-caret-square-left"></i> Kembali</a>

         </div>
    </div>
@endforeach
@endsection