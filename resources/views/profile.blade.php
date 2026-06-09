@extends('layouts.app')

@section('title', 'Profil - MTSN 7 Jember')

@section('content')

{{-- PAGE HEADER --}}
<section class="relative py-20 overflow-hidden"
    style="background: linear-gradient(135deg, #0f3d1a 0%, #1a5c2a 60%, #0f3d1a 100%);">
    {{-- Decorative circles --}}
    <div style="position:absolute;top:-40px;left:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-60px;right:8%;width:220px;height:220px;border-radius:50%;background:rgba(232,82,26,0.07);"></div>
    <div style="position:absolute;top:30%;left:30%;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,0.03);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="700">
        <span class="text-xs font-semibold uppercase tracking-widest" style="color:#f4a47a;">Tentang Kami</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mt-2 leading-tight">
            Profil <span style="color:#f4a47a;">Madrasah</span>
        </h1>
        <p class="text-green-200 text-sm md:text-base mt-4 max-w-xl mx-auto leading-relaxed">
            Mengenal lebih dekat MTsN 7 Jember — lembaga pendidikan Islam yang berdedikasi mencetak generasi unggul.
        </p>
        {{-- Breadcrumb --}}
        <div class="flex items-center justify-center gap-2 mt-6 text-xs text-green-300">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="text-green-600">/</span>
            <span class="text-white font-semibold">Profil</span>
        </div>
    </div>
</section>

{{-- IDENTITAS SEKOLAH --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex flex-col lg:flex-row gap-14 items-start">

            {{-- Logo + info singkat --}}
            <div class="lg:w-1/3 flex flex-col items-center lg:items-start text-center lg:text-left"
                data-aos="fade-right" data-aos-duration="700">
                <div class="relative mb-6">
                    <div class="absolute inset-0 rounded-full scale-110 opacity-10"
                        style="background: linear-gradient(135deg, #1a5c2a, #e8521a); border-radius: 9999px;"></div>
                    <img src="{{ asset('images/logo.png') }}" alt="Logo MTsN 7 Jember"
                        class="relative z-10 w-36 h-36 object-contain drop-shadow-lg">
                </div>
                <h2 class="text-xl font-extrabold leading-snug" style="color:#1a5c2a;">
                    {{ \App\Models\Setting::get('school_name', 'MTsN 7 Jember') }}
                </h2>
                <p class="text-xs text-gray-500 mt-1">Madrasah Tsanawiyah Negeri 7 Jember</p>

                <div class="mt-6 w-full space-y-3">
                    {{-- Alamat --}}
                    <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center"
                            style="background:#e8f5e9;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#1a5c2a;" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Alamat</p>
                            <p class="text-sm text-gray-700 leading-snug mt-0.5">
                                {{ \App\Models\Setting::get('address', '-') }}
                            </p>
                        </div>
                    </div>
                    {{-- Telepon --}}
                    <div class="flex items-center gap-3 bg-gray-50 rounded-xl p-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center"
                            style="background:#fff3e0;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#e8521a;" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Telepon</p>
                            <p class="text-sm text-gray-700 mt-0.5">{{ \App\Models\Setting::get('phone', '-') }}</p>
                        </div>
                    </div>
                    {{-- Email --}}
                    <div class="flex items-center gap-3 bg-gray-50 rounded-xl p-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center"
                            style="background:#e8f5e9;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#1a5c2a;" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Email</p>
                            <p class="text-sm text-gray-700 mt-0.5">{{ \App\Models\Setting::get('email', '-') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Visi & Misi --}}
            <div class="lg:w-2/3" data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">

                {{-- Visi --}}
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background: linear-gradient(135deg, #1a5c2a, #2d8a45);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-widest" style="color:#e8521a;">Visi</span>
                            <h3 class="text-lg font-bold" style="color:#1a5c2a;">Visi Madrasah</h3>
                        </div>
                    </div>
                    <div class="relative pl-6 py-5 pr-6 rounded-2xl border-l-4"
                        style="background:#f7faf8; border-color:#1a5c2a;">
                        <p class="text-gray-700 text-sm md:text-base leading-relaxed italic font-medium">
                            "Terwujudnya Insan yang Berakhlak Mulia, Berprestasi, Terampil, Peduli Lingkungan, dan Berwawasan Global Berlandaskan Nilai-Nilai Islam."
                        </p>
                    </div>
                </div>

                {{-- Misi --}}
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background: linear-gradient(135deg, #e8521a, #f47a3a);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-widest" style="color:#e8521a;">Misi</span>
                            <h3 class="text-lg font-bold" style="color:#1a5c2a;">Misi Madrasah</h3>
                        </div>
                    </div>
                    <div class="space-y-3">
                        @php
                        $misi = [
                            'Menyelenggarakan pendidikan agama Islam yang berkualitas untuk membentuk akhlak mulia dan karakter Islami pada setiap peserta didik.',
                            'Meningkatkan mutu pendidikan akademik dan non-akademik melalui pembelajaran inovatif, kreatif, dan berbasis teknologi.',
                            'Mengembangkan potensi, bakat, dan minat peserta didik melalui kegiatan ekstrakurikuler dan program unggulan madrasah.',
                            'Menciptakan lingkungan madrasah yang bersih, sehat, hijau, dan kondusif sebagai wujud kepedulian terhadap lingkungan.',
                            'Membangun kemitraan yang harmonis antara madrasah, orang tua, masyarakat, dan stakeholder untuk mendukung kemajuan pendidikan.',
                            'Mempersiapkan peserta didik untuk mampu bersaing di era global dengan membekali kemampuan berbahasa asing dan literasi digital.',
                        ];
                        @endphp

                        @foreach ($misi as $i => $item)
                        <div class="flex items-start gap-4 bg-white rounded-xl p-4 shadow-sm border border-gray-100 hover:shadow-md hover:border-green-200 transition-all duration-300"
                            data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ $i * 80 }}">
                            <div class="flex-shrink-0 w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs text-white"
                                style="background: linear-gradient(135deg, #1a5c2a, #2d8a45);">
                                {{ $i + 1 }}
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $item }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- PETA LOKASI --}}
@php $mapsEmbed = \App\Models\Setting::get('maps_embed'); @endphp
@if ($mapsEmbed)
<section class="py-20" style="background:#f7faf8;">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-10" data-aos="fade-up" data-aos-duration="600">
            <span class="text-xs font-semibold uppercase tracking-widest" style="color:#e8521a;">Lokasi</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-1" style="color:#1a5c2a;">Temukan Kami</h2>
            <p class="text-gray-500 text-sm mt-2">{{ \App\Models\Setting::get('address', '') }}</p>
        </div>
        <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100" data-aos="zoom-in" data-aos-duration="700">
            <iframe
                src="{{ $mapsEmbed }}"
                width="100%"
                height="420"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>
@endif

@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ once: true, easing: 'ease-out-cubic', offset: 60 });
</script>
@endpush
