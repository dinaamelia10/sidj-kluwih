{{-- ============================================================
     MODAL: TAMBAH LAPORAN BARU (Responsive)
     ============================================================ --}}

{{-- Overlay Modal --}}
<div id="modalTambahLaporan"
     class="fixed inset-0 z-50 flex items-end sm:items-center justify-center sm:p-md bg-on-surface/30 backdrop-blur-sm
            opacity-0 pointer-events-none transition-all duration-300"
     aria-modal="true" role="dialog">

    {{-- Modal Container --}}
    <div class="w-full sm:max-w-4xl bg-white/95 backdrop-blur-xl rounded-t-2xl sm:rounded-2xl shadow-2xl flex flex-col
                translate-y-full sm:translate-y-0 sm:scale-95 transition-transform duration-300
                max-h-[92vh] sm:max-h-[90vh]"
         id="modalContent">

        {{-- Header --}}
        <div class="px-md sm:px-lg py-md border-b border-outline-variant/30 flex justify-between items-center bg-surface-container-low/50 flex-shrink-0">
            <div class="flex items-center gap-sm">
                <div class="p-xs bg-primary/10 rounded-lg text-primary hidden sm:flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px]">analytics</span>
                </div>
                <div>
                    <h2 class="font-bold text-base sm:text-lg text-on-surface">Tambah Laporan Baru</h2>
                    <p class="text-xs text-on-surface-variant hidden sm:block">Konfigurasi parameter laporan analitik jagung</p>
                </div>
            </div>
            <button id="closeModal" type="button"
                    class="p-xs hover:bg-surface-container rounded-full transition-colors text-on-surface-variant"
                    title="Tutup">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.laporan.store') }}" method="POST" id="formLaporan" class="flex flex-col flex-1 min-h-0">
            @csrf

            {{-- Content Area (Scrollable) --}}
            <div class="flex-1 overflow-y-auto p-md sm:p-lg grid grid-cols-1 md:grid-cols-12 gap-md sm:gap-lg">

                {{-- Left: Form Controls --}}
                <div class="md:col-span-7 space-y-md">

                    {{-- Nama Petani --}}
                    <div class="space-y-xs">
                        <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">
                            Nama Petani <span class="text-error">*</span>
                        </label>
                        <input type="text" name="farmer_name" id="farmer_name" list="petaniDatalist"
                               class="w-full h-11 px-4 rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all text-sm @error('farmer_name') border-error @enderror"
                               placeholder="Pilih atau ketik nama petani..."
                               value="{{ old('farmer_name') }}">
                        <datalist id="petaniDatalist">
                            @if(isset($petaniList))
                                @foreach($petaniList as $p)
                                    <option value="{{ $p->nama }}">{{ $p->nama }} ({{ $p->wilayah ?? 'Kluwih' }})</option>
                                @endforeach
                            @endif
                        </datalist>
                        @error('farmer_name')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-md">
                        {{-- Jenis Laporan --}}
                        <div class="space-y-xs">
                            <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">
                                Jenis <span class="text-error">*</span>
                            </label>
                            <select name="jenis_laporan" id="jenis_laporan"
                                    class="w-full h-11 rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all text-sm">
                                <option value="Harian"   {{ old('jenis_laporan') == 'Harian'   ? 'selected' : '' }}>Harian</option>
                                <option value="Mingguan" {{ old('jenis_laporan') == 'Mingguan' ? 'selected' : '' }}>Mingguan</option>
                                <option value="Bulanan"  {{ old('jenis_laporan') == 'Bulanan'  ? 'selected' : '' }}>Bulanan</option>
                                <option value="Tahunan"  {{ old('jenis_laporan') == 'Tahunan'  ? 'selected' : '' }}>Tahunan</option>
                            </select>
                        </div>
                        {{-- Kategori --}}
                        <div class="space-y-xs">
                            <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">
                                Kategori <span class="text-error">*</span>
                            </label>
                            <select name="kategori" id="kategori"
                                    class="w-full h-11 rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all text-sm">
                                <option value="Tonase Jagung"   {{ old('kategori') == 'Tonase Jagung'   ? 'selected' : '' }}>Tonase Jagung</option>
                                <option value="Monitoring Suhu" {{ old('kategori') == 'Monitoring Suhu' ? 'selected' : '' }}>Monitoring Suhu</option>
                                <option value="Harga Beli"      {{ old('kategori') == 'Harga Beli'      ? 'selected' : '' }}>Harga Beli</option>
                                <option value="Kinerja Petani"  {{ old('kategori') == 'Kinerja Petani'  ? 'selected' : '' }}>Kinerja Petani</option>
                            </select>
                        </div>
                    </div>

                    {{-- Tonase --}}
                    <div class="space-y-xs">
                        <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">
                            Berat (Kg) <span class="text-error">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="tonnage" id="tonnage" min="0" step="1"
                                   class="w-full h-11 pl-4 pr-14 rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all text-sm @error('tonnage') border-error @enderror"
                                   placeholder="Contoh: 150"
                                   value="{{ old('tonnage') }}">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-on-surface-variant">Kg</span>
                        </div>
                        @error('tonnage')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Rentang Tanggal --}}
                    <div class="space-y-xs">
                        <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">
                            Rentang Tanggal <span class="text-error">*</span>
                        </label>
                        <div class="grid grid-cols-2 gap-md">
                            <div class="relative">
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                       class="w-full h-11 pl-9 pr-2 rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all text-sm @error('tanggal_mulai') border-error @enderror"
                                       value="{{ old('tanggal_mulai') }}">
                                <span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 text-outline text-base pointer-events-none">calendar_month</span>
                                @error('tanggal_mulai')
                                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                       class="w-full h-11 pl-9 pr-2 rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all text-sm @error('tanggal_selesai') border-error @enderror"
                                       value="{{ old('tanggal_selesai') }}">
                                <span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 text-outline text-base pointer-events-none">event_repeat</span>
                                @error('tanggal_selesai')
                                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="space-y-xs">
                        <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">
                            Keterangan / Catatan
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="3"
                                  class="w-full rounded-lg border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface transition-all text-sm"
                                  placeholder="Tambahkan konteks atau instruksi khusus...">{{ old('keterangan') }}</textarea>
                    </div>
                </div>

                {{-- Right: Preview Data (dinamis dari DB) — disembunyikan di mobile kecil --}}
                <div class="md:col-span-5 bg-secondary-container/10 rounded-2xl p-md sm:p-lg border border-outline-variant/30 flex flex-col gap-md">
                    <div class="flex items-center gap-xs text-primary">
                        <span class="material-symbols-outlined text-[20px]">insights</span>
                        <h3 class="font-bold text-sm sm:text-base">Preview Data</h3>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-1 gap-md flex-1">
                        {{-- Estimasi Tonase --}}
                        <div class="bg-white p-md rounded-xl border border-outline-variant/50 flex items-center justify-between shadow-sm">
                            <div class="space-y-xs min-w-0">
                                <p class="text-[9px] sm:text-[10px] text-on-surface-variant uppercase tracking-widest font-bold truncate">Berat Selesai</p>
                                <p class="text-lg sm:text-2xl text-primary font-bold">
                                    {{ number_format($previewTonase, 0, ',', '.') }}
                                    <span class="text-xs font-medium text-on-surface-variant">Kg</span>
                                </p>
                            </div>
                            <div class="size-9 sm:size-10 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                                <span class="material-symbols-outlined text-base sm:text-[20px]">monitoring</span>
                            </div>
                        </div>
                        {{-- Fluktuasi Harga --}}
                        <div class="bg-white p-md rounded-xl border border-outline-variant/50 flex items-center justify-between shadow-sm">
                            <div class="space-y-xs min-w-0">
                                <p class="text-[9px] sm:text-[10px] text-on-surface-variant uppercase tracking-widest font-bold truncate">Fluktuasi Harga</p>
                                <p class="text-lg sm:text-2xl font-bold {{ $priceFluktuasi >= 0 ? 'text-primary' : 'text-error' }}">
                                    {{ $priceFluktuasi >= 0 ? '+' : '' }}{{ number_format($priceFluktuasi, 0, ',', '.') }}
                                    <span class="text-xs font-medium text-on-surface-variant">/kg</span>
                                </p>
                            </div>
                            <div class="size-9 sm:size-10 rounded-full {{ $priceFluktuasi >= 0 ? 'bg-primary/10 text-primary' : 'bg-error/10 text-error' }} flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-base sm:text-[20px]">{{ $priceFluktuasi >= 0 ? 'trending_up' : 'trending_down' }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- Progress Pengeringan --}}
                    <div class="pt-sm border-t border-outline-variant/30">
                        <p class="text-xs text-on-surface-variant mb-xs font-medium">Status Pengeringan Bulan Ini</p>
                        <div class="w-full bg-surface-variant rounded-full overflow-hidden h-2">
                            <div class="h-full bg-primary rounded-full transition-all duration-700"
                                 style="width: {{ $progressSelesai }}%"></div>
                        </div>
                        <div class="flex justify-between mt-xs">
                            <span class="text-[10px] text-on-surface-variant">{{ $progressSelesai }}% Selesai</span>
                            <span class="text-[10px] font-bold {{ $progressSelesai >= 80 ? 'text-primary' : ($progressSelesai >= 50 ? 'text-tertiary' : 'text-error') }}">
                                {{ $progressSelesai >= 80 ? 'Optimal' : ($progressSelesai >= 50 ? 'Sedang' : 'Perlu Perhatian') }}
                            </span>
                        </div>
                    </div>
                    <div class="bg-primary/5 p-sm rounded-lg">
                        <p class="text-[10px] text-on-surface-variant italic leading-tight">
                            *Data ringkasan otomatis dari database bulan berjalan.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="px-md sm:px-lg py-md border-t border-outline-variant/20 bg-surface-container-lowest/50 flex justify-end items-center gap-md flex-shrink-0">
                <button type="button" id="cancelModal"
                        class="px-md sm:px-lg h-11 text-sm font-semibold text-primary border border-primary hover:bg-primary/5 transition-all active:scale-95 rounded-xl">
                    Batal
                </button>
                <button type="submit"
                        class="px-md sm:px-lg h-11 rounded-xl font-bold text-sm text-on-primary bg-primary hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 active:scale-95 flex items-center gap-sm">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    <span class="hidden xs:inline sm:inline">Buat Laporan</span>
                    <span class="xs:hidden sm:hidden">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
