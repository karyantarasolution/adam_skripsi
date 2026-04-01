<!DOCTYPE html>
<html>
<head>
    <title>Laporan Arus Kas Unit</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .info { margin: 15px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total-box { background-color: #e8f5e9; padding: 10px; border: 1px solid #2e7d32; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h3>LAPORAN ARUS KAS BANK SAMPAH</h3>
        <p>{{ $unit->nama_unit }} - {{ $unit->alamat }}</p>
    </div>

    <h4>1. Data Pemasukan (Setoran Sampah)</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nasabah</th>
                <th>Sampah (Berat)</th>
                <th>Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($setoran as $index => $s)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d/m/Y', strtotime($s->tanggal_setor)) }}</td>
                <td>{{ $s->nasabah->user->name }}</td>
                <td>{{ $s->kategori->nama_kategori }} ({{ $s->berat }}kg)</td>
                <td>{{ number_format($s->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>2. Data Pengeluaran (Penarikan Saldo)</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nasabah</th>
                <th>Jumlah Tarik (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penarikan as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d/m/Y', strtotime($p->tanggal_tarik)) }}</td>
                <td>{{ $p->nasabah->user->name }}</td>
                <td>{{ number_format($p->jumlah_tarik, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        RINGKASAN KAS UNIT:<br>
        Total Sampah Masuk (Konversi Rp): Rp {{ number_format($total_masuk, 0, ',', '.') }}<br>
        Total Saldo Ditarik Warga: Rp {{ number_format($total_keluar, 0, ',', '.') }}<br>
        Sisa Kas Mengendap: Rp {{ number_format($total_masuk - $total_keluar, 0, ',', '.') }}
    </div>

    <p style="text-align: right; margin-top: 30px;">
        Banjarmasin, {{ $tanggal }}<br><br><br><br>
        ( {{ Auth::user()->name }} )<br>
        Admin Unit
    </p>
</body>
</html>