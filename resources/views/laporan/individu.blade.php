<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Perkembangan Atlet - {{ $atlet->nama }}</title>
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
            opacity: 0.06;
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
    </style>
</head>

<body>
    @php
        $tanggalCetak = date('d F Y');
        $nomorLaporan = 'RPT/' . date('Y') . '/' . str_pad($atlet->id, 4, '0', STR_PAD_LEFT);
        $predikat = 'Perlu Pembinaan';

        if ($hasilAtlet['Ki'] >= 0.8) {
            $predikat = 'Sangat Baik';
        } elseif ($hasilAtlet['Ki'] >= 0.6) {
            $predikat = 'Baik';
        } elseif ($hasilAtlet['Ki'] >= 0.4) {
            $predikat = 'Cukup';
        }
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

        <div class="report-title">Rapor Hasil Evaluasi Atlet</div>
        <div class="report-subtitle">Tahun Penilaian {{ date('Y') }}</div>

        <div class="table-box">
            <div class="section-title">Identitas Atlet</div>
            <table class="identity-table">
                <tr>
                    <td class="label">Nama Atlet</td>
                    <td class="separator">:</td>
                    <td>{{ $atlet->nama }}</td>
                    <td class="label">Nomor Rapor</td>
                    <td class="separator">:</td>
                    <td>{{ $nomorLaporan }}</td>
                </tr>
                <tr>
                    <td class="label">Cabang Olahraga</td>
                    <td class="separator">:</td>
                    <td>{{ $atlet->cabang_olahraga }}</td>
                    <td class="label">Umur</td>
                    <td class="separator">:</td>
                    <td>{{ $atlet->umur }} Tahun</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Cetak</td>
                    <td class="separator">:</td>
                    <td>{{ $tanggalCetak }}</td>
                    <td class="label">Peringkat</td>
                    <td class="separator">:</td>
                    <td>{{ $hasilAtlet['ranking'] }} dari {{ count($hasilPerangkingan) }} atlet</td>
                </tr>
            </table>
        </div>

        <div class="table-box">
            <div class="section-title">Ringkasan Hasil Penilaian</div>
            <table class="summary-table">
                <tr>
                    <td class="label">Nilai Utility (Ki)</td>
                    <td class="separator">:</td>
                    <td>{{ number_format($hasilAtlet['Ki'], 4) }}</td>
                    <td class="label">Skor Akhir</td>
                    <td class="separator">:</td>
                    <td>{{ number_format($hasilAtlet['Ki'] * 100, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Predikat</td>
                    <td class="separator">:</td>
                    <td>{{ $predikat }}</td>
                    <td class="label">Jumlah Peserta Dinilai</td>
                    <td class="separator">:</td>
                    <td>{{ count($hasilPerangkingan) }} atlet</td>
                </tr>
            </table>
        </div>

        <div class="table-box">
            <div class="section-title">Nilai Per Kriteria</div>
            <table class="score-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 14%;">Kode</th>
                        <th>Kriteria</th>
                        <th style="width: 12%;">Jenis</th>
                        <th style="width: 12%;">Bobot</th>
                        <th style="width: 14%;">Nilai</th>
                        <th style="width: 16%;">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriterias as $index => $kriteria)
                        @php
                            $nilai = $nilaiAtlet['C' . $kriteria->id] ?? 0;
                            $nilaiMaks = 0;

                            foreach ($matrixKeputusan as $row) {
                                if ($row['atlet'] && isset($row['C' . $kriteria->id])) {
                                    $nilaiMaks = max($nilaiMaks, $row['C' . $kriteria->id]);
                                }
                            }

                            $persentase = $nilaiMaks > 0 ? ($nilai / $nilaiMaks) * 100 : 0;
                            $kategori = 'Perlu Pembinaan';

                            if ($persentase >= 80) {
                                $kategori = 'Sangat Baik';
                            } elseif ($persentase >= 60) {
                                $kategori = 'Baik';
                            } elseif ($persentase >= 40) {
                                $kategori = 'Cukup';
                            }
                        @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center font-bold">{{ $kriteria->kode_kriteria }}</td>
                            <td>{{ $kriteria->nama_kriteria }}</td>
                            <td class="text-center">{{ ucfirst($kriteria->jenis) }}</td>
                            <td class="text-center">{{ number_format($kriteria->bobot, 0) }}%</td>
                            <td class="text-center">{{ number_format($nilai, 2) }}</td>
                            <td class="text-center">{{ $kategori }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-box">
            <div class="section-title">Catatan Pelatih</div>
            <div class="notes">
                Berdasarkan hasil evaluasi metode ARAS, atlet <span class="font-bold">{{ $atlet->nama }}</span>
                memperoleh skor akhir <span class="font-bold">{{ number_format($hasilAtlet['Ki'] * 100, 2) }}</span>
                dengan predikat <span class="font-bold">{{ $predikat }}</span>. Hasil ini menunjukkan bahwa atlet
                berada pada peringkat <span class="font-bold">{{ $hasilAtlet['ranking'] }}</span> dari
                <span class="font-bold">{{ count($hasilPerangkingan) }}</span> atlet yang dinilai. Rapor ini
                menjadi dasar pelatih dalam menetapkan program latihan lanjutan dan evaluasi perkembangan berikutnya.
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
            Dokumen ini diterbitkan oleh Sekolah Sepak Bola Mitra Surabaya sebagai rapor evaluasi resmi atlet.
        </div>
    </div>
</body>

</html>