<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perangkingan Atlet</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
        }
        
        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 11px;
            color: #666;
        }
        
        .info {
            margin-bottom: 20px;
        }
        
        .info table {
            width: 100%;
        }
        
        .info td {
            padding: 3px 0;
        }
        
        h2 {
            font-size: 14px;
            margin: 20px 0 10px;
            padding: 5px;
            background-color: #f0f0f0;
            border-left: 4px solid #333;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        
        table th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
        }
        
        table td {
            font-size: 10px;
        }
        
        .text-left {
            text-align: left !important;
        }
        
        .ranking-1 {
            background-color: #ffd700 !important;
            font-weight: bold;
        }
        
        .ranking-2 {
            background-color: #c0c0c0 !important;
            font-weight: bold;
        }
        
        .ranking-3 {
            background-color: #cd7f32 !important;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: right;
        }
        
        .signature {
            margin-top: 50px;
            text-align: right;
            padding-right: 50px;
        }
        
        .signature p {
            margin: 5px 0;
        }
        
        .signature .name {
            margin-top: 60px;
            border-top: 1px solid #333;
            display: inline-block;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN HASIL PERANGKINGAN ATLET</h1>
        <p>Sistem Pendukung Keputusan Menggunakan Metode ARAS</p>
        <p>(Additive Ratio Assessment)</p>
    </div>

    <!-- Info Laporan -->
    <div class="info">
        <table>
            <tr>
                <td width="150"><strong>Tanggal Cetak</strong></td>
                <td width="10">:</td>
                <td>{{ date('d F Y, H:i:s') }}</td>
            </tr>
            <tr>
                <td><strong>Jumlah Alternatif</strong></td>
                <td>:</td>
                <td>{{ count($hasilPerangkingan) }} Atlet</td>
            </tr>
            <tr>
                <td><strong>Jumlah Kriteria</strong></td>
                <td>:</td>
                <td>{{ $kriterias->count() }} Kriteria</td>
            </tr>
        </table>
    </div>

    <!-- Data Kriteria -->
    <h2>1. Data Kriteria Penilaian</h2>
    <table>
        <thead>
            <tr>
                <th width="10%">Kode</th>
                <th width="35%">Nama Kriteria</th>
                <th width="15%">Bobot (%)</th>
                <th width="20%">Jenis</th>
                <th width="20%">Bobot (Decimal)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kriterias as $kriteria)
            <tr>
                <td>{{ $kriteria->kode_kriteria }}</td>
                <td class="text-left">{{ $kriteria->nama_kriteria }}</td>
                <td>{{ $kriteria->bobot }}%</td>
                <td>{{ ucfirst($kriteria->jenis) }}</td>
                <td>{{ number_format($kriteria->bobot / 100, 3) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Matrix Keputusan -->
    @if($matrixKeputusan)
    <h2>2. Matrix Keputusan</h2>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Alternatif</th>
                @foreach($kriterias as $kriteria)
                <th>{{ $kriteria->kode_kriteria }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($matrixKeputusan as $index => $row)
            <tr>
                <td>{{ $index == 0 ? 'A0' : 'A' . $index }}</td>
                <td class="text-left">{{ $row['atlet'] ? $row['atlet']->nama : 'Optimal' }}</td>
                @foreach($kriterias as $kriteria)
                <td>{{ number_format($row['C' . $kriteria->id], 2) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Matrix Normalisasi -->
    @if($matrixNormalisasi)
    <h2>3. Matrix Normalisasi</h2>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Alternatif</th>
                @foreach($kriterias as $kriteria)
                <th>{{ $kriteria->kode_kriteria }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($matrixNormalisasi as $index => $row)
            <tr>
                <td>{{ $index == 0 ? 'A0' : 'A' . $index }}</td>
                <td class="text-left">{{ $row['atlet'] ? $row['atlet']->nama : 'Optimal' }}</td>
                @foreach($kriterias as $kriteria)
                <td>{{ number_format($row['C' . $kriteria->id], 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Matrix Terbobot -->
    @if($matrixTerbobot)
    <h2>4. Matrix Terbobot</h2>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Alternatif</th>
                @foreach($kriterias as $kriteria)
                <th>{{ $kriteria->kode_kriteria }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($matrixTerbobot as $index => $row)
            <tr>
                <td>{{ $index == 0 ? 'A0' : 'A' . $index }}</td>
                <td class="text-left">{{ $row['atlet'] ? $row['atlet']->nama : 'Optimal' }}</td>
                @foreach($kriterias as $kriteria)
                <td>{{ number_format($row['C' . $kriteria->id], 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Nilai S0 -->
    @if($s0)
    <h2>5. Nilai Optimal (S0)</h2>
    <table>
        <tr>
            <th width="50%">Keterangan</th>
            <th width="50%">Nilai</th>
        </tr>
        <tr>
            <td>Nilai Optimality Function Optimal (S0)</td>
            <td><strong>{{ number_format($s0, 4) }}</strong></td>
        </tr>
    </table>
    @endif

    <!-- Hasil Perangkingan -->
    <h2>6. Hasil Perangkingan Akhir</h2>
    <table>
        <thead>
            <tr>
                <th width="10%">Ranking</th>
                <th width="40%">Nama Atlet</th>
                <th width="25%">Nilai Si</th>
                <th width="25%">Nilai Ki</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasilPerangkingan as $hasil)
            <tr class="{{ $hasil['ranking'] <= 3 ? 'ranking-' . $hasil['ranking'] : '' }}">
                <td><strong>{{ $hasil['ranking'] }}</strong></td>
                <td class="text-left">{{ $hasil['atlet']->nama }}</td>
                <td>{{ number_format($hasil['Si'], 4) }}</td>
                <td>{{ number_format($hasil['Ki'], 4) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Kesimpulan -->
    <div style="margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-left: 4px solid #28a745;">
        <strong>Kesimpulan:</strong><br>
        Berdasarkan hasil perhitungan menggunakan metode ARAS, atlet yang memperoleh peringkat tertinggi adalah 
        <strong>{{ $hasilPerangkingan[0]['atlet']->nama }}</strong> dengan nilai Ki = <strong>{{ number_format($hasilPerangkingan[0]['Ki'], 4) }}</strong>.
    </div>

    <!-- Tanda Tangan -->
    <div class="signature">
        <p>{{ date('d F Y') }}</p>
        <p>Mengetahui,</p>
        <br><br><br>
        <p class="name">
            <strong>(.............................)</strong><br>
            Penanggung Jawab
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Dicetak oleh: {{ Auth::user()->name }} | {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>