<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th { background: #eee; }
        td { text-align: center; }
    </style>
</head>
<body>

    <h3 style="text-align:center;">LAPORAN ABSENSI SANTRI</h3>

    <p><b>Nama Santri :</b> {{ $santri->nama_lengkap }}</p>
    <p><b>Pembimbing :</b> {{ $pembimbing }}</p>
    <p><b>Periode :</b> {{ $periode }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Alpa</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $i => $row)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $row['tanggal'] }}</td>
                <td>{{ $row['hadir'] ? 'Y' : '' }}</td>
                <td>{{ $row['izin'] ? 'Y' : '' }}</td>
                <td>{{ $row['sakit'] ? 'Y' : '' }}</td>
                <td>{{ $row['alpa'] ? 'Y' : '' }}</td>
                <td>{{ $row['keterangan'] ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr style="font-weight: bold; background:#eef;">
                <td colspan="2">TOTAL</td>
                <td>{{ $totalHadir }}</td>
                <td>{{ $totalIzin }}</td>
                <td>{{ $totalSakit }}</td>
                <td>{{ $totalAlpa }}</td>
                <td>-</td>
            </tr>

            <tr style="font-weight: bold; background:#def;">
                <td colspan="2">PERSENTASE HADIR</td>
                <td colspan="5">
                    {{ $persenHadir }}% hadir
                </td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
