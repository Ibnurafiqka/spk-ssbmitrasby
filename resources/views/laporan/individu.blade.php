<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Individual Atlet - {{ $atlet->nama }}</title>
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
            border: none;
        }
        
        .info td {
            padding: 3px 0;
            border: none;
        }
        
        .athlete-card {
            background-color: #e7f3ff;
            border-left: 5px solid #007bff;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .athlete-card h3 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #007bff;
        }
        
        .athlete-card table {
            width: 100%;
            border: none;
        }
        
        .athlete-card table td {
            padding: 5px 0;
            border: none;
            font-size: 12px;
        }
        
        .athlete-card .label {
            width: 180px;
            font-weight: bold;
        }
        
        .athlete-card .separator {
            width: 20px;
        }
        
        h2 {
            font-size: 14px;
            margin: 25px 0 12px;
            padding: 8px;
            background-color: #f0f0f0;
            border-left: 4px solid #333;
        }
        
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table.data-table th, 
        table.data-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        
        table.data-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
        }
        
        table.data-table td {
            font-size: 11px;
        }
        
        .text-left {
            text-align: left !important;
        }
        
        .ranking-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 16px;
        }
        
        .ranking-1 {
            background-color: #ffd700;
            color: #000;
        }
        
        .ranking-2 {
            background-color: #c0c0c0;
            color: #000;
        }
        
        .ranking-3 {
            background-color: #cd7f32;
            color: #fff;
        }
        
        .ranking-other {
            background-color: #6c757d;
            color: #fff;
        }
        
        .score-box {
            background-color: #fff9e6;
            border: 2px solid #ffc107;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        
        .score-box h3 {
            font-size: 14px;
            margin-bottom: 15px;
            color: #333;
        }
        
        .score-value {
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
            margin: 10px 0;
        }
        
        .score-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .conclusion {
            margin-top: 25px;
            padding: 20px;
            background-color: #d4edda;
            border-left: 5px solid #28a745;
        }
        
        .conclusion h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #155724;
        }
        
        .conclusion p {
            margin-bottom: 10px;
            line-height: 1.8;
        }
        
        .evaluation {
            margin-top: 25px;
            padding: 20px;
            background-color: #fff3cd;
            border-left: 5px solid #ffc107;
        }
        
        .evaluation h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #856404;
        }
        
        .evaluation ul {
            margin-left: 20px;
            margin-top: 10px;
        }
        
        .evaluation li {
            margin-bottom: 8px;
            line-height: 1.6;
        }
        
        .strength {
            background-color: #d1ecf1;
            border-left: 5px solid #17a2b8;
            padding: 20px;
            margin: 20px 0;
        }
        
        .strength h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #0c5460;
        }
        
        .weakness {
            background-color: #f8d7da;
            border-left: 5px solid #dc3545;
            padding: 20px;
            margin: 20px 0;
        }
        
        .weakness h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #721c24;
        }
        
        .footer {
            margin-top: 40px;
            font-size: 10px;
            text-align: right;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        
        .signature {
            margin-top: 40px;
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
        
        .performance-indicator {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            margin-left: 10px;
        }
        
        .indicator-high {
            background-color: #28a745;
            color: white;
        }
        
        .indicator-medium {
            background-color: #ffc107;
            color: black;
        }
        
        .indicator-low {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN PENILAIAN INDIVIDU ATLET</h1>
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
                <td><strong>Tipe Laporan</strong></td>
                <td>:</td>
                <td>Laporan Individual</td>
            </tr>
            <tr>
                <td><strong>Jumlah Kriteria</strong></td>
                <td>:</td>
                <td>{{ $kriterias->count() }} Kriteria Penilaian</td>
            </tr>
        </table>
    </div>

    <!-- Data Atlet -->
    <div class="athlete-card">
        <h3>IDENTITAS ATLET</h3>
        <table>
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="separator">:</td>
                <td><strong style="font-size: 14px;">{{ $atlet->nama }}</strong></td>
            </tr>
            <tr>
                <td class="label">Peringkat</td>
                <td class="separator">:</td>
                <td>
                    <span class="ranking-badge {{ $hasilAtlet['ranking'] == 1 ? 'ranking-1' : ($hasilAtlet['ranking'] == 2 ? 'ranking-2' : ($hasilAtlet['ranking'] == 3 ? 'ranking-3' : 'ranking-other')) }}">
                        #{{ $hasilAtlet['ranking'] }}
                    </span>
                </td>
            </tr>
            <tr>
                <td class="label">Total Atlet yang Dinilai</td>
                <td class="separator">:</td>
                <td>{{ count($hasilPerangkingan) }} Atlet</td>
            </tr>
        </table>
    </div>

    <!-- Skor Akhir -->
    <div class="score-box">
        <h3>SKOR PENILAIAN AKHIR</h3>
        <div class="score-label">Nilai Utility Degree (Ki)</div>
        <div class="score-value">{{ number_format($hasilAtlet['Ki'], 4) }}</div>
        <div class="score-label">dari nilai maksimal 1.0000</div>
        <div style="margin-top: 15px; font-size: 11px; color: #666;">
            Persentase: <strong>{{ number_format($hasilAtlet['Ki'] * 100, 2) }}%</strong>
        </div>
    </div>

    <!-- Rincian Nilai per Kriteria -->
    <h2>RINCIAN PENILAIAN PER KRITERIA</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th width="10%">Kode</th>
                <th width="35%">Kriteria Penilaian</th>
                <th width="15%">Bobot</th>
                <th width="15%">Nilai</th>
                <th width="25%">Kategori</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAtlet = count($hasilPerangkingan);
            @endphp
            @foreach($kriterias as $kriteria)
            @php
                $nilai = $nilaiAtlet['C' . $kriteria->id];
                // Hitung nilai maksimal dari semua atlet untuk kriteria ini
                $nilaiMaks = 0;
                foreach($matrixKeputusan as $row) {
                    if($row['atlet'] && isset($row['C' . $kriteria->id])) {
                        $nilaiMaks = max($nilaiMaks, $row['C' . $kriteria->id]);
                    }
                }
                // Tentukan kategori performa
                $persentase = $nilaiMaks > 0 ? ($nilai / $nilaiMaks) * 100 : 0;
                if($persentase >= 80) {
                    $kategori = 'Sangat Baik';
                    $indicator = 'indicator-high';
                } elseif($persentase >= 60) {
                    $kategori = 'Baik';
                    $indicator = 'indicator-medium';
                } else {
                    $kategori = 'Perlu Ditingkatkan';
                    $indicator = 'indicator-low';
                }
            @endphp
            <tr>
                <td>{{ $kriteria->kode_kriteria }}</td>
                <td class="text-left">{{ $kriteria->nama_kriteria }}</td>
                <td>{{ $kriteria->bobot }}%</td>
                <td><strong>{{ number_format($nilai, 2) }}</strong></td>
                <td>
                    <span class="performance-indicator {{ $indicator }}">
                        {{ $kategori }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Analisis Kekuatan -->
    @php
        $kekuatan = [];
        $kelemahan = [];
        
        foreach($kriterias as $kriteria) {
            $nilai = $nilaiAtlet['C' . $kriteria->id];
            $nilaiMaks = 0;
            foreach($matrixKeputusan as $row) {
                if($row['atlet'] && isset($row['C' . $kriteria->id])) {
                    $nilaiMaks = max($nilaiMaks, $row['C' . $kriteria->id]);
                }
            }
            $persentase = $nilaiMaks > 0 ? ($nilai / $nilaiMaks) * 100 : 0;
            
            if($persentase >= 80) {
                $kekuatan[] = [
                    'nama' => $kriteria->nama_kriteria,
                    'nilai' => $nilai,
                    'persen' => $persentase
                ];
            } elseif($persentase < 60) {
                $kelemahan[] = [
                    'nama' => $kriteria->nama_kriteria,
                    'nilai' => $nilai,
                    'persen' => $persentase
                ];
            }
        }
    @endphp

    @if(count($kekuatan) > 0)
    <div class="strength">
        <h3>✓ KEKUATAN / KEUNGGULAN</h3>
        <ul>
            @foreach($kekuatan as $item)
            <li>
                <strong>{{ $item['nama'] }}</strong> dengan nilai <strong>{{ number_format($item['nilai'], 2) }}</strong> 
                ({{ number_format($item['persen'], 1) }}% dari nilai maksimal)
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(count($kelemahan) > 0)
    <div class="weakness">
        <h3>⚠ AREA YANG PERLU DITINGKATKAN</h3>
        <ul>
            @foreach($kelemahan as $item)
            <li>
                <strong>{{ $item['nama'] }}</strong> dengan nilai <strong>{{ number_format($item['nilai'], 2) }}</strong> 
                ({{ number_format($item['persen'], 1) }}% dari nilai maksimal)
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Kesimpulan -->
    <div class="conclusion">
        <h3>KESIMPULAN</h3>
        <p>
            Berdasarkan hasil penilaian menggunakan metode ARAS (Additive Ratio Assessment), 
            atlet <strong>{{ $atlet->nama }}</strong> memperoleh nilai Ki sebesar <strong>{{ number_format($hasilAtlet['Ki'], 4) }}</strong> 
            atau <strong>{{ number_format($hasilAtlet['Ki'] * 100, 2) }}%</strong> dari nilai optimal.
        </p>
        <p>
            Atlet ini berada pada <strong>Peringkat {{ $hasilAtlet['ranking'] }}</strong> dari total {{ count($hasilPerangkingan) }} atlet yang dinilai.
            
            @if($hasilAtlet['ranking'] == 1)
            Prestasi ini menunjukkan bahwa atlet memiliki <strong>performa terbaik</strong> dibandingkan dengan atlet lainnya 
            dan memenuhi kriteria secara keseluruhan dengan sangat baik.
            @elseif($hasilAtlet['ranking'] <= 3)
            Prestasi ini menunjukkan bahwa atlet termasuk dalam <strong>kelompok 3 besar</strong> dengan performa yang sangat baik 
            dan memiliki potensi untuk terus berkembang.
            @elseif($hasilAtlet['ranking'] <= ceil(count($hasilPerangkingan) / 2))
            Prestasi ini menunjukkan bahwa atlet memiliki performa yang <strong>cukup baik</strong> dan berada di tengah-tengah peringkat. 
            Masih terdapat beberapa area yang dapat ditingkatkan untuk mencapai performa optimal.
            @else
            Prestasi ini menunjukkan bahwa atlet masih perlu melakukan <strong>peningkatan signifikan</strong> dalam beberapa kriteria 
            untuk dapat bersaing dengan atlet lainnya.
            @endif
        </p>
    </div>

    <!-- Saran dan Evaluasi -->
    <div class="evaluation">
        <h3>SARAN DAN REKOMENDASI</h3>
        
        @if($hasilAtlet['ranking'] == 1)
        <p><strong>Rekomendasi untuk Juara:</strong></p>
        <ul>
            <li>Pertahankan konsistensi performa di semua kriteria penilaian</li>
            <li>Fokus pada maintenance dan pencegahan cedera</li>
            <li>Tingkatkan aspek mental dan strategi kompetisi</li>
            <li>Berperan sebagai role model bagi atlet lainnya</li>
            @if(count($kelemahan) > 0)
            <li>Meskipun berada di peringkat teratas, tetap perhatikan area yang masih bisa ditingkatkan untuk mempertahankan posisi</li>
            @endif
        </ul>
        
        @elseif($hasilAtlet['ranking'] <= 3)
        <p><strong>Rekomendasi untuk Peringkat Top 3:</strong></p>
        <ul>
            <li>Identifikasi gap dengan peringkat di atasnya dan buat program peningkatan spesifik</li>
            @if(count($kelemahan) > 0)
            <li>Prioritaskan perbaikan pada kriteria yang masih lemah untuk meningkatkan peringkat</li>
            @endif
            @if(count($kekuatan) > 0)
            <li>Pertahankan keunggulan yang sudah dimiliki sambil terus meningkatkan aspek lainnya</li>
            @endif
            <li>Tingkatkan intensitas latihan dengan tetap memperhatikan recovery</li>
            <li>Konsultasi rutin dengan pelatih untuk optimalisasi program latihan</li>
        </ul>
        
        @else
        <p><strong>Rekomendasi untuk Peningkatan:</strong></p>
        <ul>
            @if(count($kelemahan) > 0)
            <li>Fokus pada peningkatan kriteria yang masih rendah sebagai prioritas utama</li>
            <li>Buat program latihan khusus untuk memperbaiki kelemahan yang teridentifikasi</li>
            @endif
            @if(count($kekuatan) > 0)
            <li>Manfaatkan kekuatan yang ada sebagai pondasi untuk meningkatkan aspek lainnya</li>
            @endif
            <li>Konsultasi intensif dengan pelatih untuk merancang program peningkatan berkelanjutan</li>
            <li>Evaluasi progress secara berkala setiap bulan</li>
            <li>Tingkatkan disiplin latihan dan pola hidup sehat</li>
            <li>Pelajari dari atlet dengan peringkat lebih tinggi</li>
        </ul>
        @endif
        
        <p style="margin-top: 15px;">
            <strong>Catatan:</strong> Evaluasi dan penilaian ini dapat dijadikan acuan untuk penyusunan program latihan 
            dan pengembangan atlet ke depannya. Monitoring berkala sangat disarankan untuk memastikan progress yang konsisten.
        </p>
    </div>

    <!-- Tanda Tangan -->
    <div class="signature">
        <p>{{ date('d F Y') }}</p>
        <p>Mengetahui,</p>
        <br><br><br>
        <p class="name">
            <strong>(.............................)</strong><br>
            Pelatih / Penanggung Jawab
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Dicetak oleh: {{ Auth::user()->name }} | {{ date('d/m/Y H:i:s') }}</p>
        <p>Laporan Individual - {{ $atlet->nama }}</p>
        <p style="margin-top: 5px; font-style: italic;">Dokumen ini bersifat rahasia dan hanya untuk keperluan internal</p>
    </div>
</body>
</html>