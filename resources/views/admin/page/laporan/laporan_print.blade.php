<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi — SIDJ-Kluwih</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #1a1a1a; background: white; }
        .header { background: #1b5e20; color: white; padding: 20px 30px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 22px; font-weight: bold; }
        .header p { font-size: 11px; opacity: 0.85; margin-top: 3px; }
        .header-right { text-align: right; font-size: 11px; }
        .body { padding: 24px 30px; }
        .meta-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px; }
        .meta-box { background: #f1f8e9; border-left: 4px solid #2e7d32; padding: 12px 16px; border-radius: 4px; }
        .meta-box .label { font-size: 9px; text-transform: uppercase; letter-spacing: 0.8px; color: #557a5a; font-weight: bold; }
        .meta-box .value { font-size: 18px; font-weight: bold; color: #1b5e20; margin-top: 2px; }
        .meta-box .sub { font-size: 10px; color: #666; margin-top: 2px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        thead tr { background: #1b5e20; color: white; }
        thead th { padding: 10px 12px; text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: bold; }
        tbody tr:nth-child(even) { background: #f9fbe7; }
        tbody tr:hover { background: #e8f5e9; }
        tbody td { padding: 9px 12px; border-bottom: 1px solid #e0e0e0; vertical-align: middle; }
        .badge-selesai { background: #e8f5e9; color: #2e7d32; padding: 2px 8px; border-radius: 999px; font-size: 10px; font-weight: bold; }
        .badge-proses { background: #fff8e1; color: #e65100; padding: 2px 8px; border-radius: 999px; font-size: 10px; font-weight: bold; }
        .footer { margin-top: 30px; padding-top: 16px; border-top: 2px solid #e0e0e0; display: flex; justify-content: space-between; align-items: flex-end; }
        .footer-left { font-size: 10px; color: #888; }
        .footer-right { text-align: right; font-size: 10px; color: #888; }
        .sign-area { margin-top: 60px; display: flex; justify-content: flex-end; }
        .sign-box { text-align: center; border-top: 1px solid #333; width: 160px; padding-top: 6px; font-size: 10px; }
        @media print {
            body { margin: 0; }
            .no-print { display: none !important; }
            @page { margin: 1.5cm; size: A4; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="background:#1b5e20;color:white;padding:10px 20px;display:flex;justify-content:space-between;align-items:center;">
        <span style="font-weight:bold;">Preview PDF — SIDJ-Kluwih</span>
        <button onclick="window.print()" style="background:white;color:#1b5e20;border:none;padding:8px 20px;border-radius:6px;font-weight:bold;cursor:pointer;">🖨️ Cetak / Simpan PDF</button>
    </div>

    <div class="header">
        <div>
            <h1>🌽 SIDJ-Kluwih</h1>
            <p>Sistem Informasi Dryer Jagung — Desa Kluwih, Kec. Bandar, Kab. Batang, Jawa Tengah</p>
        </div>
        <div class="header-right">
            <strong style="font-size:14px;">LAPORAN TRANSAKSI</strong><br>
            Periode: {{ $startDate->format('d M Y') }} – {{ $endDate->format('d M Y') }}<br>
            Dicetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB
        </div>
    </div>

    <div class="body">
        {{-- Summary Cards --}}
        <div class="meta-grid">
            <div class="meta-box">
                <div class="label">Total Transaksi</div>
                <div class="value">{{ $data->count() }}</div>
                <div class="sub">laporan terdaftar</div>
            </div>
            <div class="meta-box">
                <div class="label">Total Berat</div>
                <div class="value">{{ number_format($totalTonase, 1, ',', '.') }} Kg</div>
                <div class="sub">seluruh transaksi periode ini</div>
            </div>
            <div class="meta-box">
                <div class="label">Harga Pasar Terkini</div>
                <div class="value">Rp {{ $latestPrice ? number_format($latestPrice->price, 0, ',', '.') : '0' }}</div>
                <div class="sub">per kilogram • {{ $latestPrice ? $latestPrice->variety : '-' }}</div>
            </div>
        </div>

        {{-- Table --}}
        <table>
            <thead>
                <tr>
                    <th style="width:30px">No</th>
                    <th>Tanggal</th>
                    <th>Nama Petani</th>
                    <th>Jenis</th>
                    <th>Kategori</th>
                    <th style="text-align:right">Berat (Kg)</th>
                    <th style="text-align:center">Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td><strong>{{ $item->farmer_name }}</strong></td>
                    <td>{{ $item->jenis_laporan ?? '-' }}</td>
                    <td>{{ $item->kategori ?? '-' }}</td>
                    <td style="text-align:right;font-weight:bold;color:#2e7d32">{{ number_format($item->tonnage, 2, ',', '.') }}</td>
                    <td style="text-align:center">
                        @if($item->status === 'Selesai')
                            <span class="badge-selesai">Selesai</span>
                        @else
                            <span class="badge-proses">Proses</span>
                        @endif
                    </td>
                    <td style="color:#666;font-size:10px">{{ $item->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:20px;color:#999">Tidak ada data pada periode ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Footer --}}
        <div class="footer">
            <div class="footer-left">
                Dokumen ini digenerate otomatis oleh Sistem Informasi Dryer Jagung Kluwih (SIDJ-Kluwih)<br>
                {{ url('/admin/laporan') }}
            </div>
            <div class="footer-right">
                Total Berat: <strong>{{ number_format($totalTonase, 2, ',', '.') }} Kg</strong><br>
                Jumlah Records: {{ $data->count() }} transaksi
            </div>
        </div>

        <div class="sign-area">
            <div class="sign-box">
                Penanggung Jawab<br><br><br>
                (________________________)
            </div>
        </div>
    </div>

    <script>
        // Auto-trigger print dialog saat halaman ini dibuka
        window.addEventListener('load', () => {
            setTimeout(() => window.print(), 800);
        });
    </script>
</body>
</html>
