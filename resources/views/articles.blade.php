@extends('layouts.app')

@section('title', 'Berita & Kegiatan - MTSN 7 Jember')

@section('content')

{{-- PAGE HEADER --}}
<section class="relative py-20 overflow-hidden"
    style="background: linear-gradient(135deg, #0f3d1a 0%, #1a5c2a 60%, #0f3d1a 100%);">
    <div style="position:absolute;top:-40px;left:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-60px;right:8%;width:220px;height:220px;border-radius:50%;background:rgba(232,82,26,0.07);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="700">
        <span class="text-xs font-semibold uppercase tracking-widest" style="color:#f4a47a;">Informasi</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mt-2 leading-tight">
            Berita & <span style="color:#f4a47a;">Kegiatan</span>
        </h1>
        <p class="text-green-200 text-sm md:text-base mt-4 max-w-xl mx-auto leading-relaxed">
            Ikuti perkembangan terbaru, pengumuman, dan kegiatan MTsN 7 Jember.
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 text-xs text-green-300">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="text-green-600">/</span>
            <span class="text-white font-semibold">Berita & Kegiatan</span>
        </div>
    </div>
</section>

{{-- SEARCH & FILTER --}}
<section class="bg-white border-b border-gray-100 sticky top-0 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <form method="GET" action="{{ route('articles') }}" class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
            {{-- Search --}}
            <div class="relative flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                </svg>
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Cari berita atau pengumuman..."
                    class="w-full pl-9 pr-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition"
                    style="--tw-ring-color: #1a5c2a;">
            </div>

            {{-- Filter Kategori --}}
            <div class="flex gap-2 flex-shrink-0">
                @foreach (['all' => 'Semua', 'berita' => 'Berita', 'pengumuman' => 'Pengumuman'] as $val => $label)
                <a href="{{ route('articles', array_merge(request()->except('category', 'page'), $val !== 'all' ? ['category' => $val] : [])) }}"
                    class="px-4 py-2.5 rounded-lg text-xs font-semibold transition border
                    {{ (request('category', 'all') === $val) ? 'text-white border-transparent' : 'text-gray-600 border-gray-200 bg-gray-50 hover:border-green-400 hover:text-green-700' }}"
                    style="{{ (request('category', 'all') === $val) ? 'background:#1a5c2a;' : '' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>

            {{-- Tombol Search --}}
            <button type="submit"
                class="px-5 py-2.5 rounded-lg text-xs font-semibold text-white transition hover:opacity-90 flex-shrink-0"
                style="background:#e8521a;">
                Cari
            </button>
        </form>
    </div>
</section>

{{-- ARTIKEL LIST --}}
<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Info hasil pencarian --}}
        @if (request('q') || request('category'))
        <div class="mb-8 flex items-center gap-2 flex-wrap" data-aos="fade-up" data-aos-duration="400">
            <p class="text-sm text-gray-500">
                Menampilkan <span class="font-semibold" style="color:#1a5c2a;">{{ $articles->total() }}</span> hasil
                @if (request('q'))
                untuk "<span class="font-semibold text-gray-700">{{ request('q') }}</span>"
                @endif
                @if (request('category'))
                &mdash; kategori <span class="font-semibold text-gray-700">{{ ucfirst(request('category')) }}</span>
                @endif
            </p>
            <a href="{{ route('articles') }}" class="text-xs font-semibold hover:underline flex items-center gap-1" style="color:#e8521a;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Reset
            </a>
        </div>
        @endif

        @if ($articles->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($articles as $idx => $article)
            <a href="{{ route('articles.show', $article->slug) }}"
                class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 flex flex-col"
                data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ ($idx % 3) * 100 }}">

                {{-- Thumbnail --}}
                <div class="h-48 overflow-hidden bg-gray-100 flex-shrink-0 relative">
                    @if ($article->thumbnail)
                    <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center" style="background:#f0faf2;">
                        <img src="{{ asset('images/logo.png') }}" class="h-14 opacity-20">
                    </div>
                    @endif

                    {{-- Badge kategori di atas thumbnail --}}
                    <span class="absolute top-3 left-3 text-xs font-semibold px-3 py-1 rounded-full shadow-sm"
                        style="{{ $article->category === 'berita' ? 'background:#1a5c2a;color:#fff;' : 'background:#e8521a;color:#fff;' }}">
                        {{ ucfirst($article->category) }}
                    </span>
                </div>

                {{-- Konten --}}
                <div class="p-5 flex flex-col flex-1">
                    <p class="text-xs text-gray-400 mb-2">
                        {{ $article->published_at?->format('d M Y') }}
                        @if ($article->user)
                        &bull; {{ $article->user->name }}
                        @endif
                    </p>
                    <h3 class="font-bold text-gray-800 leading-snug text-base group-hover:text-green-700 transition line-clamp-2 flex-1">
                        {{ $article->title }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mt-2 line-clamp-3">
                        {{ Str::limit(strip_tags($article->body), 120) }}
                    </p>
                    <span class="mt-4 text-xs font-semibold inline-flex items-center gap-1 transition group-hover:gap-2"
                        style="color:#1a5c2a;">
                        Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($articles->hasPages())
        <div class="mt-12 flex justify-center" data-aos="fade-up" data-aos-duration="500">
            <div class="flex items-center gap-1">
                {{-- Prev --}}
                @if ($articles->onFirstPage())
                <span class="px-4 py-2 rounded-lg text-sm text-gray-300 border border-gray-100 cursor-not-allowed">
                    &larr;
                </span>
                @else
                <a href="{{ $articles->previousPageUrl() }}"
                    class="px-4 py-2 rounded-lg text-sm border border-gray-200 text-gray-600 hover:border-green-500 hover:text-green-700 transition">
                    &larr;
                </a>
                @endif

                {{-- Pages --}}
                @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                <a href="{{ $url }}"
                    class="px-4 py-2 rounded-lg text-sm font-semibold border transition
                    {{ $articles->currentPage() === $page ? 'text-white border-transparent' : 'border-gray-200 text-gray-600 hover:border-green-500 hover:text-green-700' }}"
                    style="{{ $articles->currentPage() === $page ? 'background:#1a5c2a;' : '' }}">
                    {{ $page }}
                </a>
                @endforeach

                {{-- Next --}}
                @if ($articles->hasMorePages())
                <a href="{{ $articles->nextPageUrl() }}"
                    class="px-4 py-2 rounded-lg text-sm border border-gray-200 text-gray-600 hover:border-green-500 hover:text-green-700 transition">
                    &rarr;
                </a>
                @else
                <span class="px-4 py-2 rounded-lg text-sm text-gray-300 border border-gray-100 cursor-not-allowed">
                    &rarr;
                </span>
                @endif
            </div>
        </div>
        @endif

        @else
        {{-- Empty state --}}
        <div class="text-center py-24" data-aos="fade-up" data-aos-duration="600">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4"
                style="background:#f0faf2;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" style="color:#1a5c2a;" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 4v6h6M9 12h6M9 16h4" />
                </svg>
            </div>
            <p class="font-semibold text-gray-700 text-lg">Belum ada artikel</p>
            <p class="text-gray-400 text-sm mt-1">Coba kata kunci atau filter yang berbeda.</p>
            <a href="{{ route('articles') }}"
                class="mt-5 inline-block px-6 py-2.5 rounded-lg text-sm font-semibold text-white transition hover:opacity-90"
                style="background:#e8521a;">
                Lihat Semua Artikel
            </a>
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

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
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