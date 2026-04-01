<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kategori Sampah</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { bg-color: #f2f2f2; }
        .footer { text-align: right; margin-top: 30px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>DINAS LINGKUNGAN HIDUP KOTA BANJARMASIN</h2>
        <p>Laporan Master Kategori & Harga Sampah Digital</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Harga per Kg</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategori as $index => $k)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $k->nama_kategori }}</td>
                <td>Rp {{ number_format($k->harga_per_kg, 0, ',', '.') }}</td>
                <td>{{ $k->satuan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ $tanggal }}</p>
        <br><br><br>
        <p>(.........................................)</p>
        <p>Admin DLH Banjarmasin</p>
    </div>
</body>
</html>