<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Laporan Transaksi #{{ $transaction->id }} — SIDJ-Kluwih</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #1a1a1a; background: white; }
        .no-print-bar { background: #1b5e20; color: white; padding: 12px 24px; display: flex; justify-content: space-between; align-items: center; }
        .no-print-bar button { background: white; color: #1b5e20; border: none; padding: 8px 18px; border-radius: 6px; font-weight: bold; cursor: pointer; }
        .document { padding: 30px 40px; max-width: 800px; margin: 0 auto; }
        .header { border-bottom: 3px double #1b5e20; padding-bottom: 16px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-end; }
        .brand h1 { font-size: 24px; font-weight: bold; color: #1b5e20; }
        .brand p { font-size: 11px; color: #555; margin-top: 2px; }
        .doc-title { text-align: right; }
        .doc-title h2 { font-size: 16px; font-weight: bold; color: #333; }
        .doc-title p { font-size: 11px; color: #666; font-family: monospace; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }
        .box { background: #f9fbf9; border: 1px solid #e0e0e0; border-left: 4px solid #1b5e20; padding: 16px; border-radius: 6px; }
        .box-title { font-size: 10px; font-weight: bold; uppercase; color: #1b5e20; letter-spacing: 0.8px; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 4px; }
        .info-row { display: flex; justify-content: space-between; padding: 4px 0; border-bottom: 1px dashed #f0f0f0; }
        .info-row .label { color: #666; }
        .info-row .value { font-weight: bold; color: #111; }
        .badge-selesai { background: #e8f5e9; color: #2e7d32; padding: 3px 10px; border-radius: 999px; font-weight: bold; font-size: 11px; }
        .total-card { background: #1b5e20; color: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
        .total-card .amount { font-size: 22px; font-weight: bold; }
        .footer-note { font-size: 10px; color: #777; border-top: 1px solid #e0e0e0; padding-top: 12px; margin-top: 40px; display: flex; justify-content: space-between; }
        .sign-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 50px; text-align: center; }
        .sign-box { border-top: 1px solid #444; padding-top: 6px; font-size: 11px; width: 180px; margin: 0 auto; }
        @media print {
            .no-print { display: none !important; }
            body { margin: 0; background: white; }
            .document { padding: 0; max-width: 100%; }
            @page { margin: 1.5cm; size: A4; }
        }
    </style>
</head>
<body>

    <div class="no-print no-print-bar">
        <span>📄 Dokumen Bukti Transaksi Laporan #{{ $transaction->id }}</span>
        <button onclick="window.print()">🖨️ Simpan PDF / Cetak</button>
    </div>

    <div class="document">
        <div class="header">
            <div class="brand">
                <h1>🌽 SIDJ-Kluwih</h1>
                <p>Sistem Informasi Dryer Jagung — Desa Kluwih, Kec. Bandar, Kab. Batang, Jawa Tengah</p>
            </div>
            <div class="doc-title">
                <h2>BUKTI TRANSAKSI LAPORAN</h2>
                <p>NO: LAP-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <div class="grid-2">
            <div class="box">
                <div class="box-title">INFORMASI PETANI & REKAP</div>
                <div class="info-row">
                    <span class="label">Nama Petani</span>
                    <span class="value">{{ $transaction->farmer_name }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Jenis Laporan</span>
                    <span class="value">{{ $transaction->jenis_laporan ?? 'Harian' }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Kategori</span>
                    <span class="value">{{ $transaction->kategori ?? 'Berat Jagung' }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Tanggal Dibuat</span>
                    <span class="value">{{ $transaction->created_at->format('d M Y, H:i') }} WIB</span>
                </div>
            </div>

            <div class="box">
                <div class="box-title">SPESIFIKASI PENGERINGAN</div>
                <div class="info-row">
                    <span class="label">Status Pengeringan</span>
                    <span class="value"><span class="badge-selesai">Selesai</span></span>
                </div>
                <div class="info-row">
                    <span class="label">Total Berat</span>
                    <span class="value" style="color:#1b5e20;">{{ number_format($transaction->tonnage, 2, ',', '.') }} Kg</span>
                </div>
                <div class="info-row">
                    <span class="label">Kadar Air Standar</span>
                    <span class="value">14.0%</span>
                </div>
                <div class="info-row">
                    <span class="label">Keterangan</span>
                    <span class="value">{{ $transaction->keterangan ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="total-card">
            <div>
                <p style="font-size:11px;opacity:0.85;text-transform:uppercase;letter-spacing:0.5px;">Estimasi Total Nilai Pasar ({{ number_format($transaction->tonnage, 0, ',', '.') }} kg)</p>
                <p style="font-size:11px;opacity:0.85;">Harga Acuan: Rp {{ number_format($pricePerKg, 0, ',', '.') }} /kg</p>
            </div>
            <div class="amount">
                Rp {{ number_format($totalNilai, 0, ',', '.') }}
            </div>
        </div>

        <div class="sign-grid">
            <div>
                <p style="margin-bottom:60px;color:#555;">Petani Mitra</p>
                <div class="sign-box">( {{ $transaction->farmer_name }} )</div>
            </div>
            <div>
                <p style="margin-bottom:60px;color:#555;">Petugas Operasional Dryer</p>
                <div class="sign-box">( Admin SIDJ-Kluwih )</div>
            </div>
        </div>

        <div class="footer-note">
            <span>Dokumen ini diterbitkan secara resmi oleh Sistem Informasi Dryer Jagung (SIDJ-Kluwih).</span>
            <span>Dicetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }} WIB</span>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            setTimeout(() => window.print(), 600);
        });
    </script>
</body>
</html>