(function () {
    const modal        = document.getElementById('modalTambahLaporan');
    const modalContent = document.getElementById('modalContent');
    const btnOpen      = document.getElementById('btnTambahLaporan');
    const btnFab       = document.getElementById('btnTambahLaporanFab');
    const btnClose     = document.getElementById('closeModal');
    const btnCancel    = document.getElementById('cancelModal');

    function openModal() {
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        // mobile: slide up; desktop: scale in
        if (window.innerWidth < 640) {
            modalContent.classList.remove('translate-y-full');
            modalContent.classList.add('translate-y-0');
        } else {
            modalContent.classList.remove('sm:scale-95');
            modalContent.classList.add('sm:scale-100');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100');
        if (window.innerWidth < 640) {
            modalContent.classList.add('translate-y-full');
            modalContent.classList.remove('translate-y-0');
        } else {
            modalContent.classList.add('sm:scale-95');
            modalContent.classList.remove('sm:scale-100');
        }
        document.body.style.overflow = '';
    }

    if (btnOpen)   btnOpen.addEventListener('click', openModal);
    if (btnFab)    btnFab.addEventListener('click', openModal);
    if (btnClose)  btnClose.addEventListener('click', closeModal);
    if (btnCancel) btnCancel.addEventListener('click', closeModal);

    // Klik overlay untuk tutup
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });

    // ESC untuk tutup
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });

    // Auto-buka modal jika ada error validasi
    @if($errors->any())
        openModal();
    @endif

    // Warna ikon date input saat focus
    document.querySelectorAll('#formLaporan input[type="date"]').forEach(input => {
        const icon = input.parentElement.querySelector('.material-symbols-outlined');
        input.addEventListener('focus', () => { if (icon) icon.style.color = '#0d631b'; });
        input.addEventListener('blur',  () => { if (icon) icon.style.color = '#707a6c'; });
    });
})();
</script>
@endpush
