<style>
    body { font-family: sans-serif; font-size: 11px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #000; padding: 5px; }
</style>
<center><h3>RIWAYAT PENARIKAN SALDO NASABAH</h3></center>
<table>
    <tr style="background: #f2f2f2;">
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Nasabah</th>
        <th>Jumlah Tarik</th>
        <th>Status</th>
    </tr>
    @foreach($penarikan as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ date('d/m/Y', strtotime($p->tanggal_tarik)) }}</td>
        <td>{{ $p->nasabah->user->name }}</td>
        <td>Rp {{ number_format($p->jumlah_tarik, 0, ',', '.') }}</td>
        <td>{{ $p->status }}</td>
    </tr>
    @endforeach
</table>