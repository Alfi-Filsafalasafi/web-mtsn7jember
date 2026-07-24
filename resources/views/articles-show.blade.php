@extends('layouts.app')

@section('title', $article->title . ' - MTSN 7 Jember')

@section('content')

{{-- BREADCRUMB TIPIS --}}
<div class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex items-center gap-2 text-xs text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-green-700 transition">Beranda</a>
            <span>/</span>
            <a href="{{ route('articles') }}" class="hover:text-green-700 transition">Berita & Kegiatan</a>
            <span>/</span>
            <span class="text-gray-600 font-medium line-clamp-1">{{ Str::limit($article->title, 50) }}</span>
        </div>
    </div>
</div>

{{-- KONTEN --}}
<section class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- Kolom Kiri: Detail Artikel --}}
            <article class="lg:col-span-2 bg-white rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up" data-aos-duration="600">

                {{-- Thumbnail --}}
                @if ($article->thumbnail)
                <div class="w-full overflow-hidden" style="max-height:420px;">
                    <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
                        class="w-full object-cover">
                </div>
                @endif

                <div class="p-6 md:p-9">
                    {{-- Badge kategori --}}
                    <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-4"
                        style="{{ $article->category === 'berita' ? 'background:#e8f5e9;color:#1a5c2a;' : 'background:#fff3e0;color:#e8521a;' }}">
                        {{ ucfirst($article->category) }}
                    </span>

                    {{-- Judul --}}
                    <h1 class="text-2xl md:text-3xl font-extrabold leading-tight mb-4" style="color:#1a2a1e;">
                        {{ $article->title }}
                    </h1>

                    {{-- Meta --}}
                    <div class="flex flex-wrap items-center gap-4 text-xs text-gray-400 pb-6 mb-6 border-b border-gray-100">
                        <span class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $article->published_at?->format('d M Y, H:i') }} WIB
                        </span>
                        @if ($article->user)
                        <span class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $article->user->name }}
                        </span>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="article-body prose prose-sm md:prose max-w-none text-gray-700 leading-relaxed">
                        {!! $article->body !!}
                    </div>

                    {{-- Share --}}
                    <div class="mt-10 pt-6 border-t border-gray-100 flex flex-wrap items-center gap-3">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Bagikan:</span>
                        <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . request()->url()) }}"
                            target="_blank" rel="noopener"
                            class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-semibold text-white transition hover:opacity-85"
                            style="background:#25D366;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.118 1.528 5.855L0 24l6.335-1.505A11.943 11.943 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.886 0-3.653-.498-5.188-1.37l-.372-.22-3.762.894.952-3.668-.243-.386A9.932 9.932 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                            </svg>
                            WhatsApp
                        </a>
                        <button onclick="copyLink()"
                            class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-xs font-semibold border border-gray-200 text-gray-600 transition hover:border-green-400 hover:text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <span id="copy-label">Salin Link</span>
                        </button>
                    </div>

                    {{-- Tombol kembali --}}
                    <div class="mt-8">
                        <a href="{{ route('articles') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold transition hover:gap-3"
                            style="color:#1a5c2a;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                            </svg>
                            Kembali ke Berita
                        </a>
                    </div>
                </div>
            </article>

            {{-- Kolom Kanan: Berita Terbaru --}}
            @php
            $latestArticles = \App\Models\Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();
            @endphp

            @if ($latestArticles->count())
            <aside data-aos="fade-left" data-aos-duration="600" data-aos-delay="100">
                <div class="bg-white rounded-2xl shadow-sm p-5 sticky top-24">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-1 h-5 rounded-full" style="background:#e8521a;"></div>
                        <h3 class="font-bold text-sm" style="color:#1a5c2a;">Berita Terbaru</h3>
                    </div>
                    <div class="space-y-4">
                        @foreach ($latestArticles as $latest)
                        <a href="{{ route('articles.show', $latest->slug) }}"
                            class="group flex gap-3 items-start hover:opacity-80 transition">

                            {{-- Gambar --}}
                            <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100">
                                @if ($latest->thumbnail)
                                <img src="{{ Storage::url($latest->thumbnail) }}" alt="{{ $latest->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                <div class="w-full h-full flex items-center justify-center" style="background:#f0faf2;">
                                    <img src="{{ asset('images/logo.png') }}" class="h-7 opacity-20">
                                </div>
                                @endif
                            </div>

                            {{-- Keterangan --}}
                            <div class="flex-1 min-w-0">
                                <span class="inline-block text-[10px] font-semibold px-2.5 py-0.5 rounded-full mb-1.5"
                                    style="{{ $latest->category === 'berita' ? 'background:#e8f5e9;color:#1a5c2a;' : 'background:#fff3e0;color:#e8521a;' }}">
                                    {{ ucfirst($latest->category) }}
                                </span>
                                <p class="text-xs font-semibold text-gray-700 group-hover:text-green-700 transition leading-snug line-clamp-2 mb-1">
                                    {{ $latest->title }}
                                </p>
                                <p class="text-[11px] text-gray-400 leading-relaxed line-clamp-2">
                                    {{ Str::limit(strip_tags($latest->body), 70) }}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </aside>
            @endif

        </div>
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

    /* Article body typography */
    .article-body h1,
    .article-body h2,
    .article-body h3 {
        font-weight: 700;
        color: #1a5c2a;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .article-body h1 {
        font-size: 1.5rem;
    }

    .article-body h2 {
        font-size: 1.25rem;
    }

    .article-body h3 {
        font-size: 1.1rem;
    }

    .article-body p {
        margin-bottom: 1rem;
        line-height: 1.8;
        color: #374151;
    }

    .article-body ul,
    .article-body ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .article-body ul {
        list-style-type: disc;
    }

    .article-body ol {
        list-style-type: decimal;
    }

    .article-body li {
        margin-bottom: 0.35rem;
        line-height: 1.7;
        color: #374151;
    }

    .article-body a {
        color: #1a5c2a;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .article-body a:hover {
        color: #e8521a;
    }

    .article-body img {
        max-width: 100%;
        border-radius: 12px;
        margin: 1.25rem 0;
    }

    .article-body blockquote {
        border-left: 4px solid #1a5c2a;
        padding: 0.75rem 1rem;
        background: #f7faf8;
        border-radius: 0 8px 8px 0;
        margin: 1.25rem 0;
        color: #4b5563;
        font-style: italic;
    }

    .article-body strong {
        color: #1a2a1e;
    }

    .article-body table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.25rem 0;
        font-size: 0.875rem;
    }

    .article-body th {
        background: #1a5c2a;
        color: white;
        padding: 0.6rem 0.9rem;
        text-align: left;
    }

    .article-body td {
        padding: 0.6rem 0.9rem;
        border-bottom: 1px solid #e5e7eb;
        color: #374151;
    }

    .article-body tr:hover td {
        background: #f7faf8;
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

    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const label = document.getElementById('copy-label');
            label.textContent = 'Tersalin!';
            setTimeout(() => label.textContent = 'Salin Link', 2000);
        });
    }
</script>
@endpush
