<!DOCTYPE html>
<html>
<head>
    <title>Laporan Reduksi Sampah Global</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: center; }
        th { background-color: #2e7d32; color: white; }
        .total-row { background-color: #f2f2f2; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">PEMERINTAH KOTA BANJARMASIN</div>
        <div class="title">DINAS LINGKUNGAN HIDUP</div>
        <p style="margin: 0;">Laporan Rekapitulasi Volume Reduksi Sampah Digital se-Banjarmasin</p>
    </div>

    <p>Berdasarkan data yang masuk dari seluruh Unit Bank Sampah, berikut adalah rincian sampah yang berhasil direduksi:</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori Sampah</th>
                <th>Total Berat Terkumpul</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reduksi as $index => $r)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $r->nama_kategori }}</td>
                <td>{{ number_format($r->total_berat, 2) }}</td>
                <td>{{ $r->satuan }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="2">TOTAL REDUKSI GLOBAL</td>
                <td>{{ number_format($total_seluruhnya, 2) }}</td>
                <td>Kg</td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 50px; float: right; width: 250px; text-align: center;">
        Banjarmasin, {{ $tanggal }}<br>
        Kepala Bidang Kebersihan,<br><br><br><br><br>
        <b>( .......................................... )</b><br>
        NIP. .........................
    </div>
</body>
</html>