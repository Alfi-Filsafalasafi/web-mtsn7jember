@extends('layouts.app')

@section('title', 'Survei - Zona Integritas - MTSN 7 Jember')

@section('content')

{{-- PAGE HEADER --}}
<section class="relative py-20 overflow-hidden"
    style="background: linear-gradient(135deg, #0f3d1a 0%, #1a5c2a 60%, #0f3d1a 100%);">
    <div style="position:absolute;top:-40px;left:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-60px;right:8%;width:220px;height:220px;border-radius:50%;background:rgba(232,82,26,0.07);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="700">
        <span class="text-xs font-semibold uppercase tracking-widest" style="color:#f4a47a;">Zona Integritas</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mt-2 leading-tight">
            Survei
        </h1>
        <p class="text-green-200 text-sm md:text-base mt-4 max-w-xl mx-auto leading-relaxed">
            Berpartisipasilah dalam survei kami untuk membantu peningkatan kualitas layanan madrasah.
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 text-xs text-green-300">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="text-green-600">/</span>
            <span class="text-green-100">Zona Integritas</span>
            <span class="text-green-600">/</span>
            <span class="text-white font-semibold">Survei</span>
        </div>
    </div>
</section>

{{-- LIST SURVEI --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">

        @if ($surveis->isEmpty())
        <div class="text-center py-16">
            <p class="text-gray-400 text-sm">Belum ada survei yang tersedia saat ini.</p>
        </div>
        @else
        <div class="space-y-5">
            @foreach ($surveis as $i => $survei)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-7 flex flex-col md:flex-row md:items-center gap-5 hover:shadow-md transition-all duration-300"
                data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ $i * 80 }}">

                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                    style="background: linear-gradient(135deg, #1a5c2a, #2d8a45);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>

                <div class="flex-1">
                    <h3 class="text-base font-bold" style="color:#1a5c2a;">
                        {{ $survei->name }}
                    </h3>
                    <p class="text-sm text-gray-500 leading-relaxed mt-1">
                        {{ $survei->description }}
                    </p>
                </div>

                <a href="{{ $survei->link }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white transition hover:opacity-90 flex-shrink-0"
                    style="background:#e8521a;">
                    Isi Survei
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>

            </div>
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
