<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN EVALUASI ATLET - {{ $atlet->nama }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap" rel="stylesheet">
    <style>
        /* Reset dan Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000000;
            background-color: #ffffff;
            padding: 20mm;
            max-width: 210mm;
            margin: 0 auto;
        }
        
        /* Header dan Kop Surat */
        .letterhead {
            border-bottom: 2px solid #000000;
            padding-bottom: 10mm;
            margin-bottom: 15mm;
            text-align: center;
        }
        
        .institution-name {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 3mm;
        }
        
        .institution-address {
            font-size: 11pt;
            margin-bottom: 3mm;
        }
        
        .document-title {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 5mm;
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
            padding: 3mm 0;
            letter-spacing: 0.5px;
        }
        
        /* Informasi Laporan */
        .report-info {
            margin-bottom: 10mm;
            border: 1px solid #000000;
            padding: 5mm;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 2mm;
        }
        
        .info-label {
            width: 40mm;
            font-weight: bold;
        }
        
        .info-value {
            flex: 1;
        }
        
        /* Identitas Atlet */
        .student-header {
            text-align: center;
            margin-bottom: 10mm;
            padding-bottom: 5mm;
            border-bottom: 1px solid #000000;
        }
        
        .student-name {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 3mm;
        }
        
        .student-details {
            font-size: 11pt;
        }
        
        /* Skor Utama */
        .main-score {
            text-align: center;
            margin: 15mm 0;
            padding: 8mm;
            border: 2px solid #000000;
            border-radius: 2mm;
        }
        
        .score-label {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 3mm;
            text-transform: uppercase;
        }
        
        .score-value {
            font-size: 28pt;
            font-weight: bold;
            margin: 5mm 0;
        }
        
        .score-details {
            font-size: 11pt;
            margin-top: 3mm;
        }
        
        /* Section Header */
        .section-header {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 10mm 0 5mm 0;
            padding-bottom: 2mm;
            border-bottom: 2px solid #000000;
            letter-spacing: 0.5px;
        }
        
        /* Tabel Kriteria */
        .criteria-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10mm;
            font-size: 11pt;
        }
        
        .criteria-table th {
            background-color: #f5f5f5;
            border: 1px solid #000000;
            padding: 3mm 2mm;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .criteria-table td {
            border: 1px solid #000000;
            padding: 3mm 2mm;
            vertical-align: top;
        }
        
        .criteria-table .criterion-name {
            font-weight: bold;
        }
        
        .criteria-table .criterion-code {
            font-size: 10pt;
            color: #666666;
        }
        
        .performance-rating {
            text-align: center;
            padding: 1mm 3mm;
            border-radius: 1mm;
            font-weight: bold;
            font-size: 10pt;
            display: inline-block;
        }
        
        .rating-high {
            background-color: #e8e8e8;
            border: 1px solid #000000;
        }
        
        .rating-medium {
            background-color: #f0f0f0;
            border: 1px solid #666666;
        }
        
        .rating-low {
            background-color: #f8f8f8;
            border: 1px solid #999999;
        }
        
        /* Analisis Kinerja */
        .performance-analysis {
            margin: 10mm 0;
        }
        
        .analysis-section {
            margin-bottom: 8mm;
        }
        
        .analysis-title {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 3mm;
            text-transform: uppercase;
            border-bottom: 1px solid #000000;
            padding-bottom: 1mm;
        }
        
        .strength-title {
            border-color: #000000;
        }
        
        .weakness-title {
            border-color: #666666;
        }
        
        .analysis-list {
            margin-left: 5mm;
        }
        
        .analysis-list li {
            margin-bottom: 2mm;
            list-style-type: disc;
        }
        
        /* Kesimpulan */
        .conclusion-box {
            border: 1px solid #000000;
            padding: 8mm;
            margin: 15mm 0;
            background-color: #f9f9f9;
        }
        
        .conclusion-title {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5mm;
            text-align: center;
        }
        
        .conclusion-content {
            text-align: justify;
            line-height: 1.6;
        }
        
        .conclusion-content p {
            margin-bottom: 3mm;
            text-indent: 10mm;
        }
        
        /* Rekomendasi */
        .recommendations {
            margin: 10mm 0;
        }
        
        .recommendation-item {
            margin-bottom: 3mm;
            padding-left: 5mm;
            position: relative;
        }
        
        .recommendation-item::before {
            content: "•";
            position: absolute;
            left: 0;
            font-weight: bold;
        }
        
        /* Tanda Tangan */
        .signature-section {
            margin-top: 25mm;
        }
        
        .signature-grid {
            display: flex;
            justify-content: space-between;
            margin-top: 20mm;
        }
        
        .signature-box {
            text-align: center;
            width: 70mm;
        }
        
        .signature-line {
            width: 50mm;
            height: 1px;
            background-color: #000000;
            margin: 15mm auto 2mm;
        }
        
        .signature-name {
            font-weight: bold;
            margin-top: 2mm;
        }
        
        .signature-title {
            font-size: 10pt;
        }
        
        /* Footer */
        .document-footer {
            font-size: 9pt;
            text-align: center;
            margin-top: 15mm;
            padding-top: 3mm;
            border-top: 1px solid #000000;
            color: #666666;
        }
        
        /* Utility Classes */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-bold { font-weight: bold; }
        .mb-3 { margin-bottom: 3mm; }
        .mb-5 { margin-bottom: 5mm; }
        .mt-3 { margin-top: 3mm; }
        .mt-5 { margin-top: 5mm; }
        .page-break {
            page-break-before: always;
        }
        
        @media print {
            body {
                padding: 15mm;
            }
            .page-break {
                page-break-before: always;
                margin-top: 20mm;
            }
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="letterhead">
        <div class="institution-name">Akademi Sepak Bola Indonesia</div>
        <div class="institution-address">
            Jl. Pendidikan No. 123, Jakarta Pusat 10110 • Telp: (021) 123-4567
        </div>
        <div class="institution-address">
            Website: www.ars-academy.id • Email: info@ars-academy.id
        </div>
        
        <div class="document-title">
            Laporan Evaluasi Perkembangan Atlet
        </div>
    </div>

    <!-- Informasi Laporan -->
    <div class="report-info">
        <div class="info-row">
            <div class="info-label">Nomor Laporan</div>
            <div class="info-value">: LP/{{ date('Y') }}/{{ str_pad($atlet->id, 4, '0', STR_PAD_LEFT) }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Cetak</div>
            <div class="info-value">: {{ date('d F Y, H:i') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Periode Evaluasi</div>
            <div class="info-value">: Semester {{ date('n') <= 6 ? 'I' : 'II' }} Tahun {{ date('Y') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Jumlah Peserta</div>
            <div class="info-value">: {{ count($hasilPerangkingan) }} Atlet</div>
        </div>
    </div>

    <!-- Identitas Atlet -->
    <div class="student-header">
        <div class="student-name">{{ $atlet->nama }}</div>
        <div class="student-details">
            {{ $atlet->cabang_olahraga }} • Umur: {{ $atlet->umur }} Tahun • ID: {{ $atlet->id }}
        </div>
    </div>

    <!-- Skor Evaluasi Utama -->
    <div class="main-score">
        <div class="score-label">Skor Evaluasi Komprehensif</div>
        <div class="score-value">{{ number_format($hasilAtlet['Ki'] * 100, 1) }}</div>
        <div class="score-details">
            Peringkat: <strong>#{{ $hasilAtlet['ranking'] }}</strong> dari {{ count($hasilPerangkingan) }} atlet • 
            Nilai Utility: <strong>{{ number_format($hasilAtlet['Ki'], 4) }}</strong>
        </div>
    </div>

    <!-- Kriteria Penilaian -->
    <div class="section-header">Evaluasi per Kriteria Penilaian</div>
    <table class="criteria-table">
        <thead>
            <tr>
                <th width="15%">Kode</th>
                <th width="35%">Kriteria Penilaian</th>
                <th width="15%">Bobot</th>
                <th width="15%">Nilai</th>
                <th width="20%">Kinerja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kriterias as $kriteria)
            @php
                $nilai = $nilaiAtlet['C' . $kriteria->id];
                $nilaiMaks = 0;
                foreach($matrixKeputusan as $row) {
                    if($row['atlet'] && isset($row['C' . $kriteria->id])) {
                        $nilaiMaks = max($nilaiMaks, $row['C' . $kriteria->id]);
                    }
                }
                $persentase = $nilaiMaks > 0 ? ($nilai / $nilaiMaks) * 100 : 0;
                
                if($persentase >= 80) {
                    $kategori = 'Unggul';
                    $indicator = 'rating-high';
                } elseif($persentase >= 60) {
                    $kategori = 'Baik';
                    $indicator = 'rating-medium';
                } else {
                    $kategori = 'Perlu Perbaikan';
                    $indicator = 'rating-low';
                }
            @endphp
            <tr>
                <td class="text-center">
                    <strong>{{ $kriteria->kode_kriteria }}</strong>
                </td>
                <td>
                    <div class="criterion-name">{{ $kriteria->nama_kriteria }}</div>
                    <div class="criterion-code">{{ $kriteria->jenis == 'benefit' ? 'Benefit' : 'Cost' }}</div>
                </td>
                <td class="text-center">{{ $kriteria->bobot }}%</td>
                <td class="text-center">
                    <strong>{{ number_format($nilai, 2) }}</strong>
                    @if($nilaiMaks > 0)
                    <div style="font-size: 9pt; margin-top: 1mm;">
                        ({{ number_format($persentase, 1) }}%)
                    </div>
                    @endif
                </td>
                <td class="text-center">
                    <span class="performance-rating {{ $indicator }}">
                        {{ $kategori }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Analisis Kekuatan dan Kelemahan -->
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

    <div class="performance-analysis">
        @if(count($kekuatan) > 0)
        <div class="analysis-section">
            <div class="analysis-title strength-title">KEKUATAN DAN PRESTASI</div>
            <ul class="analysis-list">
                @foreach($kekuatan as $item)
                <li>
                    <strong>{{ $item['nama'] }}</strong> dengan skor {{ number_format($item['nilai'], 2) }} 
                    ({{ number_format($item['persen'], 1) }}% dari nilai maksimal). 
                    Aspek ini menunjukkan kompetensi yang sangat baik.
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(count($kelemahan) > 0)
        <div class="analysis-section">
            <div class="analysis-title weakness-title">AREA PERLU PERHATIAN</div>
            <ul class="analysis-list">
                @foreach($kelemahan as $item)
                <li>
                    <strong>{{ $item['nama'] }}</strong> dengan skor {{ number_format($item['nilai'], 2) }} 
                    ({{ number_format($item['persen'], 1) }}% dari nilai maksimal). 
                    Aspek ini memerlukan perhatian khusus untuk peningkatan performa.
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <!-- Kesimpulan -->
    <div class="conclusion-box">
        <div class="conclusion-title">KESIMPULAN EVALUASI</div>
        <div class="conclusion-content">
            <p>
                Berdasarkan hasil analisis sistem evaluasi dengan Metode ARAS (Additive Ratio Assessment), 
                atlet <strong>{{ $atlet->nama }}</strong> telah mencapai skor evaluasi komprehensif sebesar 
                <strong>{{ number_format($hasilAtlet['Ki'] * 100, 1) }}</strong> dari skala maksimal 100.
            </p>
            
            <p>
                Atlet berada pada <strong>peringkat ke-{{ $hasilAtlet['ranking'] }}</strong> dari total 
                {{ count($hasilPerangkingan) }} peserta evaluasi. 
                
                @if($hasilAtlet['ranking'] == 1)
                Prestasi ini menunjukkan bahwa atlet memiliki performa terbaik di antara seluruh peserta evaluasi.
                @elseif($hasilAtlet['ranking'] <= 3)
                Prestasi ini menempatkan atlet dalam kelompok unggulan dengan potensi pengembangan yang sangat tinggi.
                @elseif($hasilAtlet['ranking'] <= ceil(count($hasilPerangkingan) / 2))
                Atlet menunjukkan performa yang memadai dengan beberapa aspek yang masih dapat ditingkatkan.
                @else
                Atlet memiliki ruang peningkatan yang signifikan untuk mencapai standar kompetensi yang optimal.
                @endif
            </p>
            
            <p>
                Secara keseluruhan, atlet menunjukkan perkembangan yang 
                @if($hasilAtlet['Ki'] >= 0.8)
                <strong>sangat memuaskan</strong> dengan penguasaan kompetensi yang komprehensif.
                @elseif($hasilAtlet['Ki'] >= 0.6)
                <strong>memuaskan</strong> dengan beberapa area yang memerlukan perhatian khusus.
                @else
                <strong>perlu peningkatan intensif</strong> untuk mencapai standar kompetensi yang diharapkan.
                @endif
            </p>
        </div>
    </div>

    <!-- Rekomendasi -->
    <div class="section-header">REKOMENDASI DAN TINDAK LANJUT</div>
    <div class="recommendations">
        @if($hasilAtlet['ranking'] == 1)
        <div class="recommendation-item">
            Pertahankan konsistensi performa melalui program maintenance dan pengembangan berkelanjutan
        </div>
        <div class="recommendation-item">
            Fokus pada penguatan aspek mental dan strategi kompetisi untuk persiapan turnamen tingkat tinggi
        </div>
        <div class="recommendation-item">
            Berperan sebagai mentor bagi atlet junior untuk pengembangan kepemimpinan
        </div>
        @if(count($kelemahan) > 0)
        <div class="recommendation-item">
            Optimalkan aspek {{ $kelemahan[0]['nama'] }} meskipun berada di peringkat teratas
        </div>
        @endif
        
        @elseif($hasilAtlet['ranking'] <= 3)
        <div class="recommendation-item">
            Analisis komparatif dengan peringkat di atas untuk penyusunan strategi peningkatan yang tepat
        </div>
        @if(count($kelemahan) > 0)
        <div class="recommendation-item">
            Program khusus untuk peningkatan {{ $kelemahan[0]['nama'] }} dengan target peningkatan 20% dalam 3 bulan
        </div>
        @endif
        @if(count($kekuatan) > 0)
        <div class="recommendation-item">
            Optimalkan {{ $kekuatan[0]['nama'] }} sebagai keunggulan kompetitif yang dapat dikembangkan
        </div>
        @endif
        <div class="recommendation-item">
            Intensifikasi latihan dengan monitoring perkembangan setiap 2 minggu
        </div>
        
        @else
        @if(count($kelemahan) > 0)
        <div class="recommendation-item">
            Program intensif untuk peningkatan {{ $kelemahan[0]['nama'] }} sebagai prioritas utama
        </div>
        @endif
        @if(count($kekuatan) > 0)
        <div class="recommendation-item">
            Manfaatkan kompetensi {{ $kekuatan[0]['nama'] }} sebagai fondasi pengembangan aspek lain
        </div>
        @endif
        <div class="recommendation-item">
            Penyusunan program latihan individual dengan target peningkatan 25% dalam 3 bulan
        </div>
        <div class="recommendation-item">
            Evaluasi perkembangan mingguan dengan pelatih dan orang tua
        </div>
        <div class="recommendation-item">
            Studi banding dan pembelajaran dari atlet dengan peringkat lebih tinggi
        </div>
        @endif
        
        <div class="recommendation-item">
            Monitoring dan evaluasi berkala setiap bulan untuk penyesuaian program yang diperlukan
        </div>
        <div class="recommendation-item">
            Kolaborasi aktif antara orang tua, pelatih, dan atlet untuk support system optimal
        </div>
    </div>

    <!-- Tanda Tangan -->
    <div class="signature-section">
        <div class="signature-grid">
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-name">Pelatih Utama</div>
                <div class="signature-title">Penanggung Jawab Evaluasi</div>
            </div>
            
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-name">Kepala Akademi</div>
                <div class="signature-title">Penanggung Jawab Program</div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="document-footer">
        <p>Laporan ini dicetak secara otomatis oleh Sistem Evaluasi ARAS Akademi Sepak Bola Indonesia</p>
        <p>Tanggal cetak: {{ date('d/m/Y H:i') }} • Halaman 1 dari 1</p>
        <p class="mt-3">
            <em>
                Dokumen ini merupakan bagian dari rapor perkembangan atlet dan digunakan untuk keperluan 
                evaluasi serta pembinaan atlet. Kerahasiaan dokumen ini diharapkan dapat dijaga.
            </em>
        </p>
    </div>
</body>
</html>