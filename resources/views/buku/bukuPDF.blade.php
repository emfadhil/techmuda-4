@php
$no = 1;
    $ar_judul = ['No', 'ISBN', 'Judul', 'Stok', 'Pengarang',
    'Penerbit','Kategori','Cover'];
@endphp
<h3 align="center">Daftar Buku</h3>
        <table border="1" align="center" cellspacing="0">
          <thead>
            <tr>
                @foreach ($ar_judul as $judul)
                <th>{{ $judul }}</th>                    
                @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($ar_buku as $buku)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $buku->isbn }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->stok }}</td>
                <td>{{ $buku->peng }}</td>
                <td>{{ $buku->pen }}</td>
                <td>{{ $buku->kat }}</td>
                @if(!empty($buku->cover))                      
                      <td><img src="{{asset ('img/buku')}}/{{ $buku->cover }}" width="10px" /></td>
                      @else
                      <td><img src="{{asset ('img')}}/nobook.png" width="10px" /></td>
                @endif
            </tr>          
            @endforeach
          </tbody>
        </table>