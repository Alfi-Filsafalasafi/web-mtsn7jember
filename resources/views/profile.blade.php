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

                <div class="mt-6 w-full space-y-3 text-left">
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
                    {{-- NPSN --}}
                    <div class="flex items-center gap-3 bg-gray-50 rounded-xl p-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center"
                            style="background:#e8f5e9;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#1a5c2a;" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">NPSN</p>
                            <p class="text-sm text-gray-700 mt-0.5">{{ \App\Models\Setting::get('npsn', '-') }}</p>
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

                    {{-- Media Sosial --}}
                    @php
                    $facebook = \App\Models\Setting::get('facebook_url');
                    $instagram = \App\Models\Setting::get('instagram_url');
                    $tiktok = \App\Models\Setting::get('tiktok_url');
                    $youtube = \App\Models\Setting::get('youtube_url');
                    @endphp
                    @if ($facebook || $instagram || $tiktok || $youtube)
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Media Sosial</p>
                        <div class="flex items-center gap-3">
                            @if ($facebook)
                            <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer"
                                class="w-9 h-9 rounded-lg flex items-center justify-center transition hover:opacity-80"
                                style="background:#1877F2;"
                                aria-label="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                                </svg>
                            </a>
                            @endif
                            @if ($instagram)
                            <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer"
                                class="w-9 h-9 rounded-lg flex items-center justify-center transition hover:opacity-80"
                                style="background: linear-gradient(135deg, #f9ce34, #ee2a7b, #6228d7);"
                                aria-label="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            @endif
                            @if ($tiktok)
                            <a href="{{ $tiktok }}" target="_blank" rel="noopener noreferrer"
                                class="w-9 h-9 rounded-lg flex items-center justify-center transition hover:opacity-80"
                                style="background:#111827;"
                                aria-label="TikTok">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.58.07-5.37.01-4.03-.01-8.05.02-12.07z" />
                                </svg>
                            </a>
                            @endif
                            @if ($youtube)
                            <a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer"
                                class="w-9 h-9 rounded-lg flex items-center justify-center transition hover:opacity-80"
                                style="background:#ff0000;"
                                aria-label="YouTube">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a2.994 2.994 0 00-2.107-2.117C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.391.524A2.994 2.994 0 00.502 6.186 31.32 31.32 0 000 12a31.32 31.32 0 00.502 5.814 2.994 2.994 0 002.107 2.117c1.886.524 9.391.524 9.391.524s7.505 0 9.391-.524a2.994 2.994 0 002.107-2.117A31.32 31.32 0 0024 12a31.32 31.32 0 00-.502-5.814zM9.75 15.568V8.432L15.818 12l-6.068 3.568z" />
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
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
                            "Terwujudnya Insan yang beriman, berilmu, bermoral, kompetitif, berwawasan global dan peduli lingkungan"
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
                        'Menumbuhkan penghayatan terhadap ajaran agama dan budaya bangsa sehingga terbangun siswa yang berkompeten dan berakhlak mulia.',
                        'Menumbuhkan penghayatan terhadap ajaran agama dan budaya bangsa sehingga terbangun siswa yang berkompeten dan berakhlak mulia.',
                        'Melaksanakan dan mengembangkan system pendidikan dan pengajaran sesuai kebutuhan.',
                        'Melakukan pengembangan metode dan strategi pembelajaran.',
                        'Mendorong setiap usaha peningkatan mutu madrasah, akademik dannon akademik.',
                        'Meningkatkan kualitas kinerja tenaga pendidik dan kependidikan.',
                        'Melengkapi penyediaan sarana dan prasarana belajar mengajar sesuai dengan kebutuhan dan perkembangan ilmu pengetahuan.',
                        'Mewujudkan kesadaran warga madrasah untuk peduli lingkugan.',
                        'Meningkatkan budaya literasi warga madrasah.'
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
    AOS.init({
        once: true,
        easing: 'ease-out-cubic',
        offset: 60
    });
</script>
@endpush