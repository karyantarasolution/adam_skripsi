<style>
    body { font-family: sans-serif; }
    .title { text-align: center; color: #1b5e20; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 12px; text-align: left; }
    th { background: #e8f5e9; color: #2e7d32; }
    .rank { font-weight: bold; color: #2e7d32; }
</style>
<div class="title">
    <h2>Laporan Peringkat Kinerja Unit Bank Sampah</h2>
    <p>Dinas Lingkungan Hidup Kota Banjarmasin</p>
</div>
<table>
    <thead>
        <tr>
            <th>Peringkat</th>
            <th>Nama Unit Bank Sampah</th>
            <th>Alamat</th>
            <th>Total Kontribusi (Kg)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peringkat as $index => $p)
        <tr>
            <td class="rank">#{{ $index + 1 }}</td>
            <td>{{ $p->nama_unit }}</td>
            <td>{{ $p->alamat }}</td>
            <td>{{ number_format($p->total_kg ?? 0, 2) }} Kg</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p style="font-size: 10px; margin-top: 20px;">* Diurutkan berdasarkan volume sampah terbanyak yang berhasil dikumpulkan.</p>