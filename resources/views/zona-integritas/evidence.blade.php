@extends('layouts.app')

@section('title', 'Evidence ZI - Zona Integritas - MTSN 7 Jember')

@section('content')

{{-- PAGE HEADER --}}
<section class="relative py-20 overflow-hidden"
    style="background: linear-gradient(135deg, #0f3d1a 0%, #1a5c2a 60%, #0f3d1a 100%);">
    <div style="position:absolute;top:-40px;left:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-60px;right:8%;width:220px;height:220px;border-radius:50%;background:rgba(232,82,26,0.07);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="700">
        <span class="text-xs font-semibold uppercase tracking-widest" style="color:#f4a47a;">Zona Integritas</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mt-2 leading-tight">
            Evidence <span style="color:#f4a47a;">ZI</span>
        </h1>
        <p class="text-green-200 text-sm md:text-base mt-4 max-w-xl mx-auto leading-relaxed">
            Dokumen bukti dukung (evidence) pelaksanaan Zona Integritas menuju WBK/WBBM, dikelompokkan per Kelompok Kerja (Pokja).
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 text-xs text-green-300">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="text-green-600">/</span>
            <span class="text-green-100">Zona Integritas</span>
            <span class="text-green-600">/</span>
            <span class="text-white font-semibold">Evidence ZI</span>
        </div>
    </div>
</section>

{{-- GRID POKJA --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        @if ($pokjas->isEmpty())
        <div class="text-center py-16">
            <p class="text-gray-400 text-sm">Belum ada data Pokja yang ditambahkan.</p>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($pokjas as $i => $pokja)
            <a href="{{ $pokja->gdrive_url }}" target="_blank" rel="noopener noreferrer"
                class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:border-green-200 transition-all duration-300 flex flex-col"
                data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ $i * 80 }}">

                <div class="flex items-start gap-4 mb-4">
                    <img src="{{ $pokja->logo ? asset('storage/' . $pokja->logo) : asset('images/no-photo.png') }}"
                        alt="{{ $pokja->name }}"
                        class="w-14 h-14 object-contain flex-shrink-0">
                    <h3 class="text-sm font-extrabold uppercase leading-snug pt-1" style="color:#1a5c2a;">
                        {{ $pokja->name }}
                    </h3>
                </div>

                <p class="text-sm text-gray-500 leading-relaxed flex-1">
                    {{ $pokja->description }}
                </p>

                <div class="mt-5 pt-4 border-t border-gray-100 flex items-center gap-2 text-xs font-semibold"
                    style="color:#e8521a;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span class="group-hover:underline">Lihat Dokumen di Google Drive</span>
                </div>
            </a>
            @endforeach
        </div>
        @endif

    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
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