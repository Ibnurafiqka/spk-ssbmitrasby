<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN RESULTAN EVALUASI ATLET</title>
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
            padding: 15mm;
            max-width: 210mm;
            margin: 0 auto;
        }
        
        /* Header dan Kop Surat */
        .letterhead {
            border-bottom: 2px solid #000000;
            padding-bottom: 8mm;
            margin-bottom: 12mm;
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
            margin-bottom: 8mm;
            border: 1px solid #000000;
            padding: 4mm;
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
        
        /* Section Header */
        .section-header {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 10mm 0 5mm 0;
            padding-bottom: 2mm;
            border-bottom: 2px solid #000000;
            letter-spacing: 0.5px;
            page-break-after: avoid;
        }
        
        .subsection-header {
            font-size: 11pt;
            font-weight: bold;
            margin: 8mm 0 4mm 0;
            padding-left: 3mm;
            border-left: 3mm solid #000000;
        }
        
        /* Tabel */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8mm;
            font-size: 10pt;
        }
        
        .data-table th {
            background-color: #f5f5f5;
            border: 1px solid #000000;
            padding: 3mm 2mm;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .data-table td {
            border: 1px solid #000000;
            padding: 2mm;
            text-align: center;
            vertical-align: middle;
        }
        
        .data-table .text-left {
            text-align: left;
        }
        
        .data-table .ranking-cell {
            font-weight: bold;
            font-size: 11pt;
        }
        
        .ranking-1 {
            background-color: #e8e8e8 !important;
        }
        
        .ranking-2 {
            background-color: #f0f0f0 !important;
        }
        
        .ranking-3 {
            background-color: #f8f8f8 !important;
        }
        
        /* Matrix Table */
        .matrix-table {
            font-size: 9pt;
            page-break-inside: avoid;
        }
        
        .matrix-table td {
            padding: 1.5mm;
        }
        
        .alternate-row {
            background-color: #fafafa;
        }
        
        /* Summary Box */
        .summary-box {
            border: 2px solid #000000;
            padding: 6mm;
            margin: 10mm 0;
            background-color: #f9f9f9;
            page-break-inside: avoid;
        }
        
        .summary-title {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 4mm;
            text-align: center;
        }
        
        .summary-content {
            text-align: center;
            font-size: 11pt;
        }
        
        .summary-value {
            font-size: 20pt;
            font-weight: bold;
            margin: 3mm 0;
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
        
        /* Tanda Tangan */
        .signature-section {
            margin-top: 20mm;
        }
        
        .signature-grid {
            display: flex;
            justify-content: space-between;
            margin-top: 15mm;
        }
        
        .signature-box {
            text-align: center;
            width: 70mm;
        }
        
        .signature-line {
            width: 50mm;
            height: 1px;
            background-color: #000000;
            margin: 12mm auto 2mm;
        }
        
        .signature-name {
            font-weight: bold;
            margin-top: 2mm;
        }
        
        .signature-title {
            font-size: 10pt;
        }
        
        /* Utility Classes */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-bold { font-weight: bold; }
        .mb-2 { margin-bottom: 2mm; }
        .mb-3 { margin-bottom: 3mm; }
        .mb-5 { margin-bottom: 5mm; }
        .mt-3 { margin-top: 3mm; }
        .mt-5 { margin-top: 5mm; }
        .page-break {
            page-break-before: always;
        }
        
        /* Printing Optimizations */
        @media print {
            body {
                padding: 12mm;
                font-size: 11pt;
            }
            .page-break {
                page-break-before: always;
                margin-top: 15mm;
            }
            .section-header {
                page-break-after: avoid;
            }
            .data-table {
                page-break-inside: avoid;
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
            Laporan Hasil Evaluasi Komprehensif Atlet
        </div>
    </div>

    <!-- Informasi Laporan -->
    <div class="report-info">
        <div class="info-row">
            <div class="info-label">Nomor Laporan</div>
            <div class="info-value">: REV/{{ date('Y') }}/{{ date('m') }}/{{ str_pad(count($hasilPerangkingan), 3, '0', STR_PAD_LEFT) }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Cetak</div>
            <div class="info-value">: {{ date('d F Y, H:i') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Metode Evaluasi</div>
            <div class="info-value">: ARAS (Additive Ratio Assessment)</div>
        </div>
        <div class="info-row">
            <div class="info-label">Jumlah Peserta</div>
            <div class="info-value">: {{ count($hasilPerangkingan) }} Atlet</div>
        </div>
        <div class="info-row">
            <div class="info-label">Jumlah Kriteria</div>
            <div class="info-value">: {{ $kriterias->count() }} Parameter</div>
        </div>
    </div>

    <!-- Ringkasan Hasil -->
    <div class="summary-box">
        <div class="summary-title">RINGKASAN HASIL EVALUASI</div>
        <div class="summary-content">
            <div class="summary-value">PEMERINGKATAN {{ count($hasilPerangkingan) }} ATLET</div>
            <div class="mb-3">Berdasarkan analisis komprehensif dengan metode ARAS</div>
            <div class="mb-2">
                <strong>Atlet Terbaik:</strong> {{ $hasilPerangkingan[0]['atlet']->nama }}
            </div>
            <div>
                Skor: <strong>{{ number_format($hasilPerangkingan[0]['Ki'] * 100, 1) }}</strong> • 
                Nilai Utility: <strong>{{ number_format($hasilPerangkingan[0]['Ki'], 4) }}</strong>
            </div>
        </div>
    </div>

    <!-- 1. Data Kriteria -->
    <div class="section-header">1. Parameter Evaluasi</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="10%">Kode</th>
                <th width="40%">Parameter Evaluasi</th>
                <th width="15%">Bobot (%)</th>
                <th width="15%">Bobot (Desimal)</th>
                <th width="20%">Jenis</th>
            </tr>
        </thead>
        <tbody>
            @php $totalBobot = 0; @endphp
            @foreach($kriterias as $kriteria)
            @php $totalBobot += $kriteria->bobot; @endphp
            <tr class="{{ $loop->iteration % 2 == 0 ? 'alternate-row' : '' }}">
                <td><strong>{{ $kriteria->kode_kriteria }}</strong></td>
                <td class="text-left">{{ $kriteria->nama_kriteria }}</td>
                <td>{{ $kriteria->bobot }}%</td>
                <td>{{ number_format($kriteria->bobot / 100, 3) }}</td>
                <td>{{ ucfirst($kriteria->jenis) }}</td>
            </tr>
            @endforeach
            <tr style="background-color: #f0f0f0;">
                <td colspan="2" class="text-right text-bold">TOTAL BOBOT:</td>
                <td class="text-bold">{{ $totalBobot }}%</td>
                <td class="text-bold">{{ number_format($totalBobot / 100, 3) }}</td>
                <td>
                    @if($totalBobot == 100)
                    <span style="color: #000000; font-weight: bold;">✓ SESUAI</span>
                    @else
                    <span style="color: #ff0000; font-weight: bold;">⚠ PERHATIAN</span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <!-- 2. Matrix Keputusan -->
    @if($matrixKeputusan)
    <div class="section-header">2. Matrix Data Evaluasi</div>
    <div class="subsection-header">Matrix Keputusan (X)</div>
    <table class="data-table matrix-table">
        <thead>
            <tr>
                <th width="8%">Kode</th>
                <th width="25%">Alternatif</th>
                @foreach($kriterias as $kriteria)
                <th>{{ $kriteria->kode_kriteria }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($matrixKeputusan as $index => $row)
            <tr class="{{ $loop->iteration % 2 == 0 ? 'alternate-row' : '' }}">
                <td class="text-bold">{{ $index == 0 ? 'A₀' : 'A' . $index }}</td>
                <td class="text-left">{{ $row['atlet'] ? $row['atlet']->nama : 'REFERENSI OPTIMAL' }}</td>
                @foreach($kriterias as $kriteria)
                <td>{{ number_format($row['C' . $kriteria->id], 2) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- 3. Matrix Normalisasi -->
    @if($matrixNormalisasi)
    <div class="subsection-header">Matrix Normalisasi (X̄)</div>
    <table class="data-table matrix-table">
        <thead>
            <tr>
                <th width="8%">Kode</th>
                <th width="25%">Alternatif</th>
                @foreach($kriterias as $kriteria)
                <th>{{ $kriteria->kode_kriteria }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($matrixNormalisasi as $index => $row)
            <tr class="{{ $loop->iteration % 2 == 0 ? 'alternate-row' : '' }}">
                <td class="text-bold">{{ $index == 0 ? 'A₀' : 'A' . $index }}</td>
                <td class="text-left">{{ $row['atlet'] ? $row['atlet']->nama : 'REFERENSI OPTIMAL' }}</td>
                @foreach($kriterias as $kriteria)
                <td>{{ number_format($row['C' . $kriteria->id], 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- 4. Matrix Terbobot -->
    @if($matrixTerbobot)
    <div class="subsection-header">Matrix Terbobot (V)</div>
    <table class="data-table matrix-table">
        <thead>
            <tr>
                <th width="8%">Kode</th>
                <th width="25%">Alternatif</th>
                @foreach($kriterias as $kriteria)
                <th>{{ $kriteria->kode_kriteria }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($matrixTerbobot as $index => $row)
            <tr class="{{ $loop->iteration % 2 == 0 ? 'alternate-row' : '' }}">
                <td class="text-bold">{{ $index == 0 ? 'A₀' : 'A' . $index }}</td>
                <td class="text-left">{{ $row['atlet'] ? $row['atlet']->nama : 'REFERENSI OPTIMAL' }}</td>
                @foreach($kriterias as $kriteria)
                <td>{{ number_format($row['C' . $kriteria->id], 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- 5. Nilai Optimal S₀ -->
    @if($s0)
    <div class="section-header">3. Parameter Perhitungan</div>
    <div style="border: 1px solid #000000; padding: 6mm; margin: 5mm 0;">
        <div style="text-align: center; font-weight: bold; margin-bottom: 3mm;">
            NILAI REFERENSI OPTIMAL (S₀)
        </div>
        <div style="text-align: center; font-size: 16pt; font-weight: bold;">
            {{ number_format($s0, 4) }}
        </div>
        <div style="text-align: center; font-size: 10pt; margin-top: 2mm; color: #666666;">
            Nilai optimality function untuk alternatif referensi
        </div>
    </div>
    @endif

    <!-- 6. Hasil Perangkingan Akhir -->
    <div class="section-header">4. HASIL PEMERINGKATAN FINAL</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="12%">RANKING</th>
                <th width="40%">NAMA ATLET</th>
                <th width="24%">NILAI Sᵢ</th>
                <th width="24%">NILAI UTILITY (Kᵢ)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasilPerangkingan as $hasil)
            <tr class="ranking-{{ $hasil['ranking'] <= 3 ? $hasil['ranking'] : '' }}">
                <td class="ranking-cell">{{ $hasil['ranking'] }}</td>
                <td class="text-left">
                    <div style="font-weight: bold;">{{ $hasil['atlet']->nama }}</div>
                    <div style="font-size: 9pt; color: #666666;">
                        {{ $hasil['atlet']->cabang_olahraga }} • {{ $hasil['atlet']->umur }} Tahun
                    </div>
                </td>
                <td>{{ number_format($hasil['Si'], 4) }}</td>
                <td>
                    <strong>{{ number_format($hasil['Ki'], 4) }}</strong>
                    <div style="font-size: 9pt; color: #666666;">
                        {{ number_format($hasil['Ki'] * 100, 1) }}%
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 7. Analisis Hasil -->
    <div class="section-header">5. ANALISIS DAN KESIMPULAN</div>
    <div style="border: 1px solid #000000; padding: 8mm; margin-bottom: 8mm;">
        <div style="font-weight: bold; margin-bottom: 4mm; text-align: center;">
            HASIL EVALUASI KOMPREHENSIF
        </div>
        
        <div style="margin-bottom: 4mm;">
            <strong>Atlet dengan Performa Terbaik:</strong><br>
            <span style="font-size: 11pt;">
                {{ $hasilPerangkingan[0]['atlet']->nama }} dengan nilai utility 
                <strong>{{ number_format($hasilPerangkingan[0]['Ki'], 4) }}</strong> 
                ({{ number_format($hasilPerangkingan[0]['Ki'] * 100, 1) }}%)
            </span>
        </div>
        
        <div style="margin-bottom: 4mm;">
            <strong>Distribusi Nilai Utility:</strong><br>
            • Tertinggi: {{ number_format($hasilPerangkingan[0]['Ki'], 4) }}<br>
            • Terendah: {{ number_format($hasilPerangkingan[count($hasilPerangkingan)-1]['Ki'], 4) }}<br>
            • Rata-rata: {{ number_format(array_sum(array_column($hasilPerangkingan, 'Ki')) / count($hasilPerangkingan), 4) }}
        </div>
        
        <div>
            <strong>Kesimpulan:</strong><br>
            Berdasarkan hasil perhitungan menggunakan metode ARAS (Additive Ratio Assessment), sistem berhasil 
            memeringkat {{ count($hasilPerangkingan) }} atlet berdasarkan {{ $kriterias->count() }} parameter evaluasi. 
            Hasil ini dapat dijadikan dasar untuk pengambilan keputusan dalam seleksi, pembinaan, dan pengembangan atlet.
        </div>
    </div>

    <!-- Tanda Tangan -->
    <div class="signature-section">
        <div class="signature-grid">
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-name">Koordinator Evaluasi</div>
                <div class="signature-title">Penanggung Jawab Teknis</div>
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
                Dokumen ini merupakan laporan resmi hasil evaluasi dan digunakan untuk keperluan 
                pengambilan keputusan serta pembinaan atlet. Kerahasiaan dokumen ini diharapkan dapat dijaga.
            </em>
        </p>
    </div>
</body>
</html>