@extends('user.layout.master')

@section('title', 'Pusat Data Jagung - SIDJ-Kluwih')

@section('content')
    {{-- Hero Section --}}
    <section class="relative w-full overflow-hidden pt-10 pb-8 px-6 lg:px-16 hero-pattern">
        <div class="max-w-7xl mx-auto relative z-10">
            <nav class="flex mb-4 text-xs uppercase tracking-widest text-primary font-bold">
                <a href="{{ route('user.beranda') }}" class="hover:underline">Beranda</a>
                <span class="mx-2 text-on-surface-variant">/</span>
                <span class="text-on-surface-variant">Data Jagung</span>
            </nav>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-end">
                <div>
                    <h1 class="text-4xl lg:text-5xl font-bold text-primary leading-tight mb-4">Pusat Data Jagung Kolektif</h1>
                    <p class="text-lg text-on-surface-variant max-w-xl">
                        Pantau transparansi hasil panen wilayah secara publik. Data diperbarui secara berkala dan dianonymisasi untuk menjaga privasi petani.
                    </p>
                </div>
                {{-- Search Bar --}}
                <div class="w-full max-w-md">
                    <label class="block text-sm font-bold text-primary mb-2" for="track-id">Cari Data Setoran Anda</label>
                    <form method="GET" action="{{ route('user.data_jagung') }}" class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-4 text-on-surface-variant">search</span>
                        <input class="w-full pl-12 pr-36 py-4 border-2 border-outline-variant rounded-xl focus:ring-primary focus:border-primary text-sm shadow-sm bg-surface" id="track-id" name="search" value="{{ request('search') }}" placeholder="Cari nama petani atau batch..." type="text"/>
                        <button type="submit" class="absolute right-2 bg-primary text-on-primary px-4 py-2.5 rounded-lg font-bold text-xs hover:brightness-110 active:scale-95 transition-all">
                            CARI DATA
                        </button>
                    </form>
                    @if(request('search'))
                    <div class="mt-2 text-xs text-on-surface-variant">
                        Menampilkan hasil pencarian untuk "{{ request('search') }}". <a href="{{ route('user.data_jagung') }}" class="text-primary font-bold hover:underline">Hapus pencarian</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Bento Grid --}}
    <section class="px-6 lg:px-16 py-6 max-w-7xl mx-auto w-full">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            {{-- Tonase Hari Ini --}}
            <div class="bg-surface border border-outline-variant p-6 rounded-2xl flex flex-col justify-between hover:shadow-lg transition-all duration-300 reveal active">
                <div class="flex justify-between items-start">
                    <div class="p-2 bg-secondary-container rounded-full text-on-secondary-container">
                        <span class="material-symbols-outlined">inventory_2</span>
                    </div>
                    <span class="text-xs font-bold text-secondary">Hari Ini</span>
                </div>
                <div class="mt-6">
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider font-medium">Total Berat Masuk (Kg)</p>
                    <h2 class="text-3xl font-bold text-on-surface mt-1">{{ $tonnageToday > 0 ? number_format($tonnageToday, 0, ',', '.') : '—' }} <span class="text-xl font-medium">Kg</span></h2>
                </div>
            </div>
            {{-- Harga Pasar --}}
            <div class="bg-primary-container text-on-primary-container p-6 rounded-2xl flex flex-col justify-between hover:shadow-lg transition-all duration-300 reveal active" style="transition-delay:100ms">
                <div class="flex justify-between items-start">
                    <div class="p-2 bg-on-primary-container/20 rounded-full">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <span class="text-xs font-bold">{{ $marketVariety }}</span>
                </div>
                <div class="mt-6">
                    <p class="text-xs uppercase tracking-wider font-medium opacity-80">Harga Beli Resmi Terkini</p>
                    <h2 class="text-3xl font-bold mt-1">Rp {{ $marketPrice }} <span class="text-xl font-medium">/kg</span></h2>
                </div>
            </div>
            {{-- Jumlah Data --}}
            <div class="bg-surface border border-outline-variant p-6 rounded-2xl flex flex-col justify-between hover:shadow-lg transition-all duration-300 reveal active" style="transition-delay:200ms">
                <div class="flex justify-between items-start">
                    <div class="p-2 bg-tertiary-fixed rounded-full text-on-tertiary-fixed">
                        <span class="material-symbols-outlined">table_rows</span>
                    </div>
                    <span class="text-xs font-bold text-tertiary">Publik</span>
                </div>
                <div class="mt-6">
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider font-medium">Data Setor Terverifikasi</p>
                    <h2 class="text-3xl font-bold text-on-surface mt-1">{{ $transactions->count() }} <span class="text-xl font-medium">Record</span></h2>
                </div>
            </div>
        </div>
    </section>

    {{-- Charts & Filter Section --}}
    <section class="px-6 lg:px-16 py-6 max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-4 gap-6">
        {{-- Filter Sidebar --}}
        <div class="lg:col-span-1 space-y-4">
            <div class="bg-surface p-5 rounded-2xl border border-outline-variant shadow-sm">
                <h3 class="text-base font-bold mb-4 flex items-center gap-2 text-primary">
                    <span class="material-symbols-outlined">filter_list</span> Filter Publik
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-xs block mb-1 text-on-surface-variant font-medium">Periode Panen</label>
                        <select class="w-full border border-outline-variant rounded-lg px-3 py-2 focus:ring-primary focus:border-primary text-sm bg-surface">
                            @for($i = 0; $i < 6; $i++)
                            <option>{{ \Carbon\Carbon::now()->subMonths($i)->translatedFormat('F Y') }}</option>
                            @endfor
                        </select>
                    </div>
                    <button class="w-full bg-surface-container text-primary font-bold py-2 rounded-lg hover:bg-primary hover:text-on-primary active:scale-95 transition-all duration-200 text-sm">
                        Terapkan Filter
                    </button>
                </div>
            </div>
            <div class="bg-primary text-on-primary p-5 rounded-2xl shadow-lg relative overflow-hidden group">
                <div class="relative z-10">
                    <h4 class="text-base font-bold mb-2">Ada Kendala Data?</h4>
                    <p class="text-xs opacity-90 mb-4 leading-relaxed">Hubungi petugas gudang kami jika data setoran Anda belum muncul atau tidak sesuai.</p>
                    <a href="{{ route('user.kontak') }}" class="inline-flex items-center gap-1 bg-on-primary text-primary px-4 py-2 rounded-lg font-bold text-xs active:scale-95 transition-all">
                        Hubungi Petugas
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
                <span class="material-symbols-outlined absolute -bottom-4 -right-4 text-9xl opacity-10 group-hover:scale-110 transition-transform pointer-events-none">support_agent</span>
            </div>
        </div>

        {{-- Trends Chart --}}
        <div class="lg:col-span-3 bg-surface p-5 rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="flex justify-between items-center mb-5">
                <div>
                    <h3 class="text-base font-bold text-on-surface">Volume Setoran Wilayah</h3>
                    <p class="text-xs text-on-surface-variant">Perbandingan produktivitas kolektif (6 bulan terakhir)</p>
                </div>
                <span class="flex items-center gap-1.5 text-xs text-primary font-medium">
                    <span class="w-3 h-3 bg-primary rounded-full"></span> Berat Kolektif (Kg)
                </span>
            </div>
            <div class="flex items-end justify-between gap-2 px-2 pb-8 h-44">
                @foreach($monthlyData as $i => $val)
                @php $pct = $maxMonthly > 0 ? max(4, round(($val / $maxMonthly) * 100)) : 4; @endphp
                <div class="flex flex-col items-center gap-1.5 w-full group">
                    <div class="w-full bg-surface-container rounded-t-lg relative flex flex-col justify-end h-full">
                        <div class="bg-primary/60 w-full rounded-t-lg transition-all duration-500 group-hover:bg-primary" style="height:{{ $pct }}%"></div>
                    </div>
                    <span class="text-xs text-on-surface-variant {{ $i === count($monthlyData)-1 ? 'text-primary font-bold' : '' }}">{{ $monthLabels[$i] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Data Table Section --}}
    <section class="px-6 lg:px-16 py-6 max-w-7xl mx-auto w-full">
        <div class="bg-surface rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
            <div class="p-5 border-b border-outline-variant flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
                <h3 class="text-base font-bold text-on-surface">Riwayat Setoran (Publik)</h3>
                <p class="text-xs text-on-surface-variant italic">Data dianonymisasi untuk privasi petani</p>
            </div>
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-6 py-3 text-xs text-on-surface-variant uppercase tracking-wide font-semibold">Tanggal Setor</th>
                            <th class="px-6 py-3 text-xs text-on-surface-variant uppercase tracking-wide font-semibold">Petani (Anonym)</th>
                            <th class="px-6 py-3 text-xs text-on-surface-variant uppercase tracking-wide font-semibold">Batch Pengeringan</th>
                            <th class="px-6 py-3 text-xs text-on-surface-variant uppercase tracking-wide font-semibold">Jenis</th>
                            <th class="px-6 py-3 text-xs text-on-surface-variant uppercase tracking-wide font-semibold text-right">Berat (Kg)</th>
                            <th class="px-6 py-3 text-xs text-on-surface-variant uppercase tracking-wide font-semibold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($transactions as $trx)
                        @php
                            $session = \App\Models\DryingSession::where('farmer_name', $trx->farmer_name)->latest()->first();
                            $batchName = $session ? $session->batch_name : 'Batch Main Dryer';
                            
                            $name = $trx->farmer_name;
                            $parts = explode(' ', $name);
                            $masked = collect($parts)->map(fn($p) => substr($p,0,1) . str_repeat('*', max(1,strlen($p)-1)))->join(' ');
                        @endphp
                        <tr class="hover:bg-surface-container-low transition-colors cursor-pointer" onclick="openDetailModal('{{ $trx->id }}', '{{ addslashes($masked) }}', '{{ \Carbon\Carbon::parse($trx->tanggal_selesai ?? $trx->created_at)->format('d M Y') }}', '{{ addslashes($batchName) }}', '{{ addslashes($trx->jenis_laporan ?? $trx->kategori ?? 'Jagung') }}', '{{ number_format($trx->tonnage, 0, ',', '.') }}', '{{ addslashes($trx->keterangan ?? '-') }}')">
                            <td class="px-6 py-4 text-sm text-on-surface">{{ \Carbon\Carbon::parse($trx->tanggal_selesai ?? $trx->created_at)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm text-on-surface">
                                {{ $masked }}
                            </td>
                            <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $batchName }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-primary">{{ $trx->jenis_laporan ?? $trx->kategori ?? 'Jagung' }}</td>
                            <td class="px-6 py-4 text-sm text-on-surface text-right">{{ number_format($trx->tonnage, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="flex items-center justify-center gap-1 text-primary font-bold text-xs">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">verified</span>
                                    Selesai
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant">
                                <span class="material-symbols-outlined text-4xl block mb-2">inbox</span>
                                <p class="text-sm">Belum ada data setoran yang tersedia.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-surface-container flex justify-between items-center text-xs text-on-surface-variant">
                <p>Menampilkan {{ $transactions->count() }} data publik terakhir</p>
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-16 py-12 mb-8">
        <div class="relative bg-surface-container rounded-3xl p-10 flex flex-col md:flex-row items-center justify-between gap-8 overflow-hidden shadow-sm border border-outline-variant reveal">
            <div class="relative z-10 max-w-xl text-center md:text-left">
                <h2 class="text-2xl font-bold text-primary mb-3">Akses Layanan Unggulan Gudang Kluwih</h2>
                <p class="text-on-surface-variant">Butuh informasi lebih lanjut mengenai penjadwalan dryer atau ingin berkonsultasi dengan tim ahli kami?</p>
            </div>
            <div class="relative z-10 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('user.kontak') }}" class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold text-sm shadow-lg hover:scale-105 active:scale-95 transition-all">Hubungi Petugas</a>
                <a href="{{ route('user.layanan') }}" class="bg-surface text-primary border-2 border-primary px-8 py-3 rounded-xl font-bold text-sm hover:bg-primary-container/10 active:scale-95 transition-all">Lihat Layanan</a>
            </div>
        </div>
    </section>

    {{-- Modal Detail Transaksi (Public) --}}
    <div id="detailModal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-surface rounded-3xl max-w-md w-full p-6 shadow-2xl border border-outline-variant space-y-6 relative animate-in fade-in zoom-in duration-200">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between border-b border-outline-variant pb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined">description</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-on-surface">Detail Setoran</h3>
                        <p class="text-xs text-on-surface-variant">Laporan ID: <span id="mId">#0000</span></p>
                    </div>
                </div>
                <button type="button" onclick="closeDetailModal()" class="text-on-surface-variant hover:text-on-surface p-1">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-3 bg-surface-container rounded-xl border border-outline-variant/30">
                        <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Petani (Anonym)</p>
                        <p class="text-sm font-extrabold text-on-surface mt-1" id="mFarmerName">-</p>
                    </div>
                    <div class="p-3 bg-surface-container rounded-xl border border-outline-variant/30">
                        <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Tanggal Setor</p>
                        <p class="text-sm font-extrabold text-on-surface mt-1" id="mDate">-</p>
                    </div>
                </div>

                <div class="p-3 bg-surface-container rounded-xl border border-outline-variant/30">
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Batch Pengeringan</p>
                    <p class="text-sm font-extrabold text-primary mt-1" id="mBatchName">-</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="p-3 bg-surface-container rounded-xl border border-outline-variant/30">
                        <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Jenis</p>
                        <p class="text-sm font-bold text-on-surface mt-1" id="mType">-</p>
                    </div>
                    <div class="p-3 bg-primary/10 rounded-xl border border-primary/20">
                        <p class="text-[10px] font-bold text-primary uppercase tracking-wider">Berat Bersih</p>
                        <p class="text-base font-black text-primary mt-0.5"><span id="mTonnage">0</span> Kg</p>
                    </div>
                </div>

                <div class="p-3 bg-surface-container rounded-xl border border-outline-variant/30">
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Status</p>
                    <div class="mt-1 flex items-center gap-1 text-primary font-bold text-xs">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">verified</span>
                        Terverifikasi Selesai
                    </div>
                </div>

                <div class="p-3 bg-surface-container rounded-xl border border-outline-variant/30">
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Keterangan / Catatan</p>
                    <p class="text-xs text-on-surface-variant mt-1 leading-relaxed" id="mNotes">-</p>
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="pt-2 flex justify-end">
                <button type="button" onclick="closeDetailModal()" class="w-full px-6 py-3 bg-primary text-on-primary rounded-xl font-bold transition-all shadow-md text-sm hover:brightness-110 active:scale-95">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        function openDetailModal(id, farmerName, date, batchName, type, tonnage, notes) {
            document.getElementById('mId').textContent = '#' + String(id).padStart(5, '0');
            document.getElementById('mFarmerName').textContent = farmerName;
            document.getElementById('mDate').textContent = date;
            document.getElementById('mBatchName').textContent = batchName;
            document.getElementById('mType').textContent = type;
            document.getElementById('mTonnage').textContent = tonnage;
            document.getElementById('mNotes').textContent = notes || '-';
            
            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target === modal) {
                closeDetailModal();
            }
        });
    </script>
@endsection