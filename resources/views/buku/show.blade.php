@extends('layouts.index')
@section('content')
@foreach ( $ar_buku as $buku )
    <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $buku-> judul}}</h6>
         </div>
         <div class="card-body">
         <div class="text-center">
                @if(!empty($buku->cover))                      
                <td><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width:25rem;" src="{{asset ('img/buku')}}/{{ $buku->cover }}" width="30" /></td>
                @else
                <td><img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width:25rem;" src="{{asset ('img')}}/nobook.png" /></td>
                @endif
            </div> 
                  ISBN : {{$buku->isbn}}<br/>
                  Tahun Jumlah : {{$buku->tahun_cetak}}<br/>
                  Stok : {{$buku->stok}}<br/>
                  Pengarang : {{$buku->peng}}<br/>
                  Penerbit : {{$buku->pen}}<br/>
                  Kategori : {{$buku->kat}}<br/>
         @if( Auth::user()->role != 'anggota'))         
         <a href="{{ url('buku') }}" class="btn btn-primary "><i class="fas fa-caret-square-left"></i> Kembali</a>
         @else
         <a href="{{ url('koleksibuku') }}" class="btn btn-primary "><i class="fas fa-caret-square-left"></i> Kembali</a>
         @endif
         </div>
    </div>
@endforeach
@endsection