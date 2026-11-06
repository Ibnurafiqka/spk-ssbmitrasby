<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Perangkingan</title>
    <style>
        * {
            box-sizing: border-box;
        }

        @page {
            margin: 22mm 16mm 22mm 16mm;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
            line-height: 1.45;
            color: #111827;
            margin: 0;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            top: 23%;
            left: 16%;
            width: 68%;
            height: 68%;
            background: url("data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('images/logo-baru.jpg'))) }}") no-repeat center center;
            background-size: contain;
            opacity: 0.10;
            z-index: 50;
            pointer-events: none;
        }

        .page {
            width: 100%;
        }

        .header-table,
        .identity-table,
        .summary-table,
        .score-table,
        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table {
            border-bottom: 3px solid #111827;
            margin-bottom: 12px;
        }

        .header-table td {
            vertical-align: middle;
            padding-bottom: 10px;
        }

        .logo-cell {
            width: 90px;
        }

        .logo-cell img {
            width: 74px;
            height: 74px;
            object-fit: contain;
        }

        .school-name {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            text-align: center;
        }

        .school-subtitle {
            font-size: 13px;
            font-weight: bold;
            text-align: center;
            margin-top: 2px;
        }

        .school-address,
        .school-phone {
            font-size: 11px;
            text-align: center;
            margin-top: 2px;
        }

        .report-title {
            margin: 14px 0 10px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .report-subtitle {
            text-align: center;
            font-size: 12px;
            margin-bottom: 12px;
        }

        .table-box {
            margin-bottom: 12px;
            page-break-inside: avoid;
        }

        .identity-table td,
        .summary-table td,
        .score-table th,
        .score-table td,
        .signature-table td {
            border: 1px solid #111827;
            padding: 6px 8px;
        }

        .identity-table td,
        .summary-table td {
            background: rgba(255, 255, 255, 0.9);
        }

        .label {
            width: 26%;
            font-weight: bold;
        }

        .separator {
            width: 4%;
            text-align: center;
            font-weight: bold;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            background: #e5e7eb;
            border: 1px solid #111827;
            border-bottom: 0;
            padding: 6px 8px;
        }

        .score-table th {
            text-align: center;
            font-weight: bold;
            background: #dbe4f0;
        }

        .score-table td {
            background: rgba(255, 255, 255, 0.92);
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        .notes {
            border: 1px solid #111827;
            padding: 8px 10px;
            background: rgba(255, 255, 255, 0.92);
            text-align: justify;
        }

        .signature-table {
            margin-top: 24px;
            page-break-inside: avoid;
        }

        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            height: 120px;
            background: rgba(255, 255, 255, 0.9);
        }

        .signature-space {
            height: 52px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }

        .footer-note {
            margin-top: 8px;
            font-size: 10px;
            text-align: center;
            color: #374151;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    @php
        $tanggalCetak = date('d F Y');
        $nomorLaporan = 'RPT/ALL/' . date('Y') . '/' . str_pad(count($hasilPerangkingan), 3, '0', STR_PAD_LEFT);
    @endphp

    <div class="page">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('images/logo-baru.jpg'))) }}"
                        alt="Logo Sekolah Sepak Bola">
                </td>
                <td style="padding-right: 90px;">
                    <div class="school-name">Sekolah Sepak Bola Mitra Surabaya</div>
                    <div class="school-address">Jl. Raya Lidah Wetan No. 85, Surabaya, Jawa Timur</div>
                    <div class="school-phone">Telp. (+62) 3854538351</div>
                </td>
            </tr>
        </table>

        <div class="report-title">Laporan Hasil Evaluasi Komprehensif Atlet</div>
        <div class="report-subtitle">Tahun Penilaian {{ date('Y') }}</div>

        <div class="table-box">
            <div class="section-title">Informasi Laporan</div>
            <table class="identity-table">
                <tr>
                    <td class="label">Nomor Laporan</td>
                    <td class="separator">:</td>
                    <td>{{ $nomorLaporan }}</td>
                    <td class="label">Metode Evaluasi</td>
                    <td class="separator">:</td>
                    <td>ARAS (Additive Ratio Assessment)</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Cetak</td>
                    <td class="separator">:</td>
                    <td>{{ $tanggalCetak }}</td>
                    <td class="label">Jumlah Kriteria</td>
                    <td class="separator">:</td>
                    <td>{{ $kriterias->count() }} Parameter</td>
                </tr>
            </table>
        </div>

        <div class="table-box">
            <div class="section-title">Ringkasan Hasil Evaluasi</div>
            <table class="summary-table">
                <tr>
                    <td class="label">Jumlah Atlet Dinilai</td>
                    <td class="separator">:</td>
                    <td>{{ count($hasilPerangkingan) }} Atlet</td>
                    <td class="label">Skor Tertinggi Akhir</td>
                    <td class="separator">:</td>
                    <td>{{ number_format($hasilPerangkingan[0]['Ki'] * 100, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Peringkat #1 (Terbaik)</td>
                    <td class="separator">:</td>
                    <td class="font-bold">{{ $hasilPerangkingan[0]['atlet']->nama }}</td>
                    <td class="label">Nilai Utility Tertinggi</td>
                    <td class="separator">:</td>
                    <td>{{ number_format($hasilPerangkingan[0]['Ki'], 4) }}</td>
                </tr>
            </table>
        </div>

        <div class="table-box">
            <div class="section-title">Parameter Evaluasi</div>
            <table class="score-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 14%;">Kode</th>
                        <th>Kriteria</th>
                        <th style="width: 15%;">Jenis</th>
                        <th style="width: 15%;">Bobot (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalBobot = 0; @endphp
                    @foreach($kriterias as $index => $kriteria)
                        @php $totalBobot += $kriteria->bobot; @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center font-bold">{{ $kriteria->kode_kriteria }}</td>
                            <td>{{ $kriteria->nama_kriteria }}</td>
                            <td class="text-center">{{ ucfirst($kriteria->jenis) }}</td>
                            <td class="text-center">{{ number_format($kriteria->bobot, 0) }}%</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right font-bold">TOTAL BOBOT</td>
                        <td class="text-center font-bold">{{ $totalBobot }}%</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-box">
            <div class="section-title">Hasil Pemeringkatan Final</div>
            <table class="score-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">Ranking</th>
                        <th>Nama Atlet</th>
                        <th style="width: 25%;">Cabang & Umur</th>
                        <th style="width: 15%;">Nilai Sᵢ</th>
                        <th style="width: 15%;">Nilai Kᵢ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasilPerangkingan as $hasil)
                        <tr>
                            <td class="text-center font-bold"
                                style="{{ $hasil['ranking'] <= 3 ? 'background-color: #fef08a;' : '' }}">
                                {{ $hasil['ranking'] }}
                            </td>
                            <td class="font-bold">{{ $hasil['atlet']->nama }}</td>
                            <td class="text-center">{{ $hasil['atlet']->cabang_olahraga }} - {{ $hasil['atlet']->umur }} Th
                            </td>
                            <td class="text-center">{{ number_format($hasil['Si'], 4) }}</td>
                            <td class="text-center font-bold">{{ number_format($hasil['Ki'], 4) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-box">
            <div class="section-title">Kesimpulan</div>
            <div class="notes">
                Berdasarkan hasil perhitungan komprehensif menggunakan sistem metode ARAS (Additive Ratio Assessment),
                terkalkulasi pemeringkatan terhadap <span class="font-bold">{{ count($hasilPerangkingan) }}</span> atlet
                berdasarkan <span class="font-bold">{{ $kriterias->count() }}</span> indikator penilaian.
                Atlet bernama <span class="font-bold">{{ $hasilPerangkingan[0]['atlet']->nama }}</span> meraih peringkat
                pertama
                dengan perolehan skor <span
                    class="font-bold">{{ number_format($hasilPerangkingan[0]['Ki'] * 100, 2) }}</span>.
                Laporan komprehensif ini secara sah diterbitkan untuk dijadikan rujukan utama pelatih dan direksi dalam
                penentuan program pembinaan lanjutan.
            </div>
        </div>

        <table class="signature-table">
            <tr>
                <td>
                    Mengetahui,<br>Pelatih Utama
                    <div class="signature-space"></div>
                    <div class="signature-name">.................................</div>
                </td>
                <td>
                    Mengetahui,<br>Pelatih Pendamping
                    <div class="signature-space"></div>
                    <div class="signature-name">.................................</div>
                </td>
            </tr>
        </table>

        <div class="footer-note">
            Dokumen ini diterbitkan oleh Sekolah Sepak Bola Mitra Surabaya sebagai laporan hasil evaluasi resmi.
        </div>

        <!-- LAMPIRAN PERHITUNGAN MATRIX -->
        @if($matrixKeputusan)
            <div class="page-break"></div>
            <div class="report-title" style="margin-top: 0;">Lampiran Matrix Rekam Jejak Penilaian</div>

            <div class="table-box mt-5">
                <div class="section-title">Matrix Keputusan Awal</div>
                <table class="score-table" style="font-size: 10px;">
                    <thead>
                        <tr>
                            <th style="width: 8%;">Kode</th>
                            <th style="width: 25%;">Alternatif</th>
                            @foreach($kriterias as $kriteria)
                                <th>{{ $kriteria->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matrixKeputusan as $index => $row)
                            <tr>
                                <td class="text-center font-bold">{{ $index == 0 ? 'A₀' : 'A' . $index }}</td>
                                <td>{{ $row['atlet'] ? $row['atlet']->nama : 'REFERENSI OPTIMAL' }}</td>
                                @foreach($kriterias as $kriteria)
                                    <td class="text-center">{{ number_format($row['C' . $kriteria->id], 2) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if($matrixNormalisasi)
            <div class="table-box">
                <div class="section-title">Matrix Normalisasi</div>
                <table class="score-table" style="font-size: 10px;">
                    <thead>
                        <tr>
                            <th style="width: 8%;">Kode</th>
                            <th style="width: 25%;">Alternatif</th>
                            @foreach($kriterias as $kriteria)
                                <th>{{ $kriteria->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matrixNormalisasi as $index => $row)
                            <tr>
                                <td class="text-center font-bold">{{ $index == 0 ? 'A₀' : 'A' . $index }}</td>
                                <td>{{ $row['atlet'] ? $row['atlet']->nama : 'REFERENSI OPTIMAL' }}</td>
                                @foreach($kriterias as $kriteria)
                                    <td class="text-center">{{ number_format($row['C' . $kriteria->id], 4) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if($matrixTerbobot)
            <div class="table-box">
                <div class="section-title">Matrix Terbobot</div>
                <table class="score-table" style="font-size: 10px;">
                    <thead>
                        <tr>
                            <th style="width: 8%;">Kode</th>
                            <th style="width: 25%;">Alternatif</th>
                            @foreach($kriterias as $kriteria)
                                <th>{{ $kriteria->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matrixTerbobot as $index => $row)
                            <tr>
                                <td class="text-center font-bold">{{ $index == 0 ? 'A₀' : 'A' . $index }}</td>
                                <td>{{ $row['atlet'] ? $row['atlet']->nama : 'REFERENSI OPTIMAL' }}</td>
                                @foreach($kriterias as $kriteria)
                                    <td class="text-center">{{ number_format($row['C' . $kriteria->id], 4) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</body>

</html>