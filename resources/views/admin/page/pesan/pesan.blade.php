@extends('admin.layout.master')

@section('content')
<div class="space-y-lg">
    <!-- Page Header -->
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <nav class="flex flex-wrap items-center gap-2 text-on-surface-variant font-label-sm text-label-sm mb-2">
                <a class="hover:text-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-bold">Pesan Masuk</span>
            </nav>
            <h1 class="font-headline-lg text-headline-lg font-extrabold text-on-surface">Pesan Kontak Pengunjung</h1>
            <p class="text-on-surface-variant font-body-md text-body-md mt-2">
                Pesan yang dikirimkan oleh pengunjung melalui halaman Hubungi Kami.
            </p>
        </div>
        <div class="flex items-center gap-3">
            @if($totalUnread > 0)
            <span class="inline-flex items-center gap-2 px-4 py-2 bg-error-container text-on-error-container font-bold rounded-xl text-sm">
                <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1">mark_email_unread</span>
                {{ $totalUnread }} Belum Dibaca
            </span>
            @endif
            <span class="inline-flex items-center gap-2 px-4 py-2 bg-surface-container-high text-on-surface font-semibold rounded-xl text-sm">
                <span class="material-symbols-outlined text-base">inbox</span>
                {{ $totalMessages }} Total
            </span>
        </div>
    </div>

    <!-- Filter & Search -->
    <form method="GET" action="{{ route('admin.pesan') }}" class="flex flex-col sm:flex-row gap-3 bg-white p-md rounded-2xl shadow-sm border border-outline-variant/20">
        <div class="relative flex-1">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-base">search</span>
            <input type="text" name="search" value="{{ $search }}"
                   placeholder="Cari nama, subjek, atau isi pesan..."
                   class="w-full pl-9 pr-4 py-2 rounded-xl border border-outline-variant bg-surface-container-low text-sm focus:ring-1 focus:ring-primary focus:border-primary">
        </div>
        <select name="filter" class="rounded-xl border border-outline-variant bg-surface-container-low px-4 py-2 text-sm font-medium focus:ring-1 focus:ring-primary">
            <option value="all"    {{ $filter == 'all'    ? 'selected' : '' }}>Semua Pesan</option>
            <option value="unread" {{ $filter == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
            <option value="read"   {{ $filter == 'read'   ? 'selected' : '' }}>Sudah Dibaca</option>
        </select>
        <button type="submit" class="px-4 py-2 bg-primary text-on-primary rounded-xl font-semibold text-sm hover:bg-primary/90 transition-all active:scale-95">
            Filter
        </button>
        <a href="{{ route('admin.pesan') }}" class="px-4 py-2 bg-surface-container-high text-on-surface-variant rounded-xl font-semibold text-sm hover:bg-surface-container-highest transition-all text-center">
            Reset
        </a>
    </form>

    <!-- Messages List -->
    <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden">
        <div class="px-lg py-md border-b border-outline-variant/20 flex justify-between items-center">
            <h4 class="font-title-lg text-title-lg text-on-background">Daftar Pesan</h4>
            <span class="text-sm text-on-surface-variant">{{ $messages->total() }} pesan ditemukan</span>
        </div>

        @forelse($messages as $msg)
        <div class="border-b border-outline-variant/10 last:border-0 hover:bg-surface-container-low/30 transition-colors
                    {{ !$msg->is_read ? 'bg-primary/5' : '' }}" id="msg-{{ $msg->id }}">
            <div class="px-lg py-4 flex items-start gap-4">
                <!-- Avatar -->
                <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center font-bold text-sm
                            {{ !$msg->is_read ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface-variant' }}">
                    {{ strtoupper(substr($msg->name, 0, 1)) }}
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="font-bold text-on-surface {{ !$msg->is_read ? 'text-primary' : '' }}">
                                {{ $msg->name }}
                            </span>
                            @if($msg->email)
                            <span class="text-xs text-on-surface-variant">· {{ $msg->email }}</span>
                            @endif
                            @if(!$msg->is_read)
                            <span class="inline-block w-2 h-2 rounded-full bg-primary flex-shrink-0"></span>
                            @endif
                        </div>
                        <span class="text-xs text-on-surface-variant whitespace-nowrap">
                            {{ $msg->created_at->diffForHumans() }}
                        </span>
                    </div>
                    @if($msg->subject)
                    <p class="text-sm font-semibold text-on-surface mb-1">{{ $msg->subject }}</p>
                    @endif
                    <p class="text-sm text-on-surface-variant line-clamp-2 cursor-pointer"
                       onclick="toggleMessage({{ $msg->id }})">
                        {{ $msg->message }}
                    </p>
                    <!-- Full Message (hidden, toggled) -->
                    <div id="full-{{ $msg->id }}" class="hidden mt-2 p-3 bg-surface-container-low rounded-xl text-sm text-on-surface leading-relaxed">
                        {{ $msg->message }}
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-1 flex-shrink-0">
                    @if(!$msg->is_read)
                    <a href="{{ route('admin.pesan.read', $msg->id) }}"
                       class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-colors"
                       title="Tandai sudah dibaca">
                        <span class="material-symbols-outlined text-lg">mark_email_read</span>
                    </a>
                    @endif
                    <button onclick="toggleMessage({{ $msg->id }})"
                            class="p-2 hover:bg-surface-container-high rounded-lg text-on-surface-variant transition-colors"
                            title="Lihat pesan lengkap">
                        <span class="material-symbols-outlined text-lg" id="icon-{{ $msg->id }}">expand_more</span>
                    </button>
                    <form action="{{ route('admin.pesan.destroy', $msg->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors"
                                title="Hapus pesan"
                                onclick="return confirmSubmit(event, 'Hapus Pesan Kontak', 'Apakah Anda yakin ingin menghapus pesan dari {{ addslashes($msg->name) }}?')">
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="px-lg py-16 text-center">
            <div class="flex flex-col items-center gap-3 text-on-surface-variant">
                <span class="material-symbols-outlined text-6xl opacity-20">inbox</span>
                <p class="font-medium text-lg">Belum ada pesan masuk</p>
                <p class="text-sm">Pesan dari pengunjung akan muncul di sini.</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($messages->hasPages())
    <div class="flex justify-center">
        {{ $messages->links('pagination::tailwind') }}
    </div>
    @endif
</div>

{{-- Success Toast --}}
@if(session('success'))
<div id="successToast"
     class="fixed bottom-6 right-6 z-[200] transition-all duration-500 opacity-0 translate-y-4">
    <div class="bg-on-background text-white px-lg py-sm rounded-xl shadow-2xl flex items-center gap-md">
        <span class="material-symbols-outlined text-secondary-fixed-dim" style="font-variation-settings: 'FILL' 1;">check_circle</span>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
    // Toggle pesan lengkap
    function toggleMessage(id) {
        const full = document.getElementById('full-' + id);
        const icon = document.getElementById('icon-' + id);
        if (full.classList.contains('hidden')) {
            full.classList.remove('hidden');
            if (icon) icon.textContent = 'expand_less';
        } else {
            full.classList.add('hidden');
            if (icon) icon.textContent = 'expand_more';
        }
    }

    // Success Toast
    document.addEventListener('DOMContentLoaded', function () {
        const t = document.getElementById('successToast');
        if (t) {
            setTimeout(() => { t.classList.remove('opacity-0', 'translate-y-4'); }, 100);
            setTimeout(() => { t.classList.add('opacity-0', 'translate-y-4'); }, 3500);
        }
    });
</script>
@endpush
