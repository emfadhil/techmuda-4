@extends('layouts.index')
@section('content')
@php
//panggil master data
$rs1 = App\Buku::all();
$rs2 = App\Anggota::all();
@endphp
@foreach ( $data as $rs )
<h3>Form Edit Peminjaman</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('peminjaman.update',$rs->id) }}">
@csrf
@method('PUT')
    <div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
         <select name="idbuku" class="form-control @error('idbuku') is-invalid @enderror">
            <option value="">-- Pilih Buku--</option>
            @foreach ( $rs1 as $idbuku )
                @php $sel = ($rs->idbuku == $idbuku['id'])? 'selected' : ''; @endphp
                <option value="{{ $idbuku['id'] }}" {{$sel}}>{{ $idbuku['judul'] }}</option>
            @endforeach
         </select>
          @error('idbuku')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-sm-6">
         <select name="idanggota" class="form-control form-control @error('idanggota') is-invalid @enderror">
            <option value="">-- Pilih Anggota--</option>
            @foreach ( $rs2 as $idanggota )
            @php $sel2 = ($rs->idanggota == $idanggota['id'])? 'selected' : ''; @endphp
                <option value="{{ $idanggota['id'] }}" {{$sel2}}>{{ $idanggota['nama'] }}</option>
            @endforeach
         </select>
         @error('idanggota')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    </div>
    <div class="col-sm-6">
         <label>Jumlah</label>
        <input type="number" name="jml" class="form-control @error('jml') is-invalid @enderror" value="{{ $rs->jml }}">
        @error('jml')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-sm-6">
         <label>Tanggal Pinjam</label>
        <input type="date" name="tgl_pinjam" class="form-control @error('tgl_pinjam') is-invalid @enderror" value="{{ $rs->tgl_pinjam }}">
        @error('tgl_pinjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-sm-6">
         <label>Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" class="form-control @error('tgl_kembali') is-invalid @enderror" value="{{ $rs->tgl_kembali }}">
        @error('tgl_kembali')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-sm-6">
         <label>Keterangan</label>
        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">
            {{ $rs->keterangan }}
        </textarea>
        @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
     <button type="submit" name="proses" value="simpan" href="login.html" class="btn btn-primary">
         Simpan
    </button>
 </form>
@endsection
@endforeach