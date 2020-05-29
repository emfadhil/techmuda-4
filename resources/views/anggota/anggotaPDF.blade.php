
@php
$no = 1;
    $ar_judul = ['No', 'No. Anggota', 'Nama', 'Gender', 'Email', "HP", "Foto"];
@endphp
      <h6 align="center">Daftar Anggota Perpus</h6>
        <table align="center" border="1" cellspacing="0">
          <thead>
            <tr>
                @foreach ($ar_judul as $judul)
                <th>{{ $judul }}</th>                    
                @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($ar_anggota as $ang)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $ang->no_anggota }}</td>
                <td>{{ $ang->nama }}</td>
                <td>{{ $ang->gender }}</td>
                <td>{{ $ang->email }}</td>
                <td>{{ $ang->hp }}</td>
                {{-- @if(!empty($ang->foto))                      
                      <td><img src="{{asset ('img/anggota')}}/{{ $ang->foto }}" width="30" /></td>
                      @else
                      <td><img src="{{asset ('img')}}/nophoto.png" width="30" /></td>
                @endif --}}
              </tr>          
            @endforeach
          </tbody>
        </table>
