<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Individu Atlet</title>
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
        $nomorLaporan = 'RPT/IND/' . date('Y') . '/' . str_pad($atlet->id, 4, '0', STR_PAD_LEFT);
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

        <div class="report-title">Laporan Rapor Individu Atlet</div>
        <div class="report-subtitle">Tahun Penilaian {{ date('Y') }}</div>

        <div class="table-box">
            <div class="section-title">Informasi Atlet</div>
            <table class="identity-table">
                <tr>
                    <td class="label">Nomor Laporan</td>
                    <td class="separator">:</td>
                    <td>{{ $nomorLaporan }}</td>
                    <td class="label">Cabang Olahraga</td>
                    <td class="separator">:</td>
                    <td>{{ $atlet->cabang_olahraga }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Cetak</td>
                    <td class="separator">:</td>
                    <td>{{ $tanggalCetak }}</td>
                    <td class="label">Orang Tua / Wali</td>
                    <td class="separator">:</td>
                    <td>{{ $atlet->orangTua?->user?->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Nama Lengkap</td>
                    <td class="separator">:</td>
                    <td class="font-bold">{{ $atlet->nama }}</td>
                    <td class="label">Umur</td>
                    <td class="separator">:</td>
                    <td>{{ $atlet->umur }} Tahun</td>
                </tr>
                <tr>
                    <td class="label">Jenis Kelamin</td>
                    <td class="separator">:</td>
                    <td>{{ $atlet->jenis_kelamin_lengkap }}</td>
                    <td class="label">Posisi Dominan</td>
                    <td class="separator">:</td>
                    <td>{{ $atlet->posisi_label }}</td>
                </tr>
            </table>
        </div>

        <div class="table-box">
            <div class="section-title">Hasil Rekomendasi Penilaian</div>
            <table class="summary-table">
                <tr>
                    <td class="label">Posisi Rekomendasi</td>
                    <td class="separator">:</td>
                    <td class="font-bold" style="text-transform: uppercase;">{{ ucfirst($rekomendasi['posisi']) }}</td>
                    <td class="label">Skor Evaluasi (Ki)</td>
                    <td class="separator">:</td>
                    <td class="font-bold">{{ number_format($rekomendasi['skor'], 4) }}</td>
                </tr>
            </table>
        </div>

        <div class="table-box">
            <div class="section-title">Detail Nilai Per Kriteria</div>
            <table class="score-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 14%;">Kode</th>
                        <th>Kriteria</th>
                        <th style="width: 15%;">Jenis</th>
                        <th style="width: 15%;">Bobot (%)</th>
                        <th style="width: 15%;">Nilai Atual</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalBobot = 0; @endphp
                    @forelse($kriterias as $index => $kriteria)
                        @php 
                            $bobotAktual = $kriteria->getBobotByPosisi($atlet->posisi);
                            $totalBobot += $bobotAktual; 
                        @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center font-bold">{{ $kriteria->kode_kriteria }}</td>
                            <td>{{ $kriteria->nama_kriteria }}</td>
                            <td class="text-center">{{ ucfirst($kriteria->jenis) }}</td>
                            <td class="text-center">{{ number_format($bobotAktual, 0) }}%</td>
                            <td class="text-center">{{ number_format(optional($nilaiMap->get($kriteria->id))->nilai ?? 0, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Belum ada data kriteria.</td></tr>
                    @endforelse
                    <tr>
                        <td colspan="4" class="text-right font-bold">TOTAL BOBOT POSISI <span style="text-transform: uppercase;">{{ $atlet->posisi_label }}</span></td>
                        <td class="text-center font-bold">{{ $totalBobot }}%</td>
                        <td class="text-center" style="background:#e5e7eb;"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-box">
            <div class="section-title">Kesimpulan</div>
            <div class="notes">
                Berdasarkan hasil rekam medis dan evaluasi tes fisik maupun keahlian, atlet atas nama <span class="font-bold">{{ $atlet->nama }}</span> 
                mendapatkan nilai kalkulasi terbaik pada posisi <span class="font-bold" style="text-transform: uppercase;">{{ ucfirst($rekomendasi['posisi']) }}</span> 
                dengan perolehan skor akhir (Keputusan Sᵢ / Kᵢ) sebesar <span class="font-bold">{{ number_format($rekomendasi['skor'], 4) }}</span>. 
                Hasil rapor individu ini sah diterbitkan untuk dijadikan acuan pembinaan dan komunikasi evaluasi kepada wali murid/orang tua.
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
                    Mengetahui,<br>Orang Tua / Wali
                    <div class="signature-space"></div>
                    <div class="signature-name">{{ $atlet->orangTua?->user?->name ?? '.................................' }}</div>
                </td>
            </tr>
        </table>

        <div class="footer-note">
            Dokumen ini diterbitkan oleh Sekolah Sepak Bola Mitra Surabaya sebagai laporan individu atlet resmi.
        </div>
    </div>
</body>

</html>
