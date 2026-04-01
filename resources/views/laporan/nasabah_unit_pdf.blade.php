<style>
    body { font-family: sans-serif; font-size: 11px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    .header { text-align: center; font-weight: bold; margin-bottom: 20px; }
</style>
<div class="header">
    DAFTAR NASABA TERDAFTAR<br>
    {{ strtoupper($unit->nama_unit) }}<br>
    KOTA BANJARMASIN
</div>
<table>
    <thead>
        <tr style="background: #eee;">
            <th>No</th>
            <th>NIK</th>
            <th>Nama Lengkap</th>
            <th>No. Telp</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nasabah as $n)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $n->nik }}</td>
            <td>{{ $n->user->name }}</td>
            <td>{{ $n->no_telp }}</td>
            <td>{{ $n->alamat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>