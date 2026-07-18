@extends('admin.layout.master')

@section('content')
<!-- Background Dashboard Layer (Simplified Representation for Context) -->
<div class="flex">
    <!-- Main Content Canvas (Blurred/Background context) -->
    <div class="flex-1 p-lg">
        <!-- Dashboard Stats Grid (Background) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg mb-lg">
            <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm h-32"></div>
            <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm h-32"></div>
            <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm h-32"></div>
        </div>
        <!-- Table Container (Background) -->
        <div class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden h-96"></div>
    </div>
</div>

<!-- Modal Overlay (Pop-up Container) -->
<div class="fixed inset-0 z-[100] flex items-center justify-center glass-overlay p-md overflow-y-auto" id="modal-container">
    <!-- Modal Dialog -->
    <div class="bg-surface-container-lowest w-full max-w-2xl rounded-2xl modal-shadow overflow-hidden transform transition-all duration-300 scale-100 flex flex-col">
        <!-- Modal Header -->
        <div class="p-lg border-b border-outline-variant bg-surface flex justify-between items-center">
            <div class="flex items-center gap-md">
                <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add_circle</span>
                </div>
                <div>
                    <h3 class="font-headline-md text-headline-md font-bold text-on-surface">Tambah Data Tonase Jagung</h3>
                    <p class="text-on-surface-variant font-label-md">Catat setoran jagung baru ke sistem manajemen kluwih.</p>
                </div>
            </div>
            <button class="p-base hover:bg-surface-container-high rounded-full transition-colors" onclick="closeModal()">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <!-- Modal Content (Form) -->
        <div class="p-lg space-y-lg overflow-y-auto max-h-[70vh]">
            <form class="grid grid-cols-1 md:grid-cols-2 gap-x-lg gap-y-md">
                <!-- Farmer Name -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block font-label-md text-on-surface-variant mb-sm">Nama Petani</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">person_search</span>
                        <select class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary appearance-none">
                            <option disabled="" selected="">Cari atau pilih nama petani...</option>
                            <option>Ahmad Subagyo (Kelompok Tani Merdeka)</option>
                            <option>Siti Aminah (Kelompok Tani Hijau)</option>
                            <option>Bambang Prakoso (Mitra Mandiri)</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                    </div>
                </div>
                <!-- Corn Variety -->
                <div class="col-span-1">
                    <label class="block font-label-md text-on-surface-variant mb-sm">Varietas Jagung</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">grass</span>
                        <select class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary appearance-none">
                            <option>Pioneer P35</option>
                            <option>NK Sumo</option>
                            <option>Bisi 18</option>
                            <option>Advanta ADV 777</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                    </div>
                </div>
                <!-- Deposit Date -->
                <div class="col-span-1">
                    <label class="block font-label-md text-on-surface-variant mb-sm">Tanggal Setoran</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">calendar_today</span>
                        <input class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary" type="date" value="2026-07-14"/>
                    </div>
                </div>
                <!-- Gross Weight -->
                <div class="col-span-1">
                    <label class="block font-label-md text-on-surface-variant mb-sm">Berat Kotor (MT)</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">scale</span>
                        <input class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary" placeholder="0.00" step="0.01" type="number"/>
                    </div>
                </div>
                <!-- Moisture Content -->
                <div class="col-span-1">
                    <label class="block font-label-md text-on-surface-variant mb-sm">Kadar Air (%)</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">humidity_mid</span>
                        <input class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary" id="input-moisture" step="0.1" type="number" value="14.0"/>
                    </div>
                </div>
                <!-- Warehouse Location -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block font-label-md text-on-surface-variant mb-sm">Lokasi Gudang Penyimpanan</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">warehouse</span>
                        <select class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary appearance-none">
                            <option>Gudang A - Kapasitas Utama</option>
                            <option>Gudang B - Buffer Stock</option>
                            <option>Gudang C - Pengeringan</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                    </div>
                </div>
            </form>
            
            <!-- Pricing Insight Section -->
            <div class="bg-surface-container-high rounded-xl p-lg border-l-4 border-primary mt-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-md">
                <div class="space-y-xs">
                    <div class="flex items-center gap-sm text-on-surface-variant">
                        <span class="material-symbols-outlined text-sm">calculate</span>
                        <span class="font-label-sm uppercase tracking-wider">Kalkulasi Otomatis (Estimasi)</span>
                    </div>
                    <div class="flex items-baseline gap-md">
                        <h4 class="text-title-lg font-bold text-primary">IDR 4.250<span class="text-sm font-normal text-on-surface-variant">/kg</span></h4>
                        <div class="px-sm py-xs bg-primary text-on-primary rounded text-[10px] font-bold">BASE 14% KA</div>
                    </div>
                    <p class="text-xs text-outline italic leading-tight">Harga menyesuaikan kadar air & standar industri terkini.</p>
                </div>
                <div class="text-right w-full md:w-auto">
                    <div class="text-label-sm text-outline">Estimasi Tonase Bersih</div>
                    <div class="text-headline-md font-bold text-on-surface-variant">-- MT</div>
                </div>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="p-lg bg-surface border-t border-outline-variant flex flex-col md:flex-row gap-md justify-end">
            <button class="px-lg py-md rounded-lg font-bold text-on-surface-variant hover:bg-surface-container-high transition-colors order-2 md:order-1" onclick="closeModal()">
                Batal
            </button>
            <button class="px-xl py-md rounded-lg font-bold bg-primary text-on-primary hover:bg-primary-container active:scale-95 transition-all shadow-md shadow-primary/20 order-1 md:order-2 flex items-center justify-center gap-md">
                <span class="material-symbols-outlined text-[20px]">save</span>
                Simpan Data Jagung
            </button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .glass-overlay {
        background: rgba(17, 28, 45, 0.4);
        backdrop-filter: blur(8px);
    }
    .modal-shadow {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    // Micro-interactions for form inputs
    document.querySelectorAll('input, select').forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.classList.add('shadow-sm');
        });
        input.addEventListener('blur', () => {
            input.parentElement.classList.remove('shadow-sm');
        });
    });

    // Simple moisture input logic simulation
    const moistureInput = document.getElementById('input-moisture');
    moistureInput.addEventListener('input', (e) => {
        const val = parseFloat(e.target.value);
        if (val > 25) {
            moistureInput.classList.add('text-error', 'border-error');
        } else {
            moistureInput.classList.remove('text-error', 'border-error');
        }
    });

    // Function to handle modal closing
    function closeModal() {
        const modal = document.getElementById('modal-container');
        modal.style.display = 'none';
    }
</script>
@endpush