<style>
    body { font-family: sans-serif; }
    .card { border: 2px solid #2e7d32; padding: 15px; border-radius: 10px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; }
    th, td { border-bottom: 1px solid #ddd; padding: 8px; text-align: left; }
</style>
<div class="card">
    <h2 style="color: #2e7d32; margin-top: 0;">BUKU TABUNGAN SAMPAH DIGITAL</h2>
    <p>Nama: <b>{{ $nasabah->user->name }}</b> | NIK: {{ $nasabah->nik }}<br>
    Unit: {{ $nasabah->unit->nama_unit }} | <b>Saldo Saat Ini: Rp {{ number_format($nasabah->saldo->jumlah_saldo ?? 0, 0, ',', '.') }}</b></p>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Berat</th>
                <th>Total Rupiah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($setoran as $s)
            <tr>
                <td>{{ date('d/m/Y', strtotime($s->tanggal_setor)) }}</td>
                <td>{{ $s->kategori->nama_kategori }}</td>
                <td>{{ $s->berat }} {{ $s->kategori->satuan }}</td>
                <td>Rp {{ number_format($s->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>