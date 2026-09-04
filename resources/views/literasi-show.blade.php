@extends('layouts.app')

@section('title', $literasi->judul . ' - MTSN 7 Jember')

@section('content')

<section class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-xs text-gray-400 mb-6" data-aos="fade-up" data-aos-duration="500">
            <a href="{{ route('home') }}" class="hover:text-green-700 transition">Beranda</a>
            <span>/</span>
            <a href="{{ route('literasi') }}" class="hover:text-green-700 transition">Literasi</a>
            <span>/</span>
            <span class="text-gray-600 font-medium truncate">{{ $literasi->judul }}</span>
        </div>

        {{-- Notifikasi sukses (habis submit) --}}
        @if (session('success'))
        <div class="mb-6 flex items-start gap-3 px-4 py-4 rounded-xl text-sm font-medium"
            style="background:#e8f5e9;color:#1a5c2a;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <article class="bg-white rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up" data-aos-duration="700">

            {{-- Thumbnail --}}
            @if ($literasi->thumbnail)
            <div class="overflow-hidden bg-gray-100" style="height: 320px;">
                <img src="{{ Storage::url($literasi->thumbnail) }}" alt="{{ $literasi->judul }}"
                    class="w-full h-full object-cover">
            </div>
            @endif

            <div class="p-7 md:p-10">
                {{-- Meta: tipe, tema bulan, tanggal --}}
                <div class="flex flex-wrap items-center gap-3 mb-5">
                    <span class="text-xs font-semibold px-3 py-1 rounded-full"
                        style="{{ $literasi->tipe === 'guru' ? 'background:#e8f5e9;color:#1a5c2a;' : 'background:#e6f0fb;color:#1a5cb8;' }}">
                        {{ ucfirst($literasi->tipe) }}
                    </span>
                    @if ($literasi->literasiTema)
                    <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background:#fff3e0;color:#e8521a;">
                        Tema {{ $literasi->literasiTema->nama_bulan }} {{ $literasi->literasiTema->tahun }}
                    </span>
                    @endif
                    <span class="text-xs text-gray-400">{{ $literasi->created_at->format('d M Y') }}</span>
                </div>

                {{-- Judul --}}
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800 leading-tight mb-4">
                    {{ $literasi->judul }}
                </h1>

                {{-- Penulis --}}
                <div class="flex items-center gap-3 pb-6 mb-6 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
                        style="background:#1a5c2a;">
                        {{ strtoupper(substr($literasi->nama_penulis, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $literasi->nama_penulis }}</p>
                        <p class="text-xs text-gray-400">{{ ucfirst($literasi->tipe) }} MTsN 7 Jember</p>
                    </div>
                </div>

                {{-- Isi --}}
                <div class="prose max-w-none prose-headings:text-gray-800 prose-p:text-gray-600 prose-p:leading-relaxed prose-img:rounded-xl">
                    {!! $literasi->isi !!}
                </div>
            </div>
        </article>

        {{-- Share --}}
        <div class="mt-6 bg-white rounded-2xl shadow-sm p-5 md:p-6" data-aos="fade-up" data-aos-duration="600">
            <p class="text-sm font-semibold text-gray-700 mb-3">Bagikan artikel ini</p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="https://wa.me/?text={{ urlencode($literasi->judul . ' - ' . route('literasi.show', $literasi->slug)) }}"
                    target="_blank" rel="noopener"
                    class="flex-shrink-0 inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg font-semibold text-white text-sm transition hover:opacity-90"
                    style="background:#25D366;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.148.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12.001 2C6.478 2 2 6.478 2 12c0 1.885.52 3.65 1.42 5.156L2 22l4.98-1.396A9.95 9.95 0 0012.001 22C17.523 22 22 17.523 22 12S17.523 2 12.001 2zm0 18.2c-1.72 0-3.328-.472-4.707-1.293l-.337-.2-3.045.854.837-2.97-.22-.35A8.164 8.164 0 013.8 12c0-4.522 3.679-8.2 8.201-8.2 4.521 0 8.2 3.678 8.2 8.2 0 4.522-3.679 8.2-8.2 8.2z"/>
                    </svg>
                    Bagikan ke WhatsApp
                </a>

                <div class="flex-1 flex items-center gap-2 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">
                    <input type="text" id="share-link" readonly value="{{ route('literasi.show', $literasi->slug) }}"
                        class="flex-1 bg-transparent text-sm text-gray-500 focus:outline-none truncate">
                    <button type="button" id="copy-link-btn"
                        class="flex-shrink-0 flex items-center gap-1.5 text-sm font-semibold transition"
                        style="color:#1a5c2a;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span id="copy-link-text">Salin</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Navigasi bawah --}}
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4" data-aos="fade-up" data-aos-duration="600">
            <a href="{{ route('literasi') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold hover:underline" style="color:#1a5c2a;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Literasi
            </a>
            <a href="{{ route('literasi.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg font-semibold text-white text-sm transition hover:opacity-90"
                style="background:#e8521a;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Buat Artikel Juga
            </a>
        </div>

    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ once: true, easing: 'ease-out-cubic', offset: 60 });

    // ── Copy link ──
    const copyBtn = document.getElementById('copy-link-btn');
    const copyText = document.getElementById('copy-link-text');
    const shareLinkInput = document.getElementById('share-link');

    copyBtn.addEventListener('click', function () {
        navigator.clipboard.writeText(shareLinkInput.value).then(function () {
            copyText.textContent = 'Tersalin!';
            setTimeout(function () {
                copyText.textContent = 'Salin';
            }, 2000);
        }).catch(function () {
            // Fallback untuk browser lama / non-HTTPS
            shareLinkInput.select();
            document.execCommand('copy');
            copyText.textContent = 'Tersalin!';
            setTimeout(function () {
                copyText.textContent = 'Salin';
            }, 2000);
        });
    });
</script>
@endpush