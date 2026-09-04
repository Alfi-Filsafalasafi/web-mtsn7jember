@extends('layouts.app')

@section('title', 'Literasi - MTSN 7 Jember')

@section('content')

{{-- PAGE HEADER --}}
<section class="relative py-20 overflow-hidden"
    style="background: linear-gradient(135deg, #0f3d1a 0%, #1a5c2a 60%, #0f3d1a 100%);">
    <div style="position:absolute;top:-40px;left:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-60px;right:8%;width:220px;height:220px;border-radius:50%;background:rgba(232,82,26,0.07);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="700">
        <span class="text-xs font-semibold uppercase tracking-widest" style="color:#f4a47a;">Karya Tulis</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mt-2 leading-tight">
            Literasi <span style="color:#f4a47a;">Guru & Siswa</span>
        </h1>
        <p class="text-green-200 text-sm md:text-base mt-4 max-w-xl mx-auto leading-relaxed">
            Ruang berkarya tulis untuk guru dan siswa MTsN 7 Jember, dengan tema baru setiap bulannya.
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 text-xs text-green-300">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="text-green-600">/</span>
            <span class="text-white font-semibold">Literasi</span>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        {{-- BANNER TEMA BULAN INI --}}
        @php
            $temaAktif = $temas->firstWhere('status', 'belum') ?? $temas->first();
        @endphp
        @if ($temaAktif)
        <div style="background-color: #fff8f0; border-left: 4px solid #e8521a;" class="rounded-xl p-5 mb-10"
            data-aos="fade-up" data-aos-duration="600">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div class="flex-1">
                    <span class="text-xs font-bold uppercase tracking-widest" style="color:#e8521a;">
                        Tema {{ $temaAktif->nama_bulan }} {{ $temaAktif->tahun }}
                    </span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-2">
                        <div>
                            <p class="text-xs text-gray-400 font-semibold">Tema untuk Guru</p>
                            <p class="text-gray-800 text-sm font-bold">{{ $temaAktif->tema_guru }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-semibold">Tema untuk Siswa</p>
                            <p class="text-gray-800 text-sm font-bold">{{ $temaAktif->tema_siswa }}</p>
                        </div>
                    </div>
                    @if ($temaAktif->aturan_penulisan)
                    <div class="mt-3 pt-3 border-t border-orange-100">
                        <p class="text-xs text-gray-400 font-semibold mb-1">Aturan Penulisan</p>
                        <div class="prose prose-sm max-w-none text-gray-600 text-xs leading-relaxed">
                            {!! $temaAktif->aturan_penulisan !!}
                        </div>
                    </div>
                    @endif
                </div>
                <a href="{{ route('literasi.create') }}"
                    class="flex-shrink-0 inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg font-semibold text-white text-sm transition hover:opacity-90"
                    style="background:#e8521a;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Artikel
                </a>
            </div>
        </div>
        @else
        <div style="background-color: #fff8f0; border-left: 4px solid #e8521a;" class="rounded-xl p-5 mb-10 text-center text-gray-400" data-aos="fade-up">
            Belum ada tema literasi yang ditentukan admin.
        </div>
        @endif

        {{-- COMBOBOX BULAN/TAHUN + FILTER TIPE --}}
        <div class="flex flex-col sm:flex-row gap-3 mb-8" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
            <form action="{{ route('literasi') }}" method="GET" class="flex-1" id="filter-tema-form">
                <select name="tema" onchange="document.getElementById('filter-tema-form').submit()"
                    class="w-full px-5 py-3.5 text-sm font-semibold rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 transition"
                    style="--tw-ring-color:#1a5c2a; color:#1a5c2a;">
                    <option value="semua" {{ $tampilkanSemua ? 'selected' : '' }}>Semua Periode</option>
                    @forelse ($temas as $tema)
                        <option value="{{ $tema->id }}" {{ ! $tampilkanSemua && $temaTerpilih && $temaTerpilih->id === $tema->id ? 'selected' : '' }}>
                            {{ $tema->nama_bulan }} {{ $tema->tahun }}
                        </option>
                    @empty
                    @endforelse
                </select>
                @if (request()->filled('tipe'))
                    <input type="hidden" name="tipe" value="{{ request('tipe') }}">
                @endif
            </form>

            @php
                $currentTemaParam = $tampilkanSemua ? 'semua' : $temaTerpilih?->id;
            @endphp
            <div class="flex gap-2">
                <a href="{{ route('literasi', array_filter(['tema' => $currentTemaParam])) }}"
                    class="px-5 py-3.5 text-sm font-semibold rounded-xl border transition
                       {{ ! request()->filled('tipe') ? 'text-white' : 'text-gray-600 border-gray-200 bg-white hover:border-green-600' }}"
                    style="{{ ! request()->filled('tipe') ? 'background:#1a5c2a;border-color:#1a5c2a;' : '' }}">
                    Semua
                </a>
                <a href="{{ route('literasi', array_filter(['tema' => $currentTemaParam, 'tipe' => 'guru'])) }}"
                    class="px-5 py-3.5 text-sm font-semibold rounded-xl border transition
                       {{ request('tipe') === 'guru' ? 'text-white' : 'text-gray-600 border-gray-200 bg-white hover:border-green-600' }}"
                    style="{{ request('tipe') === 'guru' ? 'background:#1a5c2a;border-color:#1a5c2a;' : '' }}">
                    Guru
                </a>
                <a href="{{ route('literasi', array_filter(['tema' => $currentTemaParam, 'tipe' => 'siswa'])) }}"
                    class="px-5 py-3.5 text-sm font-semibold rounded-xl border transition
                       {{ request('tipe') === 'siswa' ? 'text-white' : 'text-gray-600 border-gray-200 bg-white hover:border-green-600' }}"
                    style="{{ request('tipe') === 'siswa' ? 'background:#1a5c2a;border-color:#1a5c2a;' : '' }}">
                    Siswa
                </a>
            </div>
        </div>

        {{-- GRID ARTIKEL --}}
        @if ($literasis->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($literasis as $idx => $item)
            <a href="{{ route('literasi.show', $item->slug) }}"
                class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition flex flex-col"
                data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ ($idx % 6) * 80 }}">
                <div class="overflow-hidden bg-gray-100" style="height: 180px;">
                    @if ($item->thumbnail)
                    <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-green-50">
                        <img src="{{ asset('images/logo.png') }}" class="h-14 opacity-20">
                    </div>
                    @endif
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-semibold px-3 py-1 rounded-full"
                            style="{{ $item->tipe === 'guru' ? 'background:#e8f5e9;color:#1a5c2a;' : 'background:#e6f0fb;color:#1a5cb8;' }}">
                            {{ ucfirst($item->tipe) }}
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-800 leading-snug mb-1.5 group-hover:text-green-700 transition line-clamp-2">
                        {{ $item->judul }}
                    </h3>
                    <p class="text-gray-500 text-xs leading-relaxed truncate">
                        {{ Str::limit(strip_tags($item->isi), 90) }}
                    </p>
                    <p class="text-gray-400 text-xs mt-3 pt-3 border-t border-gray-50">
                        Oleh <span class="font-semibold text-gray-600">{{ $item->nama_penulis }}</span>
                    </p>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $literasis->links() }}
        </div>
        @else
        <div class="bg-white rounded-2xl text-center py-16 text-gray-400" data-aos="fade-up">
            Belum ada literasi untuk periode ini.
        </div>
        @endif

    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ once: true, easing: 'ease-out-cubic', offset: 60 });
</script>
@endpush