@extends('admin.layout.master')

@section('content')
<!-- Background Dashboard Layer -->
<div class="flex">
    <div class="flex-1 p-lg">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg mb-lg">
            <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm h-32"></div>
            <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm h-32"></div>
            <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm h-32"></div>
        </div>
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
                    <h3 class="font-headline-md text-headline-md font-bold text-on-surface">Tambah Data Berat Jagung</h3>
                    <p class="text-on-surface-variant font-label-md">Catat setoran jagung baru ke sistem manajemen kluwih.</p>
                </div>
            </div>
            <a href="{{ route('admin.tonase-jagung') }}" class="p-base hover:bg-surface-container-high rounded-full transition-colors">
                <span class="material-symbols-outlined">close</span>
            </a>
        </div>

        <!-- Modal Content (Form) -->
        <div class="p-lg space-y-lg overflow-y-auto max-h-[70vh]">
            @if ($errors->any())
            <div class="bg-error-container text-on-error-container rounded-xl p-md text-sm">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form
                action="{{ route('admin.tonase.store') }}"
                method="POST"
                class="grid grid-cols-1 md:grid-cols-2 gap-x-lg gap-y-md"
            >
                @csrf

                <!-- Farmer Name -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block font-label-md text-on-surface-variant mb-sm">
                        Nama Petani <span class="text-error">*</span>
                    </label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">person_search</span>
                        @if($petaniList->count() > 0)
                        <select name="farmer_name"
                                class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary appearance-none @error('farmer_name') border-error @enderror">
                            <option value="" disabled {{ old('farmer_name') ? '' : 'selected' }}>Pilih nama petani...</option>
                            @foreach($petaniList as $petani)
                                <option value="{{ $petani->nama }}" {{ old('farmer_name') == $petani->nama ? 'selected' : '' }}>
                                    {{ $petani->nama }} — {{ $petani->wilayah ?? 'Kluwih' }}
                                </option>
                            @endforeach
                        </select>
                        @else
                        <input type="text" name="farmer_name"
                               class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary @error('farmer_name') border-error @enderror"
                               placeholder="Masukkan nama petani..."
                               value="{{ old('farmer_name') }}">
                        @endif
                        <span class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                    </div>
                    @error('farmer_name')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deposit Date -->
                <div class="col-span-1">
                    <label class="block font-label-md text-on-surface-variant mb-sm">
                        Tanggal Setoran <span class="text-error">*</span>
                    </label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">calendar_today</span>
                        <input class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary @error('tanggal_mulai') border-error @enderror"
                               type="date"
                               name="tanggal_mulai"
                               value="{{ old('tanggal_mulai', date('Y-m-d')) }}">
                    </div>
                    @error('tanggal_mulai')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gross Weight -->
                <div class="col-span-1">
                    <label class="block font-label-md text-on-surface-variant mb-sm">
                        Berat Bersih (Kg) <span class="text-error">*</span>
                    </label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">scale</span>
                        <input class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary @error('tonnage') border-error @enderror"
                               name="tonnage"
                               id="input-tonnage"
                               placeholder="0.00"
                               step="0.01"
                               min="0"
                               type="number"
                               value="{{ old('tonnage') }}">
                    </div>
                    @error('tonnage')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Moisture Content (informational only, not saved separately) -->
                <div class="col-span-1">
                    <label class="block font-label-md text-on-surface-variant mb-sm">Kadar Air (%)</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">humidity_mid</span>
                        <input class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary"
                               id="input-moisture"
                               step="0.1"
                               type="number"
                               placeholder="14.0"
                               value="{{ old('moisture', '14.0') }}">
                    </div>
                    <p class="text-xs text-on-surface-variant mt-1">Catatan informasi saja — tidak disimpan sebagai kolom terpisah.</p>
                </div>

                <!-- Keterangan -->
                <div class="col-span-1">
                    <label class="block font-label-md text-on-surface-variant mb-sm">Keterangan</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-md top-3 text-outline">notes</span>
                        <textarea name="keterangan"
                                  class="w-full pl-xl pr-md py-md bg-surface-container-low border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary resize-none"
                                  rows="2"
                                  placeholder="Catatan tambahan...">{{ old('keterangan') }}</textarea>
                    </div>
                </div>

                {{-- Pricing Insight Section --}}
                <div class="col-span-1 md:col-span-2 bg-surface-container-high rounded-xl p-lg border-l-4 border-primary flex flex-col md:flex-row justify-between items-start md:items-center gap-md">
                    <div class="space-y-xs">
                        <div class="flex items-center gap-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">calculate</span>
                            <span class="font-label-sm uppercase tracking-wider">Kalkulasi Estimasi Nilai</span>
                        </div>
                        <div class="flex items-baseline gap-md">
                            <h4 class="text-title-lg font-bold text-primary" id="estimasiHarga">Rp 0<span class="text-sm font-normal text-on-surface-variant">/kg</span></h4>
                        </div>
                        <p class="text-xs text-outline italic leading-tight">Estimasi nilai total berdasarkan berat & harga pasar terkini.</p>
                    </div>
                    <div class="text-right w-full md:w-auto">
                        <div class="text-label-sm text-outline">Estimasi Nilai Total</div>
                        <div class="text-headline-md font-bold text-primary" id="estimasiTotal">Rp --</div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="col-span-1 md:col-span-2 flex flex-col md:flex-row gap-md justify-end">
                    <a href="{{ route('admin.tonase-jagung') }}"
                       class="px-lg py-md rounded-lg font-bold text-on-surface-variant hover:bg-surface-container-high transition-colors text-center">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-xl py-md rounded-lg font-bold bg-primary text-on-primary hover:bg-primary-container active:scale-95 transition-all shadow-md shadow-primary/20 flex items-center justify-center gap-md">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        Simpan Data Jagung
                    </button>
                </div>

            </form>
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
    // Harga pasar terkini dari server
    const marketPricePerKg = {{ \App\Models\MarketPrice::latest()->first()?->price ?? 0 }};

    const tonnageInput = document.getElementById('input-tonnage');
    const moistureInput = document.getElementById('input-moisture');
    const estimasiHarga = document.getElementById('estimasiHarga');
    const estimasiTotal = document.getElementById('estimasiTotal');

    function updateEstimasi() {
        const ton = parseFloat(tonnageInput?.value || 0);
        const moisture = parseFloat(moistureInput?.value || 14);

        // Harga disesuaikan kadar air: jika KA > 14%, ada potongan 1% per 1% KA di atas standar
        let adjustedPrice = marketPricePerKg;
        if (moisture > 14) {
            adjustedPrice = marketPricePerKg * (1 - ((moisture - 14) * 0.01));
        }

        const totalNilai = ton * adjustedPrice; // berat dalam kg

        if (estimasiHarga) {
            estimasiHarga.innerHTML = 'Rp ' + adjustedPrice.toLocaleString('id-ID', {maximumFractionDigits: 0})
                + '<span class="text-sm font-normal text-on-surface-variant">/kg</span>';
        }
        if (estimasiTotal) {
            estimasiTotal.textContent = ton > 0
                ? 'Rp ' + totalNilai.toLocaleString('id-ID', {maximumFractionDigits: 0})
                : 'Rp --';
        }
    }

    tonnageInput?.addEventListener('input', updateEstimasi);
    moistureInput?.addEventListener('input', () => {
        const val = parseFloat(moistureInput.value);
        if (val > 25) {
            moistureInput.classList.add('text-error', 'border-error');
        } else {
            moistureInput.classList.remove('text-error', 'border-error');
        }
        updateEstimasi();
    });

    updateEstimasi();

    // Micro-interactions for form inputs
    document.querySelectorAll('input, select, textarea').forEach(input => {
        input.addEventListener('focus', () => input.parentElement.classList.add('shadow-sm'));
        input.addEventListener('blur', () => input.parentElement.classList.remove('shadow-sm'));
    });
</script>
@endpush