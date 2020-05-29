@php
$no = 1;
$s1 = ['nama'=>'Budi', 'nilai'=>77];
$s2 = ['nama'=>'Siti', 'nilai'=>98];
$s3 = ['nama'=>'Dewi', 'nilai'=>59];
$ar_siswa = [$s1,$s2,$s3];
$ar_judul = ['No','Nama','Nilai','Keterangan','Grade','Predikat'];
@endphp
<h3 align="center">Daftar Nilai Siswa</h3>
<table border="1" cellpadding="10" align="center">
  <thead>
    <tr>
    @foreach($ar_judul as $jdl)
      <th>{{ $jdl }}</th>
    @endforeach 
    </tr>
  </thead>
  <tbody>
      @foreach ($ar_siswa as $siswa)
        {{-- uji kelululusan --}}
        @php 
        $ket = ($siswa['nilai'] >= 60) ? 'Lulus' : 'Gagal';   
        @endphp
        {{-- uji grade --}}
        @if($siswa['nilai'] >= 86 && $siswa['nilai'] <= 100) @php $grade = 'A'; @endphp
        @elseif($siswa['nilai'] >= 76 && $siswa['nilai'] < 86) @php $grade = 'B'; @endphp
        @elseif($siswa['nilai']>= 60 && $siswa['nilai'] < 76) @php $grade = 'C'; @endphp
        @elseif($siswa['nilai'] >= 31 && $siswa['nilai'] < 60) @php $grade = 'D'; @endphp
        @elseif($siswa['nilai'] >= 0 && $siswa['nilai'] < 31) @php $grade = 'E'; @endphp
        @else @php $grade = ''; @endphp
        @endif
        {{-- uji predikat--}}
        @switch($grade)
            @case('A') @php $predikat = 'Memuaskan'; @endphp  @break
            @case('B') @php $predikat = 'Baik'; @endphp @break
            @case('C') @php $predikat = 'Cukup'; @endphp @break
            @case('D') @php $predikat = 'Kurang'; @endphp @break
            @case('E') @php $predikat = 'Buruk'; @endphp @break
            @default @php $predikat = ''; @endphp
        @endswitch
          <tr>
              <td>{{ $no++}}</td>
              <td>{{ $siswa['nama']}}</td>
              <td>{{ $siswa['nilai']}}</td>
              <td>{{ $ket }}</td>
              <td>{{ $grade }}</td>
              <td>{{ $predikat }}</td>
          </tr>    
      @endforeach
  </tbody>