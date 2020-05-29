@php
$no = 1;
$ar_judul = ['No', 'Nama', 'Email', 'Telepon', 'Foto','Action'];
@endphp

              <h6 align="center">Data Pengarang</h6>
                <table align="center" border="1"  cellspacing="0">
                  <thead>
                    <tr>
                    @foreach ($ar_judul as $jdl )
                      <th>{{ $jdl }}</th>  
                    @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $ar_pengarang as $pengarang )
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $pengarang->nama }}</td>
                      <td>{{ $pengarang->email }}</td>
                      <td>{{ $pengarang->hp }}</td>
                      {{-- <td>{{ $pengarang->foto }}</td> --}}
                      {{-- @if(!empty($pengarang->foto))                      
                      <td><img src="{{asset ('img/pengarang')}}/{{ $pengarang->foto }}" width="30" /></td>
                      @else
                      <td><img src="{{asset ('img')}}/nophoto.png" width="30" /></td>
                      @endif --}}
                    </tr>
                    @endforeach
                  </tbody>
                </table>
