<style>
    body { font-family: sans-serif; font-size: 11px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #000; padding: 5px; text-align: center; }
    .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; }
</style>
<div class="header">
    <h3>REKAPITULASI TRANSAKSI SETORAN SAMPAH</h3>
    <p>{{ $unit->nama_unit }} - Kota Banjarmasin</p>
</div>
<table>
    <thead>
        <tr style="background: #f2f2f2;">
            <th>No</th>
            <th>Tanggal</th>
            <th>Nasabah</th>
            <th>Kategori</th>
            <th>Berat</th>
            <th>Total (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($setoran as $s)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ date('d/m/Y', strtotime($s->tanggal_setor)) }}</td>
            <td>{{ $s->nasabah->user->name }}</td>
            <td>{{ $s->kategori->nama_kategori }}</td>
            <td>{{ $s->berat }} Kg</td>
            <td>{{ number_format($s->total_harga, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p><b>Total Berat: {{ $total_berat }} Kg | Total Perputaran: Rp {{ number_format($total_rupiah, 0, ',', '.') }}</b></p>