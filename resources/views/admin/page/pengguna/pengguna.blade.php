@extends('admin.layout.master')

@section('content')

<div class="space-y-lg">
    <!-- Page Header -->
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                <a class="hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-bold">Data Petani</span>
            </nav>
            <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Data Mitra Petani</h1>
            <p class="text-on-surface-variant font-body-md text-body-md mt-2">Kelola basis data mitra petani di wilayah Kluwih secara real-time.</p>
        </div>
        {{-- Tombol desktop saja (mobile pakai FAB) --}}
        <button type="button" id="btnTambahPengguna" class="inline-flex items-center gap-sm rounded-2xl bg-primary-container px-lg py-3 text-on-primary-container font-bold transition hover:bg-primary active:scale-95 shadow-md flex-shrink-0">
            <span class="material-symbols-outlined">person_add</span>
            Tambah Petani Baru
        </button>
    </div>

{{-- ========== SUMMARY CARDS ========== --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-lg">
    {{-- Card 1: Total Petani --}}
    <div class="bento-card p-lg rounded-xxl relative overflow-hidden group bg-white shadow-sm border border-outline-variant/20 hover:shadow-md transition-shadow">
        <div class="flex flex-col pr-12">
            <span class="font-label-md text-label-md text-on-surface-variant mb-1">Total Petani Terdaftar</span>
            <span class="font-display text-display text-primary font-bold">{{ number_format($totalPetani, 0, ',', '.') }}</span>
            <div class="mt-4 flex items-center gap-1 w-fit px-2 py-1 rounded-full
                {{ $penggunaGrowth >= 0 ? 'text-on-secondary-container bg-secondary-container/30' : 'text-error bg-error/10' }}">
                <span class="material-symbols-outlined text-[16px]">{{ $penggunaGrowth >= 0 ? 'trending_up' : 'trending_down' }}</span>
                <span class="font-label-sm text-label-sm">{{ $penggunaGrowth >= 0 ? '+' : '' }}{{ $penggunaGrowth }}% dari bulan lalu</span>
            </div>
        </div>
        <div class="absolute top-lg right-lg w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-primary">
            <span class="material-symbols-outlined">groups</span>
        </div>
    </div>

    {{-- Card 2: Petani Baru Bulan Ini --}}
    <div class="bento-card p-lg rounded-xxl relative overflow-hidden group bg-white shadow-sm border border-outline-variant/20 hover:shadow-md transition-shadow">
        <div class="flex flex-col pr-12">
            <span class="font-label-md text-label-md text-on-surface-variant mb-1">Bergabung Bulan Ini</span>
            <span class="font-display text-display text-tertiary font-bold">{{ number_format($petaniBulanIni, 0, ',', '.') }}</span>
            <div class="mt-4 flex items-center gap-1 text-on-surface-variant bg-surface-container px-2 py-1 rounded-full w-fit">
                <span class="material-symbols-outlined text-[16px]">sync</span>
                <span class="font-label-sm text-label-sm">{{ $aktivitasPercent }}% dari total</span>
            </div>
        </div>
        <div class="absolute top-lg right-lg w-10 h-10 rounded-full bg-tertiary-fixed-dim flex items-center justify-center text-tertiary">
            <span class="material-symbols-outlined">monitoring</span>
        </div>
    </div>

    {{-- Card 3: Petani Terbaru --}}
    <div class="bento-card p-lg rounded-xxl relative overflow-hidden group bg-white shadow-sm border border-outline-variant/20 hover:shadow-md transition-shadow sm:col-span-2 md:col-span-1">
        <div class="flex flex-col pr-12">
            <span class="font-label-md text-label-md text-on-surface-variant mb-1">Petani Terbaru</span>
            @if($petaniTerbaru)
                <span class="font-headline-md text-headline-md text-on-surface mt-1 font-bold truncate">{{ $petaniTerbaru->nama }}</span>
                <span class="font-body-md text-body-md text-on-surface-variant">{{ $petaniTerbaru->wilayah ?? 'Wilayah belum diisi' }}</span>
            @else
                <span class="font-headline-md text-headline-md text-on-surface-variant mt-1">Belum ada petani</span>
                <span class="font-body-md text-body-md text-on-surface-variant">Tambahkan petani pertama</span>
            @endif
        </div>
        <div class="absolute top-lg right-lg w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary">
            <span class="material-symbols-outlined">person</span>
        </div>
        <div class="mt-4 h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
            <div class="h-full bg-primary-container rounded-full transition-all duration-700"
                 style="width: {{ min(100, $aktivitasPercent) }}%"></div>
        </div>
    </div>
</div>

{{-- ========== TABEL / CARD LIST ========== --}}
<div class="bento-card rounded-xxl overflow-hidden bg-white shadow-sm border border-outline-variant/20">

    {{-- Filter Header --}}
    <div class="p-lg border-b border-outline-variant/20 flex flex-col sm:flex-row justify-between gap-md items-start sm:items-center">
        <h3 class="font-title-lg text-title-lg text-on-surface whitespace-nowrap">Database Petani</h3>
        <form method="GET" action="{{ route('admin.pengguna') }}" class="flex items-center gap-md w-full sm:w-auto">
            <div class="relative flex-1 sm:w-64">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg pointer-events-none">search</span>
                <input type="text" name="search" value="{{ $search ?? '' }}"
                       placeholder="Cari nama, wilayah, komoditas..."
                       class="w-full pl-10 pr-4 py-2 bg-surface-container-low border border-outline-variant/30 rounded-xl text-sm focus:ring-primary focus:border-primary transition-all">
            </div>
            <button type="submit" class="p-2 border border-outline-variant/30 rounded-xl hover:bg-surface-container-low transition-colors flex-shrink-0" title="Cari">
                <span class="material-symbols-outlined text-on-surface-variant">filter_list</span>
            </button>
            @if($search)
                <a href="{{ route('admin.pengguna') }}" class="p-2 border border-outline-variant/30 rounded-xl hover:bg-surface-container-low transition-colors flex-shrink-0 text-on-surface-variant" title="Reset">
                    <span class="material-symbols-outlined">refresh</span>
                </a>
            @endif
        </form>
    </div>

    {{-- DESKTOP TABLE --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-surface-container-low/50">
                <tr>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest border-b border-outline-variant/20">ID</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest border-b border-outline-variant/20">Nama Petani</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest border-b border-outline-variant/20">Wilayah</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest border-b border-outline-variant/20">Lahan (Ha)</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest border-b border-outline-variant/20">Komoditas</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest border-b border-outline-variant/20">Status</th>
                    <th class="px-lg py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest border-b border-outline-variant/20 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/10">
                @forelse($pengguna as $petani)
                <tr class="hover:bg-surface-container-low/30 transition-colors">
                    <td class="px-lg py-4 text-sm text-on-surface-variant font-mono font-medium">
                        PKL-{{ str_pad($petani->id, 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="px-lg py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-secondary-container flex items-center justify-center font-bold text-primary text-sm flex-shrink-0">
                                {{ strtoupper(substr($petani->nama, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-on-surface text-sm">{{ $petani->nama }}</p>
                                @if($petani->no_telp)
                                    <p class="text-xs text-on-surface-variant">{{ $petani->no_telp }}</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-lg py-4 text-sm text-on-surface-variant">{{ $petani->wilayah ?? '-' }}</td>
                    <td class="px-lg py-4 text-sm text-on-surface font-medium">{{ $petani->luas_lahan ? number_format($petani->luas_lahan, 1) . ' Ha' : '-' }}</td>
                    <td class="px-lg py-4">
                        <span class="bg-primary-fixed text-on-primary-fixed-variant px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap">
                            {{ $petani->komoditas }}
                        </span>
                    </td>
                    <td class="px-lg py-4">
                        @if($petani->status === 'Aktif')
                            <div class="flex items-center gap-1.5">
                                <div class="w-1.5 h-1.5 rounded-full bg-primary"></div>
                                <span class="text-xs font-bold text-primary">Aktif</span>
                            </div>
                        @else
                            <div class="flex items-center gap-1.5">
                                <div class="w-1.5 h-1.5 rounded-full bg-on-surface-variant"></div>
                                <span class="text-xs font-bold text-on-surface-variant">{{ $petani->status }}</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-lg py-4 text-center">
                        <div class="flex items-center justify-center gap-1">
                            <button type="button"
                                    onclick="showDetailPetaniModal({{ $petani->id }}, '{{ addslashes($petani->nama) }}', '{{ addslashes($petani->no_telp ?? '-') }}', '{{ addslashes($petani->wilayah ?? '-') }}', '{{ $petani->luas_lahan ?? 0 }}', '{{ addslashes($petani->komoditas) }}', '{{ $petani->status }}', '{{ addslashes($petani->alamat ?? '-') }}', '{{ $petani->created_at->format('d M Y') }}')"
                                    class="p-2 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Detail">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                            <button type="button"
                                    onclick="openEditPetaniModal({{ $petani->id }}, '{{ addslashes($petani->nama) }}', '{{ addslashes($petani->no_telp ?? '') }}', '{{ addslashes($petani->wilayah ?? '') }}', '{{ $petani->luas_lahan ?? '' }}', '{{ addslashes($petani->komoditas) }}', '{{ $petani->status }}', '{{ addslashes($petani->alamat ?? '') }}')"
                                    class="p-2 text-on-surface-variant hover:text-tertiary hover:bg-tertiary/10 rounded-lg transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </button>
                            <form method="POST" action="{{ route('admin.pengguna.destroy', $petani) }}"
                                  onsubmit="return confirmSubmit(event, 'Hapus Data Petani', 'Apakah Anda yakin ingin menghapus data petani {{ addslashes($petani->nama) }}? Data yang dihapus tidak dapat dipulihkan.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-on-surface-variant hover:text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-lg py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-on-surface-variant">
                            <span class="material-symbols-outlined text-5xl opacity-30">person_off</span>
                            <p class="font-medium">{{ $search ? 'Tidak ada petani dengan kata kunci "' . $search . '"' : 'Belum ada data petani. Tambahkan petani baru.' }}</p>
                            @if(!$search)
                                <button onclick="document.getElementById('btnTambahPengguna').click()"
                                        class="mt-2 px-lg py-2 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 transition-all active:scale-95">
                                    Tambah Petani Pertama
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- MOBILE CARD LIST --}}
    <div class="md:hidden divide-y divide-outline-variant/10">
        @forelse($pengguna as $petani)
        <div class="p-md flex flex-col gap-3 hover:bg-surface-container-low/30 transition-colors">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-full bg-secondary-container flex items-center justify-center font-bold text-primary text-base flex-shrink-0">
                    {{ strtoupper(substr($petani->nama, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-on-surface text-sm truncate">{{ $petani->nama }}</p>
                    <p class="text-xs text-on-surface-variant">{{ $petani->wilayah ?? 'Wilayah belum diisi' }}</p>
                </div>
                @if($petani->status === 'Aktif')
                    <div class="flex items-center gap-1 bg-primary/10 px-2 py-1 rounded-full flex-shrink-0">
                        <div class="w-1.5 h-1.5 rounded-full bg-primary"></div>
                        <span class="text-[10px] font-bold text-primary">Aktif</span>
                    </div>
                @else
                    <div class="flex items-center gap-1 bg-surface-container px-2 py-1 rounded-full flex-shrink-0">
                        <div class="w-1.5 h-1.5 rounded-full bg-on-surface-variant"></div>
                        <span class="text-[10px] font-bold text-on-surface-variant">{{ $petani->status }}</span>
                    </div>
                @endif
            </div>
            <div class="flex items-center gap-md text-xs text-on-surface-variant">
                <span class="bg-primary-fixed text-on-primary-fixed-variant px-2 py-0.5 rounded-full font-semibold">{{ $petani->komoditas }}</span>
                <span>{{ $petani->luas_lahan ? number_format($petani->luas_lahan, 1) . ' Ha' : 'Lahan belum diisi' }}</span>
                <span class="text-[10px] ml-auto font-mono">PKL-{{ str_pad($petani->id, 3, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex items-center justify-end gap-1 pt-1 border-t border-outline-variant/10">
                <button type="button"
                        onclick="showDetailPetaniModal({{ $petani->id }}, '{{ addslashes($petani->nama) }}', '{{ addslashes($petani->no_telp ?? '-') }}', '{{ addslashes($petani->wilayah ?? '-') }}', '{{ $petani->luas_lahan ?? 0 }}', '{{ addslashes($petani->komoditas) }}', '{{ $petani->status }}', '{{ addslashes($petani->alamat ?? '-') }}', '{{ $petani->created_at->format('d M Y') }}')"
                        class="p-2 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors active:scale-90" title="Detail">
                    <span class="material-symbols-outlined text-base">visibility</span>
                </button>
                <button type="button"
                        onclick="openEditPetaniModal({{ $petani->id }}, '{{ addslashes($petani->nama) }}', '{{ addslashes($petani->no_telp ?? '') }}', '{{ addslashes($petani->wilayah ?? '') }}', '{{ $petani->luas_lahan ?? '' }}', '{{ addslashes($petani->komoditas) }}', '{{ $petani->status }}', '{{ addslashes($petani->alamat ?? '') }}')"
                        class="p-2 text-on-surface-variant hover:text-tertiary hover:bg-tertiary/10 rounded-lg transition-colors active:scale-90" title="Edit">
                    <span class="material-symbols-outlined text-base">edit</span>
                </button>
                <form method="POST" action="{{ route('admin.pengguna.destroy', $petani) }}"
                      onsubmit="return confirmSubmit(event, 'Hapus Data Petani', 'Apakah Anda yakin ingin menghapus data petani {{ addslashes($petani->nama) }}? Data yang dihapus tidak dapat dipulihkan.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-2 text-on-surface-variant hover:text-error hover:bg-error/10 rounded-lg transition-colors active:scale-90" title="Hapus">
                        <span class="material-symbols-outlined text-base">delete</span>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-lg text-center">
            <div class="flex flex-col items-center gap-3 text-on-surface-variant">
                <span class="material-symbols-outlined text-5xl opacity-30">person_off</span>
                <p class="font-medium text-sm">{{ $search ? 'Tidak ada hasil untuk "' . $search . '"' : 'Belum ada data petani.' }}</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="p-lg flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-outline-variant/20 bg-surface-container-low/30">
        <span class="text-sm text-on-surface-variant font-medium text-center sm:text-left">
            Menampilkan {{ $pengguna->firstItem() ?? 0 }}-{{ $pengguna->lastItem() ?? 0 }} dari {{ number_format($pengguna->total(), 0, ',', '.') }} petani
        </span>
        <div class="flex items-center gap-2 flex-wrap justify-center">
            @if($pengguna->onFirstPage())
                <button class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg opacity-50" disabled>
                    <span class="material-symbols-outlined text-base">chevron_left</span>
                </button>
            @else
                <a href="{{ $pengguna->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors">
                    <span class="material-symbols-outlined text-base">chevron_left</span>
                </a>
            @endif

            @foreach($pengguna->getUrlRange(max(1, $pengguna->currentPage()-1), min($pengguna->lastPage(), $pengguna->currentPage()+1)) as $page => $url)
                @if($page == $pengguna->currentPage())
                    <button class="w-9 h-9 flex items-center justify-center bg-primary text-white rounded-lg font-bold text-sm">{{ $page }}</button>
                @else
                    <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors font-bold text-sm">{{ $page }}</a>
                @endif
            @endforeach

            @if($pengguna->lastPage() > $pengguna->currentPage() + 1)
                <span class="text-on-surface-variant">...</span>
                <a href="{{ $pengguna->url($pengguna->lastPage()) }}" class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors font-bold text-sm">{{ $pengguna->lastPage() }}</a>
            @endif

            @if($pengguna->hasMorePages())
                <a href="{{ $pengguna->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg hover:bg-white transition-colors">
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                </a>
            @else
                <button class="w-9 h-9 flex items-center justify-center border border-outline-variant/30 rounded-lg opacity-50" disabled>
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                </button>
            @endif
        </div>
    </div>
</div>

{{-- ========== FAB MOBILE ========== --}}


{{-- ========== MODAL TAMBAH PETANI ========== --}}
<div id="modalTambahPengguna"
     class="fixed inset-0 z-50 flex items-end sm:items-center justify-center sm:p-md bg-on-surface/30 backdrop-blur-sm
            opacity-0 pointer-events-none transition-all duration-300">

    <div id="modalPenggunaContent"
         class="w-full sm:max-w-2xl bg-white rounded-t-2xl sm:rounded-2xl shadow-2xl flex flex-col
                translate-y-full sm:translate-y-0 sm:scale-95 transition-transform duration-300 max-h-[92vh]">

        {{-- Header --}}
        <div class="px-lg py-md border-b border-outline-variant/20 flex justify-between items-center flex-shrink-0">
            <div class="flex items-center gap-sm">
                <div class="p-xs bg-primary/10 rounded-lg text-primary">
                    <span class="material-symbols-outlined" id="modalPenggunaIcon">person_add</span>
                </div>
                <div>
                    <h3 class="font-bold text-base text-on-surface" id="modalPenggunaTitle">Tambah Petani Baru</h3>
                    <p class="text-xs text-on-surface-variant" id="modalPenggunaSub">Isi data identitas petani mitra</p>
                </div>
            </div>
            <button id="closeModalPengguna" type="button"
                    class="p-xs hover:bg-surface-container rounded-full transition-colors text-on-surface-variant">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('admin.pengguna.store') }}" id="formPengguna" class="flex flex-col flex-1 min-h-0">
            @csrf
            <div id="methodContainerPengguna"></div>

            <div class="flex-1 overflow-y-auto p-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-md">

                    {{-- Nama --}}
                    <div class="sm:col-span-2 space-y-xs">
                        <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">Nama Lengkap <span class="text-error">*</span></label>
                        <input type="text" name="nama" id="input_nama" value="{{ old('nama') }}" required
                               placeholder="Contoh: Sugeng Raharjo"
                               class="w-full h-11 px-4 rounded-xl border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-sm transition-all @error('nama') border-error @enderror">
                        @error('nama') <p class="text-error text-xs">{{ $message }}</p> @enderror
                    </div>

                    {{-- No. Telp --}}
                    <div class="space-y-xs">
                        <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">No. Telepon</label>
                        <input type="text" name="no_telp" id="input_no_telp" value="{{ old('no_telp') }}"
                               placeholder="Contoh: 0812-xxxx-xxxx"
                               class="w-full h-11 px-4 rounded-xl border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-sm transition-all">
                    </div>

                    {{-- Wilayah --}}
                    <div class="space-y-xs">
                        <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">Wilayah</label>
                        <select name="wilayah" id="input_wilayah" class="w-full h-11 rounded-xl border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-sm transition-all">
                            <option value="">-- Pilih Wilayah --</option>
                            <option value="Kluwih Utara"   {{ old('wilayah') == 'Kluwih Utara'   ? 'selected' : '' }}>Kluwih Utara</option>
                            <option value="Kluwih Selatan" {{ old('wilayah') == 'Kluwih Selatan' ? 'selected' : '' }}>Kluwih Selatan</option>
                            <option value="Kluwih Barat"   {{ old('wilayah') == 'Kluwih Barat'   ? 'selected' : '' }}>Kluwih Barat</option>
                            <option value="Kluwih Timur"   {{ old('wilayah') == 'Kluwih Timur'   ? 'selected' : '' }}>Kluwih Timur</option>
                        </select>
                    </div>

                    {{-- Luas Lahan --}}
                    <div class="space-y-xs">
                        <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">Luas Lahan (Ha)</label>
                        <div class="relative">
                            <input type="number" name="luas_lahan" id="input_luas_lahan" value="{{ old('luas_lahan') }}" min="0" step="0.1"
                                   placeholder="Contoh: 2.5"
                                   class="w-full h-11 pl-4 pr-12 rounded-xl border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-sm transition-all">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-on-surface-variant font-bold">Ha</span>
                        </div>
                    </div>

                    {{-- Komoditas --}}
                    <div class="space-y-xs">
                        <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">Komoditas <span class="text-error">*</span></label>
                        <select name="komoditas" id="input_komoditas" class="w-full h-11 rounded-xl border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-sm transition-all">
                            <option value="Jagung Hibrida" {{ old('komoditas', 'Jagung Hibrida') == 'Jagung Hibrida' ? 'selected' : '' }}>Jagung Hibrida</option>
                            <option value="Jagung Manis"   {{ old('komoditas') == 'Jagung Manis'   ? 'selected' : '' }}>Jagung Manis</option>
                            <option value="Kedelai"        {{ old('komoditas') == 'Kedelai'        ? 'selected' : '' }}>Kedelai</option>
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="space-y-xs">
                        <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">Status <span class="text-error">*</span></label>
                        <select name="status" id="input_status" class="w-full h-11 rounded-xl border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-sm transition-all">
                            <option value="Aktif"       {{ old('status', 'Aktif') == 'Aktif'       ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    {{-- Alamat --}}
                    <div class="sm:col-span-2 space-y-xs">
                        <label class="block text-[10px] font-bold text-primary uppercase tracking-wider">Alamat</label>
                        <textarea name="alamat" id="input_alamat" rows="2"
                                  placeholder="Alamat lengkap petani..."
                                  class="w-full rounded-xl border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary bg-surface text-sm transition-all px-4 py-3">{{ old('alamat') }}</textarea>
                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <div class="px-lg py-md border-t border-outline-variant/20 bg-surface-container-lowest/50 flex justify-end gap-md flex-shrink-0">
                <button type="button" id="cancelModalPengguna"
                        class="px-lg h-11 text-sm font-semibold text-primary border border-primary hover:bg-primary/5 transition-all active:scale-95 rounded-xl">
                    Batal
                </button>
                <button type="submit" id="btnSubmitPengguna"
                        class="px-lg h-11 rounded-xl font-bold text-sm text-on-primary bg-primary hover:bg-primary/90 transition-all shadow-lg active:scale-95 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    <span id="btnSubmitPenggunaText">Simpan Petani</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL DETAIL PETANI ========== --}}
<div id="modalDetailPetani"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-on-surface/40 backdrop-blur-sm
            opacity-0 pointer-events-none transition-all duration-300"
     onclick="if(event.target===this)closeDetailPetaniModal()">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 scale-95" id="detailPetaniModalContent">
        <div class="bg-primary px-lg py-md flex justify-between items-center text-white">
            <div class="flex items-center gap-sm">
                <span class="material-symbols-outlined">person</span>
                <h3 class="font-bold">Detail Petani Mitra</h3>
            </div>
            <button onclick="closeDetailPetaniModal()" class="p-1 hover:bg-white/20 rounded-full transition-colors text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-lg space-y-4">
            <div class="flex items-center gap-4 border-b border-outline-variant/20 pb-4">
                <div class="w-14 h-14 rounded-full bg-secondary-container flex items-center justify-center font-bold text-2xl text-primary flex-shrink-0" id="dpAvatar">
                    -
                </div>
                <div>
                    <h4 class="font-bold text-lg text-on-surface" id="dpNama">-</h4>
                    <p class="text-xs text-on-surface-variant font-mono" id="dpId">PKL-000</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">No. Telepon</p>
                    <p class="font-semibold text-on-surface" id="dpTelp">-</p>
                </div>
                <div>
                    <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Wilayah</p>
                    <p class="font-semibold text-on-surface" id="dpWilayah">-</p>
                </div>
                <div>
                    <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Luas Lahan</p>
                    <p class="font-semibold text-on-surface" id="dpLahan">-</p>
                </div>
                <div>
                    <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Komoditas</p>
                    <p class="font-semibold text-primary" id="dpKomoditas">-</p>
                </div>
                <div>
                    <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Status</p>
                    <p id="dpStatus">-</p>
                </div>
                <div>
                    <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Terdaftar Pada</p>
                    <p class="font-semibold text-on-surface" id="dpTgl">-</p>
                </div>
            </div>
            <div class="border-t border-outline-variant/20 pt-3">
                <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Alamat Lengkap</p>
                <p class="text-sm text-on-surface mt-1" id="dpAlamat">-</p>
            </div>
        </div>
        <div class="px-lg py-md bg-surface-container-low border-t border-outline-variant/20 flex justify-end">
            <button onclick="closeDetailPetaniModal()" class="px-4 py-2 bg-primary text-white rounded-xl font-semibold text-sm hover:bg-primary/90 transition-all">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- ========== FLASH MESSAGES ========== --}}
@if(session('success'))
<div id="toastPengguna" class="fixed bottom-6 right-6 z-[200] transition-all duration-500 opacity-0 translate-y-4">
    <div class="bg-on-background text-white px-lg py-sm rounded-xl shadow-2xl flex items-center gap-md">
        <span class="material-symbols-outlined text-secondary-fixed-dim" style="font-variation-settings:'FILL' 1;">check_circle</span>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
</div>
@endif
@if(session('error'))
<div id="toastPenggunaErr" class="fixed bottom-6 right-6 z-[200] transition-all duration-500 opacity-0 translate-y-4">
    <div class="bg-error text-white px-lg py-sm rounded-xl shadow-2xl flex items-center gap-md">
        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">error</span>
        <span class="text-sm font-medium">{{ session('error') }}</span>
    </div>
</div>
@endif

</div>
@endsection

@push('scripts')
<script>
    const modal   = document.getElementById('modalTambahPengguna');
    const content = document.getElementById('modalPenggunaContent');
    const btnOpen  = document.getElementById('btnTambahPengguna');
    const btnFab   = document.getElementById('btnTambahPenggunaFab');
    const btnClose  = document.getElementById('closeModalPengguna');
    const btnCancel = document.getElementById('cancelModalPengguna');

    const formPengguna = document.getElementById('formPengguna');
    const methodContainer = document.getElementById('methodContainerPengguna');
    const modalTitle = document.getElementById('modalPenggunaTitle');
    const modalSub = document.getElementById('modalPenggunaSub');
    const modalIcon = document.getElementById('modalPenggunaIcon');
    const btnSubmitText = document.getElementById('btnSubmitPenggunaText');

    const storeUrl = "{{ route('admin.pengguna.store') }}";
    const updateUrlBase = "{{ url('/admin/pengguna') }}";

    function openAddModal() {
        formPengguna.action = storeUrl;
        methodContainer.innerHTML = '';
        modalTitle.textContent = 'Tambah Petani Baru';
        modalSub.textContent = 'Isi data identitas petani mitra';
        if (modalIcon) modalIcon.textContent = 'person_add';
        btnSubmitText.textContent = 'Simpan Petani';

        formPengguna.reset();
        document.getElementById('input_status').value = 'Aktif';
        document.getElementById('input_komoditas').value = 'Jagung Hibrida';

        openModal();
    }

    function openEditPetaniModal(id, nama, no_telp, wilayah, luas_lahan, komoditas, status, alamat) {
        formPengguna.action = updateUrlBase + '/' + id;
        methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        modalTitle.textContent = 'Edit Data Petani';
        modalSub.textContent = 'Ubah data rincian petani mitra ' + nama;
        if (modalIcon) modalIcon.textContent = 'edit';
        btnSubmitText.textContent = 'Simpan Perubahan';

        document.getElementById('input_nama').value = nama;
        document.getElementById('input_no_telp').value = no_telp || '';
        document.getElementById('input_wilayah').value = wilayah || '';
        document.getElementById('input_luas_lahan').value = luas_lahan || '';
        document.getElementById('input_komoditas').value = komoditas || 'Jagung Hibrida';
        document.getElementById('input_status').value = status || 'Aktif';
        document.getElementById('input_alamat').value = alamat || '';

        openModal();
    }

    function showDetailPetaniModal(id, nama, no_telp, wilayah, luas_lahan, komoditas, status, alamat, created_at) {
        document.getElementById('dpAvatar').textContent = (nama || 'A').charAt(0).toUpperCase();
        document.getElementById('dpNama').textContent = nama;
        document.getElementById('dpId').textContent = 'PKL-' + String(id).padStart(3, '0');
        document.getElementById('dpTelp').textContent = no_telp || '-';
        document.getElementById('dpWilayah').textContent = wilayah || '-';
        document.getElementById('dpLahan').textContent = luas_lahan ? parseFloat(luas_lahan).toFixed(1) + ' Ha' : '-';
        document.getElementById('dpKomoditas').textContent = komoditas || '-';
        document.getElementById('dpAlamat').textContent = alamat || '-';
        document.getElementById('dpTgl').textContent = created_at || '-';

        const statusEl = document.getElementById('dpStatus');
        if (status === 'Aktif') {
            statusEl.innerHTML = '<span class="inline-flex items-center gap-1 px-2 py-0.5 bg-primary/10 rounded-full text-xs font-bold text-primary"><span class="w-1.5 h-1.5 rounded-full bg-primary inline-block"></span>Aktif</span>';
        } else {
            statusEl.innerHTML = '<span class="inline-flex items-center gap-1 px-2 py-0.5 bg-surface-container-high rounded-full text-xs font-bold text-on-surface-variant"><span class="w-1.5 h-1.5 rounded-full bg-on-surface-variant inline-block"></span>' + status + '</span>';
        }

        const dModal = document.getElementById('modalDetailPetani');
        const dContent = document.getElementById('detailPetaniModalContent');
        dModal.classList.remove('opacity-0', 'pointer-events-none');
        dModal.classList.add('opacity-100');
        dContent.classList.remove('scale-95');
        dContent.classList.add('scale-100');
        document.body.style.overflow = 'hidden';
    }

    function closeDetailPetaniModal() {
        const dModal = document.getElementById('modalDetailPetani');
        const dContent = document.getElementById('detailPetaniModalContent');
        dModal.classList.add('opacity-0', 'pointer-events-none');
        dModal.classList.remove('opacity-100');
        dContent.classList.add('scale-95');
        dContent.classList.remove('scale-100');
        document.body.style.overflow = '';
    }

    function openModal() {
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        if (window.innerWidth < 640) {
            content.classList.remove('translate-y-full');
            content.classList.add('translate-y-0');
        } else {
            content.classList.remove('sm:scale-95');
            content.classList.add('sm:scale-100');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100');
        if (window.innerWidth < 640) {
            content.classList.add('translate-y-full');
            content.classList.remove('translate-y-0');
        } else {
            content.classList.add('sm:scale-95');
            content.classList.remove('sm:scale-100');
        }
        document.body.style.overflow = '';
    }

    if (btnOpen)   btnOpen.addEventListener('click', openAddModal);
    if (btnFab)    btnFab.addEventListener('click', openAddModal);
    if (btnClose)  btnClose.addEventListener('click', closeModal);
    if (btnCancel) btnCancel.addEventListener('click', closeModal);

    modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeModal();
            closeDetailPetaniModal();
        }
    });

    @if($errors->any())
        openModal();
    @endif

    ['toastPengguna', 'toastPenggunaErr'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            setTimeout(() => el.classList.remove('opacity-0', 'translate-y-4'), 100);
            setTimeout(() => el.classList.add('opacity-0', 'translate-y-4'), 3500);
        }
    });
</script>
@endpush
