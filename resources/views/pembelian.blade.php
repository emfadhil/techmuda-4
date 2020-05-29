@extends('layouts.index')
@section('content')

@php
$no = 1;
$p1 = ['nama'=>'Budi', 'produk'=>'TV', 'jumlah'=>2];
$p2 = ['nama'=>'Siti', 'produk'=>'AC', 'jumlah'=>1];
$p3 = ['nama'=>'Dewi', 'produk'=>'Kulkas', 'jumlah'=>3];
$ar_pelanggan = [$p1,$p2,$p3];
$ar_judul = ['No','Nama','Produk','Jumlah','Harga Satuan', 'Hagra Kotor', 'Diskon', 'PPN', 'Harga Bayar'];
@endphp
<h3 align="center">Daftar Pembelian Produk Toko XYZ</h3>
{{-- 
tugas:
1. tentukan harga satuan dgn switch case => TV=2jt, AC=3jt, Kulkas=4jt
2.  tentukan harga kotor(harsat * jml)
3. diskon dgn if elseif => jika beli kulkas minimal 3 diskon 30% dr harga kotor,
jika beli AC min 2 dikskon 20% dr harga kotor,
selain itu semua dapet diskon 10% dr harga kotor
4. ppn 10% (harga kotor- disc) *10%
5. harga bayar (harga kotor-diskon + ppn)
--}}

<table border="1" cellpadding="10" align="center">
   <thead> 
    <tr>
    @foreach ($ar_judul as $jdl)
        <th>{{ $jdl }}</th>
    @endforeach
    </tr>
   </thead>
   <tbody>
    @foreach ($ar_pelanggan as $pelanggan)
    {{-- penentuan harga --}}
    @switch($pelanggan['produk'])
        @case('TV') @php $harga = 2000000; @endphp @break
        @case('AC') @php $harga = 3000000; @endphp @break
        @case('Kulkas') @php $harga = 4000000; @endphp @break
        @default @php $harga = 0; @endphp 
    @endswitch

    {{-- harga kotor --}}
    @php $hrgKotor = $pelanggan['jumlah'] * $harga; @endphp

    {{-- diskon --}}
    @if($pelanggan['produk'] == 'Kulkas' && $pelanggan['jumlah'] >= 3)
       @php $diskon = 0.3 * $hrgKotor; @endphp
    @elseif($pelanggan['produk'] == 'AC' && $pelanggan['jumlah'] >= 2)
       @php $diskon = 0.2 * $hrgKotor; @endphp
    @else
       @php $diskon = 0.1 * $hrgKotor; @endphp
    @endif

    {{-- ppn 10% --}}
    @php $ppn = ($hrgKotor - $diskon) * 0.1; @endphp

    {{-- harga bayar --}}
    @php $hrgBayar = ($hrgKotor - $diskon) + $ppn @endphp
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $pelanggan['nama'] }}</td>
        <td>{{ $pelanggan['produk'] }}</td>
        <td>{{ $pelanggan['jumlah'] }}</td>
        <td>Rp.{{ number_format($harga, 0, ',', '.') }}</td>
        <td>Rp.{{ number_format($hrgKotor, 0, ',', '.') }}</td>
        <td>Rp.{{ number_format($diskon, 0, ',', '.') }}</td>
        <td>Rp.{{ number_format($ppn, 0, ',', '.') }}</td>
        <th>Rp.{{ number_format($hrgBayar, 0, ',', '.') }}</th>
    </tr>
    @endforeach
   </tbody> 
</table>

@endsection

