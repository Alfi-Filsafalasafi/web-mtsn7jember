@extends('layouts.app')

@section('title', 'Laporan-Laporan ZI - Zona Integritas - MTSN 7 Jember')

@section('content')

{{-- PAGE HEADER --}}
<section class="relative py-20 overflow-hidden"
    style="background: linear-gradient(135deg, #0f3d1a 0%, #1a5c2a 60%, #0f3d1a 100%);">
    <div style="position:absolute;top:-40px;left:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-60px;right:8%;width:220px;height:220px;border-radius:50%;background:rgba(232,82,26,0.07);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="700">
        <span class="text-xs font-semibold uppercase tracking-widest" style="color:#f4a47a;">Zona Integritas</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mt-2 leading-tight">
            Laporan-<span style="color:#f4a47a;">Laporan</span>
        </h1>
        <p class="text-green-200 text-sm md:text-base mt-4 max-w-xl mx-auto leading-relaxed">
            Kumpulan laporan capaian kinerja dan dokumen resmi dalam pelaksanaan Zona Integritas.
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 text-xs text-green-300">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="text-green-600">/</span>
            <span class="text-green-100">Zona Integritas</span>
            <span class="text-green-600">/</span>
            <span class="text-white font-semibold">Laporan-Laporan</span>
        </div>
    </div>
</section>

{{-- LIST LAPORAN --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6">

        @if ($laporans->isEmpty())
        <div class="text-center py-16">
            <p class="text-gray-400 text-sm">Belum ada laporan yang ditambahkan.</p>
        </div>
        @else
        <div class="space-y-6">
            @foreach ($laporans as $i => $laporan)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300"
                data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ $i * 80 }}">
                <div class="flex flex-col sm:flex-row">

                    {{-- Logo + badge tanggal --}}
                    <div class="relative sm:w-56 flex-shrink-0 p-6 flex items-center justify-center bg-gray-50">
                        <img src="{{ $laporan->logo ? asset('storage/' . $laporan->logo) : asset('images/no-photo.png') }}"
                            alt="{{ $laporan->title }}"
                            class="w-32 h-32 object-contain">

                        <span class="absolute bottom-4 left-4 text-xs font-semibold text-white px-3 py-1 rounded-md"
                            style="background:#1a5c2a;">
                            {{ \Carbon\Carbon::parse($laporan->display_date)->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    {{-- Konten --}}
                    <div class="p-6 flex-1 flex flex-col justify-center">
                        <h3 class="text-lg font-bold" style="color:#1a5c2a;">
                            {{ $laporan->title }}
                        </h3>
                        <p class="text-sm mt-1.5 leading-relaxed" style="color:#2d8a45;">
                            {{ $laporan->description }}
                        </p>

                        <div class="mt-4">
                            <a href="{{ asset('storage/' . $laporan->file) }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white transition hover:opacity-90"
                                style="background:#1a5c2a;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0l-4-4m4 4l4-4M4 20h16" />
                                </svg>
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>

                </div>
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
