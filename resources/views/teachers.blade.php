@extends('layouts.app')

@section('title', 'Guru & Staf - MTSN 7 Jember')

@section('content')

{{-- PAGE HEADER --}}
<section class="relative py-20 overflow-hidden"
    style="background: linear-gradient(135deg, #0f3d1a 0%, #1a5c2a 60%, #0f3d1a 100%);">
    <div style="position:absolute;top:-40px;left:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-60px;right:8%;width:220px;height:220px;border-radius:50%;background:rgba(232,82,26,0.07);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="700">
        <span class="text-xs font-semibold uppercase tracking-widest" style="color:#f4a47a;">Sumber Daya Manusia</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mt-2 leading-tight">
            Guru & <span style="color:#f4a47a;">Staf</span>
        </h1>
        <p class="text-green-200 text-sm md:text-base mt-4 max-w-xl mx-auto leading-relaxed">
            Tenaga pendidik dan kependidikan MTsN 7 Jember yang berdedikasi tinggi.
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 text-xs text-green-300">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="text-green-600">/</span>
            <span class="text-white font-semibold">Guru & Staf</span>
        </div>
    </div>
</section>

{{-- FILTER --}}
<section class="bg-white border-b border-gray-100 sticky top-0 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <form method="GET" action="{{ route('teachers') }}" class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
            {{-- Search --}}
            <div class="relative flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                </svg>
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Cari nama atau jabatan..."
                    class="w-full pl-9 pr-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition"
                    style="--tw-ring-color:#1a5c2a;">
            </div>

            <!-- {{-- Filter tab --}}
            <div class="flex gap-2 flex-shrink-0 flex-wrap">
                @foreach ([
                'all' => 'Semua',
                'guru' => 'Guru',
                'staf' => 'Staf',
                ] as $val => $label)
                <a href="{{ route('teachers', array_merge(request()->except('filter', 'page'), $val !== 'all' ? ['filter' => $val] : [])) }}"
                    class="px-4 py-2.5 rounded-lg text-xs font-semibold transition border
                    {{ (request('filter', 'all') === $val) ? 'text-white border-transparent' : 'text-gray-600 border-gray-200 bg-gray-50 hover:border-green-400 hover:text-green-700' }}"
                    style="{{ (request('filter', 'all') === $val) ? 'background:#1a5c2a;' : '' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div> -->

            <button type="submit"
                class="px-5 py-2.5 rounded-lg text-xs font-semibold text-white transition hover:opacity-90 flex-shrink-0"
                style="background:#e8521a;">
                Cari
            </button>
        </form>
    </div>
</section>

{{-- KONTEN --}}
<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Info hasil --}}
        @if (request('q') || request('filter'))
        <div class="mb-8 flex items-center gap-2 flex-wrap" data-aos="fade-up" data-aos-duration="400">
            <p class="text-sm text-gray-500">
                Menampilkan <span class="font-semibold" style="color:#1a5c2a;">{{ $teachers->total() }}</span> hasil
                @if (request('q'))
                untuk "<span class="font-semibold text-gray-700">{{ request('q') }}</span>"
                @endif
                @if (request('filter'))
                &mdash; <span class="font-semibold text-gray-700">{{ ucfirst(request('filter')) }}</span>
                @endif
            </p>
            <a href="{{ route('teachers') }}" class="text-xs font-semibold hover:underline flex items-center gap-1" style="color:#e8521a;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Reset
            </a>
        </div>
        @endif

        @if ($teachers->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
            @foreach ($teachers as $idx => $teacher)
            <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 flex flex-col"
                data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ ($idx % 5) * 80 }}">

                {{-- Foto --}}
                <div class="overflow-hidden bg-gray-100 flex-shrink-0" style="aspect-ratio:1/1;">
                    @if ($teacher->photo)
                    <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}"
                        class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center" style="background:#f0faf2;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" style="color:#c8e6c9;" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-4 flex flex-col flex-1">
                    <p class="font-bold text-sm text-gray-800 leading-snug group-hover:text-green-700 transition line-clamp-2">
                        {{ $teacher->name }}
                    </p>
                    <p class="text-xs mt-1 leading-snug line-clamp-2" style="color:#e8521a;">
                        {{ $teacher->position }}
                    </p>
                    @if ($teacher->subject)
                    <p class="text-xs text-gray-400 mt-1 line-clamp-1">{{ $teacher->subject }}</p>
                    @endif
                    @if ($teacher->nip)
                    <p class="text-xs text-gray-300 mt-auto pt-2 font-mono">{{ $teacher->nip }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($teachers->hasPages())
        <div class="mt-12 flex justify-center" data-aos="fade-up" data-aos-duration="500">
            <div class="flex items-center gap-1 flex-wrap justify-center">
                @if ($teachers->onFirstPage())
                <span class="px-4 py-2 rounded-lg text-sm text-gray-300 border border-gray-100 cursor-not-allowed">&larr;</span>
                @else
                <a href="{{ $teachers->previousPageUrl() }}"
                    class="px-4 py-2 rounded-lg text-sm border border-gray-200 text-gray-600 hover:border-green-500 hover:text-green-700 transition">&larr;</a>
                @endif

                @foreach ($teachers->getUrlRange(1, $teachers->lastPage()) as $page => $url)
                <a href="{{ $url }}"
                    class="px-4 py-2 rounded-lg text-sm font-semibold border transition
                    {{ $teachers->currentPage() === $page ? 'text-white border-transparent' : 'border-gray-200 text-gray-600 hover:border-green-500 hover:text-green-700' }}"
                    style="{{ $teachers->currentPage() === $page ? 'background:#1a5c2a;' : '' }}">
                    {{ $page }}
                </a>
                @endforeach

                @if ($teachers->hasMorePages())
                <a href="{{ $teachers->nextPageUrl() }}"
                    class="px-4 py-2 rounded-lg text-sm border border-gray-200 text-gray-600 hover:border-green-500 hover:text-green-700 transition">&rarr;</a>
                @else
                <span class="px-4 py-2 rounded-lg text-sm text-gray-300 border border-gray-100 cursor-not-allowed">&rarr;</span>
                @endif
            </div>
        </div>
        @endif

        @else
        {{-- Empty state --}}
        <div class="text-center py-24" data-aos="fade-up" data-aos-duration="600">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:#f0faf2;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" style="color:#1a5c2a;" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <p class="font-semibold text-gray-700 text-lg">Tidak ada data ditemukan</p>
            <p class="text-gray-400 text-sm mt-1">Coba kata kunci atau filter yang berbeda.</p>
            <a href="{{ route('teachers') }}"
                class="mt-5 inline-block px-6 py-2.5 rounded-lg text-sm font-semibold text-white transition hover:opacity-90"
                style="background:#e8521a;">
                Lihat Semua
            </a>
        </div>
        @endif

    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

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
    AOS.init({
        once: true,
        easing: 'ease-out-cubic',
        offset: 60
    });
</script>
@endpush