@php
$no = 1;
$ar_judul = ['No', 'Nama', 'Alamat', 'Email', 'Website', 'Telepon', 'Kontak','Action'];
@endphp
              <h6 align="center">Data Penerbit</h6>
                <table align="center"  border="1" cellspacing="0">
                  <thead>
                    <tr>
                    @foreach ($ar_judul as $jdl )
                      <th>{{ $jdl }}</th>  
                    @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $ar_penerbit as $penerbit )
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $penerbit->nama }}</td>
                      <td>{{ $penerbit->alamat }}</td>
                      <td>{{ $penerbit->email }}</td>
                      <td>{{ $penerbit->website }}</td>
                      <td>{{ $penerbit->telp }}</td>
                      <td>{{ $penerbit->cp }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>