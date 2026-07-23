@extends('admin.layout.master')

@section('content')
<div class="space-y-lg">

    <!-- Flash Alert Sukses -->
    @if(session('success'))
    <div class="p-lg bg-secondary-container text-on-secondary-container border border-primary/20 rounded-xl font-bold shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <!-- Page Header -->
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                <a class="hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-bold">Harga Beli</span>
            </nav>
            <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Harga Beli Resmi</h1>
            <p class="text-on-surface-variant font-body-md text-body-md mt-2">Kelola referensi harga beli jagung harian yang akan menjadi acuan bagi transaksi petani.</p>
        </div>
        <button type="button" onclick="toggleModal(true)" class="inline-flex items-center gap-sm rounded-2xl bg-primary-container px-lg py-3 text-on-primary-container font-bold transition hover:bg-primary active:scale-95 shadow-md">
            <span class="material-symbols-outlined">add_circle</span>
            Tambah Harga Baru
        </button>
    </div>

    <!-- Statistics Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
        <!-- Card 1: Harga Saat Ini -->
        <div class="bg-surface-container-lowest border border-outline-variant/30 p-lg rounded-xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute top-lg right-lg w-10 h-10 bg-secondary-container/50 rounded-full flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined">trending_up</span>
            </div>
            <p class="text-label-md font-label-md text-on-surface-variant mb-sm">Harga Saat Ini</p>
            <div class="flex items-baseline gap-sm">
                <h3 class="font-headline-lg text-headline-lg font-bold text-on-surface">Rp {{ number_format($currentPrice, 0, ',', '.') }}<span class="text-body-md font-normal text-on-surface-variant">/kg</span></h3>
                <span class="font-bold text-label-md flex items-center {{ $priceDiff >= 0 ? 'text-secondary' : 'text-error' }}">
                    {{ $priceDiff >= 0 ? '+Rp ' : '-Rp ' }}{{ number_format(abs($priceDiff), 0, ',', '.') }}
                </span>
            </div>
            <p class="text-label-sm font-label-sm text-on-surface-variant mt-md flex items-center gap-xs">
                <span class="material-symbols-outlined text-[16px]">schedule</span>
                Terakhir Diupdate: {{ $updatedAt }}
            </p>
        </div>
        <!-- Card 2: Harga Tertinggi -->
        <div class="bg-surface-container-lowest border border-outline-variant/30 p-lg rounded-xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-lg right-lg w-10 h-10 bg-tertiary-fixed/30 rounded-full flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined">vertical_align_top</span>
            </div>
            <p class="text-label-md font-label-md text-on-surface-variant mb-sm">Harga Tertinggi (Bulan Ini)</p>
            <h3 class="font-headline-lg text-headline-lg font-bold text-on-surface">Rp {{ number_format($maxPrice, 0, ',', '.') }}<span class="text-body-md font-normal text-on-surface-variant">/kg</span></h3>
            <div class="w-full h-1 bg-surface-container mt-lg rounded-full overflow-hidden">
                <div class="h-full bg-tertiary rounded-full" style="width: {{ $maxBarPercent }}%"></div>
            </div>
        </div>
        <!-- Card 3: Harga Terendah -->
        <div class="bg-surface-container-lowest border border-outline-variant/30 p-lg rounded-xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-lg right-lg w-10 h-10 bg-error-container/30 rounded-full flex items-center justify-center text-error">
                <span class="material-symbols-outlined">vertical_align_bottom</span>
            </div>
            <p class="text-label-md font-label-md text-on-surface-variant mb-sm">Harga Terendah (Bulan Ini)</p>
            <h3 class="font-headline-lg text-headline-lg font-bold text-on-surface">Rp {{ number_format($minPrice, 0, ',', '.') }}<span class="text-body-md font-normal text-on-surface-variant">/kg</span></h3>
            <div class="w-full h-1 bg-surface-container mt-lg rounded-full overflow-hidden">
                <div class="h-full bg-error rounded-full" style="width: {{ $minBarPercent }}%"></div>
            </div>
        </div>
    </div>

    <!-- Price Trend Chart & Info -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-lg">
        <div class="lg:col-span-2 bg-surface-container-lowest border border-outline-variant/30 p-lg rounded-xl shadow-sm">
            <div class="flex items-center justify-between mb-xl">
                <h4 class="font-title-lg text-title-lg text-on-surface">Tren Perubahan Harga Jagung</h4>
                <select id="harga-range" class="bg-surface-container-low border-none rounded-lg text-label-md font-label-md py-xs pl-md pr-xl focus:ring-primary/20">
                    <option>30 Hari Terakhir</option>
                    <option>90 Hari Terakhir</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
            <!-- Simulated Chart Area -->
            <div class="w-full h-64 relative mt-md">
                @if($highestChartPrice > 0)
                <svg class="w-full h-full preserve-3d" viewbox="0 0 800 200">
                    <defs>
                        <linearGradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#0d631b" stop-opacity="0.3"></stop>
                            <stop offset="100%" stop-color="#0d631b" stop-opacity="0"></stop>
                        </linearGradient>
                    </defs>
                    <line stroke="#E2E8F0" stroke-dasharray="4" stroke-width="1" x1="0" x2="800" y1="40" y2="40"></line>
                    <line stroke="#E2E8F0" stroke-dasharray="4" stroke-width="1" x1="0" x2="800" y1="80" y2="80"></line>
                    <line stroke="#E2E8F0" stroke-dasharray="4" stroke-width="1" x1="0" x2="800" y1="120" y2="120"></line>
                    <line stroke="#E2E8F0" stroke-dasharray="4" stroke-width="1" x1="0" x2="800" y1="160" y2="160"></line>
                    
                    @php
                        $points = "";
                        $count = $chartPrices->count();
                        foreach($chartPrices as $index => $cp) {
                            $x = $count > 1 ? ($index / ($count - 1)) * 800 : 400;
                            $y = 200 - (($cp->price / $highestChartPrice) * 140) - 20; 
                            $points .= ($index === 0 ? "M" : " L") . "{$x},{$y}";
                        }
                    @endphp
                    <path class="chart-area-gradient" d="{{ $points }} L800,200 L0,200 Z" fill="url(#chartGradient)"></path>
                    <path d="{{ $points }}" fill="none" stroke="#0d631b" stroke-linecap="round" stroke-width="3"></path>
                </svg>
                @else
                <div class="w-full h-full flex items-center justify-center text-on-surface-variant italic text-body-md bg-surface-container-low/20 rounded-xl">
                    Belum ada rekaman harga masuk untuk menyusun tren grafik.
                </div>
                @endif
                <div class="absolute left-0 bottom-0 w-full flex justify-between px-xs text-[10px] text-on-surface-variant font-medium opacity-60">
                    <span>Awal Periode</span>
                    <span>Akhir Periode</span>
                </div>
            </div>
        </div>
        <div class="bg-primary p-lg rounded-xl shadow-lg relative overflow-hidden group flex flex-col justify-between">
            <div class="absolute -right-8 -top-8 w-32 h-32 bg-on-primary/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
            <div>
                <span class="inline-flex items-center gap-xs px-sm py-xs bg-on-primary/20 text-on-primary rounded-full text-label-sm font-label-sm mb-md">
                    <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">info</span>
                    Analisis Pasar
                </span>
                <h4 class="text-title-lg font-title-lg text-on-primary mb-md">Proyeksi Harga Minggu Depan</h4>
                <p class="text-body-md font-body-md text-on-primary/80 leading-relaxed">
                    Berdasarkan tren pasokan jagung dari wilayah Kluwih dan sekitarnya, harga diprediksi akan mengalami kenaikan stabil sebesar 1.5% - 2% akibat penurunan volume panen raya.
                </p>
            </div>
            <a href="{{ route('admin.laporan') }}" class="w-full py-md mt-lg border border-on-primary/30 rounded-xl text-on-primary font-label-md text-label-md hover:bg-on-primary/10 transition-colors block text-center">
                Lihat Detail Laporan
            </a>
        </div>
    </div>

    <!-- History Table -->
    <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-xl shadow-sm overflow-hidden">
        <div class="p-lg border-b border-outline-variant/30 flex flex-col md:flex-row md:items-center justify-between gap-md">
            <h4 class="font-title-lg text-title-lg text-on-surface">Riwayat Perubahan Harga</h4>
            <div class="flex items-center gap-md">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
                    <input data-search-target="prices" class="pl-xl pr-md py-xs bg-surface-container-low border-none rounded-lg text-label-md focus:ring-primary/20 w-full sm:w-64" placeholder="Cari varietas..." type="text"/>
                </div>
                <button type="button" id="toggle-filter" class="flex items-center gap-sm px-md py-xs border border-outline-variant rounded-lg text-label-md text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span>
                    Filter
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50">
                        <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant border-b border-outline-variant/30">Tanggal</th>
                        <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant border-b border-outline-variant/30">Harga</th>
                        <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant border-b border-outline-variant/30">Varietas</th>
                        <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant border-b border-outline-variant/30">Status</th>
                        <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant border-b border-outline-variant/30 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20" data-table="prices">
                    @forelse($pricesHistory as $index => $history)
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-lg py-md text-body-md font-body-md">{{ $history->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-lg py-md text-body-md font-body-md font-semibold text-primary">Rp {{ number_format($history->price, 0, ',', '.') }}</td>
                        <td class="px-lg py-md text-body-md font-body-md">{{ $history->variety }}</td>
                        <td class="px-lg py-md">
                            @if($index === 0 && $pricesHistory->onFirstPage())
                            <span class="inline-flex items-center px-sm py-1 bg-secondary-container/30 text-secondary rounded-full text-[12px] font-bold">Aktif</span>
                            @else
                            <span class="inline-flex items-center px-sm py-1 bg-surface-container-highest text-on-surface-variant/70 rounded-full text-[12px] font-bold">Arsip</span>
                            @endif
                        </td>
                        <td class="px-lg py-md text-right">
                            <div class="flex items-center justify-end gap-sm">
                                <button type="button"
                                        onclick="openEditModal({{ $history->id }}, '{{ addslashes($history->variety) }}', {{ $history->price }}, {{ $history->moisture_standard }}, '{{ addslashes($history->note ?? '') }}')"
                                        class="p-xs hover:bg-surface-container-high rounded text-on-surface-variant transition-colors"
                                        title="Edit Harga">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <form action="{{ route('admin.harga_beli.destroy', $history->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-xs hover:bg-error-container/20 rounded text-error transition-colors"
                                            title="Hapus Harga"
                                            onclick="return confirmSubmit(event, 'Hapus Data Harga', 'Apakah Anda yakin ingin menghapus data harga {{ addslashes($history->variety) }} (Rp {{ number_format($history->price, 0, ',', '.') }})?')">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-lg py-md text-center text-on-surface-variant italic">Belum ada riwayat entri harga resmi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-lg flex items-center justify-between border-t border-outline-variant/30">
            <p class="text-label-sm font-label-sm text-on-surface-variant">
                Menampilkan {{ $pricesHistory->firstItem() ?? 0 }}-{{ $pricesHistory->lastItem() ?? 0 }} dari {{ $pricesHistory->total() }} data
            </p>
            <div class="flex items-center gap-sm">
                {{ $pricesHistory->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>

<!-- Pop-up Modal Container (FORM DINAMIS TAMBAH / EDIT) -->
<div class="fixed inset-0 z-[100] flex items-center justify-center p-md hidden" id="add-price-modal">
    <div class="absolute inset-0 bg-on-surface/40 backdrop-blur-md" onclick="toggleModal(false)"></div>
    <div class="relative w-full max-w-lg bg-surface-container-lowest rounded-xl shadow-2xl overflow-hidden flex flex-col">
        <div class="p-lg border-b border-outline-variant/30">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-headline-md text-headline-md text-on-surface" id="modal-title">Tambah Harga Beli Baru</h3>
                    <p class="text-body-md text-on-surface-variant mt-xs" id="modal-subtitle">Perbarui harga pasar harian untuk referensi transaksi petani.</p>
                </div>
                <button type="button" class="p-xs hover:bg-surface-container-high rounded-full transition-colors" onclick="toggleModal(false)">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        </div>
        
        <!-- FORM TARGET BACKEND -->
        <form id="price-form" action="{{ route('admin.harga_beli.store_harga') }}" method="POST">
            @csrf
            <div id="method-container"></div>

            <div class="p-lg space-y-lg overflow-y-auto max-h-[70vh] no-scrollbar">
                <div class="bg-secondary-container/30 p-md rounded-lg border border-secondary/20 flex items-center gap-md">
                    <div class="w-10 h-10 bg-secondary-container rounded-full flex items-center justify-center text-secondary flex-shrink-0">
                        <span class="material-symbols-outlined">monitoring</span>
                    </div>
                    <div>
                        <p class="text-label-sm font-bold text-secondary uppercase tracking-wider">Market Pulse</p>
                        <p class="text-body-md text-on-secondary-container">Harga pasar saat ini: Rp {{ number_format($currentPrice, 0, ',', '.') }}/kg</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 gap-md">
                    <div class="flex flex-col gap-xs">
                        <div class="flex justify-between items-center">
                            <label class="text-label-md font-semibold text-on-surface-variant">Varietas Jagung <span class="text-error">*</span></label>
                            <button type="button" onclick="toggleVarietyModal(true)" class="text-primary text-label-sm font-bold hover:underline flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">settings</span> Kelola
                            </button>
                        </div>
                        <select id="variety" name="variety" class="w-full bg-surface-container-low border-outline-variant rounded-lg py-sm px-md focus:ring-primary/20" required>
                            @foreach($varieties as $var)
                                <option value="{{ $var->name }}">{{ $var->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-xs">
                        <label class="text-label-md font-semibold text-on-surface-variant">Harga Beli per KG <span class="text-error">*</span></label>
                        <div class="relative">
                            <span class="absolute left-md top-1/2 -translate-y-1/2 text-on-surface-variant font-medium">Rp</span>
                            <input id="price" name="price" class="w-full pl-xl pr-md py-sm bg-surface-container-low border-outline-variant rounded-lg focus:ring-primary/20" type="number" min="0" required placeholder="Contoh: 4900"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-md">
                        <div class="flex flex-col gap-xs">
                            <label class="text-label-md font-semibold text-on-surface-variant">Standar Kadar Air <span class="text-error">*</span></label>
                            <div class="relative">
                                <input id="moisture_standard" name="moisture_standard" class="w-full pr-xl pl-md py-sm bg-surface-container-low border-outline-variant rounded-lg focus:ring-primary/20" type="number" step="0.1" required value="14"/>
                                <span class="absolute right-md top-1/2 -translate-y-1/2 text-on-surface-variant font-medium">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-xs">
                        <label class="text-label-md font-semibold text-on-surface-variant">Catatan/Keterangan</label>
                        <textarea id="note" name="note" class="w-full bg-surface-container-low border-outline-variant rounded-lg py-sm px-md focus:ring-primary/20 h-24" placeholder="Tambahkan catatan khusus seperti ketersediaan pasokan..."></textarea>
                    </div>
                </div>
            </div>
            <div class="p-lg bg-surface-container-low flex items-center justify-end gap-md">
                <button type="button" class="px-lg py-md text-on-surface-variant font-label-md hover:bg-surface-container-high rounded-lg transition-colors" onclick="toggleModal(false)">Batal</button>
                <button type="submit" id="btn-submit-modal" class="px-lg py-md bg-primary text-on-primary font-bold rounded-lg hover:brightness-110 transition-all shadow-md">Simpan Harga Baru</button>
            </div>
        </form>
    </div>
</div>

<!-- Pop-up Modal Container (KELOLA VARIETAS) -->
<div class="fixed inset-0 z-[110] flex items-center justify-center p-md hidden" id="variety-modal">
    <div class="absolute inset-0 bg-on-surface/40 backdrop-blur-md" onclick="toggleVarietyModal(false)"></div>
    <div class="relative w-full max-w-md bg-surface-container-lowest rounded-xl shadow-2xl overflow-hidden flex flex-col">
        <div class="p-lg border-b border-outline-variant/30">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-headline-md text-headline-md text-on-surface">Kelola Varietas</h3>
                    <p class="text-body-md text-on-surface-variant mt-xs">Tambah atau hapus varietas jagung.</p>
                </div>
                <button type="button" class="p-xs hover:bg-surface-container-high rounded-full transition-colors" onclick="toggleVarietyModal(false)">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        </div>
        
        <div class="p-lg space-y-md">
            <form action="{{ route('admin.variety.store') }}" method="POST" class="flex gap-2 mb-4">
                @csrf
                <input type="text" name="name" class="w-full bg-surface-container-low border-outline-variant rounded-lg py-sm px-md focus:ring-primary/20" placeholder="Nama varietas baru..." required>
                <button type="submit" class="px-md py-sm bg-primary text-on-primary font-bold rounded-lg hover:brightness-110 transition-all whitespace-nowrap">Tambah</button>
            </form>

            <div class="border border-outline-variant/30 rounded-lg overflow-hidden max-h-60 overflow-y-auto">
                <table class="w-full text-left">
                    <tbody class="divide-y divide-outline-variant/20">
                        @forelse($varieties as $var)
                        <tr class="hover:bg-surface-container-low/30">
                            <td class="px-md py-sm text-body-md font-medium text-on-surface">{{ $var->name }}</td>
                            <td class="px-md py-sm text-right">
                                <form action="{{ route('admin.variety.destroy', $var->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-xs hover:bg-error-container/20 rounded text-error transition-colors" title="Hapus" onclick="return confirmSubmit(event, 'Hapus Varietas', 'Apakah Anda yakin ingin menghapus varietas {{ addslashes($var->name) }}?')">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-md py-sm text-center text-on-surface-variant italic">Belum ada varietas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .chart-area-gradient { fill: url(#chartGradient); fill-opacity: 0.15; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
</style>
@endpush

@push('scripts')
<script>
    document.querySelectorAll('[data-search-target="prices"]').forEach(search => {
        search.addEventListener('input', event => {
            const value = event.target.value.toLowerCase();
            document.querySelectorAll('[data-table="prices"] tr').forEach(item => {
                const text = item.innerText.toLowerCase();
                item.style.display = text.includes(value) ? '' : 'none';
            });
        });
    });

    window.addEventListener('DOMContentLoaded', () => {
        const path = document.querySelector('path.chart-area-gradient');
        if (path) {
            path.style.opacity = '0';
            setTimeout(() => {
                path.style.transition = 'opacity 1s ease-in-out';
                path.style.opacity = '1';
            }, 300);
        }
    });

    const modal = document.getElementById('add-price-modal');
    const form  = document.getElementById('price-form');
    const modalTitle = document.getElementById('modal-title');
    const modalSubtitle = document.getElementById('modal-subtitle');
    const methodContainer = document.getElementById('method-container');
    const btnSubmit = document.getElementById('btn-submit-modal');
    const storeUrl = "{{ route('admin.harga_beli.store_harga') }}";
    const updateUrlBase = "{{ url('/admin/harga-beli') }}";

    function toggleModal(show) {
        if (show) {
            // Default: mode Tambah
            form.action = storeUrl;
            methodContainer.innerHTML = '';
            modalTitle.textContent = 'Tambah Harga Beli Baru';
            modalSubtitle.textContent = 'Perbarui harga pasar harian untuk referensi transaksi petani.';
            btnSubmit.textContent = 'Simpan Harga Baru';

            // Reset form
            form.reset();
            document.getElementById('moisture_standard').value = 14;

            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }

    const varietyModal = document.getElementById('variety-modal');
    function toggleVarietyModal(show) {
        if (show) {
            varietyModal.classList.remove('hidden');
        } else {
            varietyModal.classList.add('hidden');
        }
    }

    function openEditModal(id, variety, price, moisture, note) {
        form.action = updateUrlBase + '/' + id;
        methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        modalTitle.textContent = 'Edit Harga Beli Jagung';
        modalSubtitle.textContent = 'Ubah rincian harga beli resmi untuk varietas ' + variety;
        btnSubmit.textContent = 'Simpan Perubahan';

        // Set value
        const varietySelect = document.getElementById('variety');
        if (varietySelect) {
            let found = false;
            for (let i = 0; i < varietySelect.options.length; i++) {
                if (varietySelect.options[i].value === variety) {
                    varietySelect.selectedIndex = i;
                    found = true;
                    break;
                }
            }
            if (!found) {
                const newOpt = new Option(variety, variety, true, true);
                varietySelect.add(newOpt);
            }
        }

        document.getElementById('price').value = price;
        document.getElementById('moisture_standard').value = moisture;
        document.getElementById('note').value = note || '';

        modal.classList.remove('hidden');
    }
</script>
@endpush