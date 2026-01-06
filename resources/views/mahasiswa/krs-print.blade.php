<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak KRS - {{ $mahasiswa->nim }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
        }

        @media print {
            body {
                background-color: white;
            }
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: white;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        @media print {
            .container {
                box-shadow: none;
                margin: 0;
            }
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            color: #666;
        }

        .mahasiswa-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .info-item label {
            display: block;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 5px;
        }

        .info-item span {
            display: block;
            font-size: 14px;
            color: #333;
        }

        .mata-kuliah-section h2 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #f0f0f0;
        }

        table th {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
        }

        table td {
            border: 1px solid #ccc;
            padding: 12px;
            font-size: 13px;
        }

        table tr:nth-child(even) {
            background-color: #fafafa;
        }

        .tipe-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }

        .tipe-teori {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .tipe-praktikum {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }

        .total-row {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 11px;
            color: #666;
        }

        .footer p {
            margin-bottom: 5px;
        }

        .signature {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 50px;
        }

        .signature-box {
            text-align: center;
        }

        .signature-box p {
            font-size: 12px;
            margin-top: 60px;
            border-top: 1px solid #333;
            padding-top: 5px;
        }

        @media print {
            .container {
                box-shadow: none;
            }

            button {
                display: none;
            }
        }

        .print-btn {
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .print-btn:hover {
            background-color: #1976d2;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <button class="print-btn" onclick="window.print()">🖨️ Cetak KRS</button>

        <div class="header">
            <h1>KARTU RENCANA STUDI (KRS)</h1>
            <p>Universitas - Tahun Akademik {{ $mahasiswa->angkatan }}/{{ $mahasiswa->angkatan + 1 }}</p>
        </div>

        <div class="mahasiswa-info">
            <div class="info-item">
                <label>Nama Mahasiswa</label>
                <span>{{ $mahasiswa->user->name }}</span>
            </div>
            <div class="info-item">
                <label>NIM</label>
                <span>{{ $mahasiswa->nim }}</span>
            </div>
            <div class="info-item">
                <label>Program Studi</label>
                <span>{{ $mahasiswa->prodi }}</span>
            </div>
            <div class="info-item">
                <label>Angkatan</label>
                <span>{{ $mahasiswa->angkatan }}</span>
            </div>
        </div>

        <div class="mata-kuliah-section">
            <h2>Daftar Mata Kuliah</h2>

            @if ($nilaiList->isEmpty())
                <p style="text-align: center; color: #999; padding: 20px;">Belum ada mata kuliah yang diambil</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="35%">Mata Kuliah</th>
                            <th width="15%">Tipe Kelas</th>
                            <th width="10%">SKS</th>
                            <th width="35%">Dosen Pengampu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiList as $index => $nilai)
                            <tr>
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td>{{ $nilai->mata_kuliah ?? '-' }}</td>
                                <td>
                                    <span
                                        class="tipe-badge {{ $nilai->tipe_kelas === 'teori' ? 'tipe-teori' : 'tipe-praktikum' }}">
                                        {{ $nilai->tipe_kelas === 'teori' ? 'TEORI' : 'PRAKTIKUM' }}
                                    </span>
                                </td>
                                <td style="text-align: center;">{{ $nilai->sks ?? '-' }}</td>
                                <td>{{ $nilai->dosen->user->name ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <td colspan="3" style="text-align: right;">TOTAL SKS:</td>
                            <td style="text-align: center;">{{ $totalSKS }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            @endif
        </div>

        <div class="signature">
            <div class="signature-box">
                <p>Mahasiswa</p>
                <span>{{ $mahasiswa->user->name }}</span>
            </div>
            <div class="signature-box">
                <p>Pembimbing Akademik</p>
                <span>(...........................)</span>
            </div>
        </div>

        <div class="footer">
            <p><strong>Dicetak pada:</strong> {{ now()->format('d F Y, H:i') }}</p>
            <p><strong>Document ID:</strong> KRS-{{ $mahasiswa->nim }}-{{ now()->format('YmdHis') }}</p>
            <p style="margin-top: 10px; font-style: italic;">Dokumen ini adalah resmi dari Sistem Informasi Akademik
                (SIAKAD). Untuk keperluan akademik dan administratif.</p>
        </div>
    </div>
</body>

</html>
