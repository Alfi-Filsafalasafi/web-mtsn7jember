@extends('layouts.app')

@section('title', 'Beranda - MTSN 7 Jember')

@section('content')

{{-- PENGUMUMAN PENDAFTARAN PPDB — langsung setelah navbar --}}
<section class="ppdb-banner py-5" style="background: linear-gradient(90deg, #0f3d1a 0%, #1a5c2a 50%, #0f3d1a 100%); position: relative; overflow: hidden;">
    <div style="position:absolute;top:-30px;left:-30px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-40px;right:10%;width:160px;height:160px;border-radius:50%;background:rgba(232,82,26,0.08);"></div>
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4"
            data-aos="fade-down" data-aos-duration="600">
            <div class="flex items-center gap-3">
                <div class="relative flex-shrink-0">
                    <span class="ppdb-pulse-ring"></span>
                    <span class="ppdb-pulse-ring ppdb-pulse-ring--delay"></span>
                    <div class="relative z-10 w-9 h-9 rounded-full flex items-center justify-center font-bold text-white text-xs text-center leading-tight"
                        style="background: #e8521a;">!</div>
                </div>
                <div class="text-white">
                    <p class="font-semibold text-sm leading-tight">Penerimaan Peserta Didik Baru (PPDB) 2026</p>
                    <p class="text-green-300 text-xs mt-0.5">Daftarkan diri sekarang — kuota terbatas!</p>
                </div>
            </div>
            <a href="https://ppdb2026.mtsn7jember.sch.id/" target="_blank" rel="noopener"
                class="ppdb-cta-btn flex-shrink-0 flex items-center gap-2 px-5 py-2 rounded-lg font-semibold text-white text-xs transition"
                style="background: #e8521a;">
                Daftar Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- HERO --}}
<section id="hero" class="relative py-24 md:py-36 overflow-hidden">

    {{-- Slider background --}}
    <div class="hero-slider absolute inset-0 z-0">
        @for ($s = 1; $s <= 4; $s++)
            <div class="hero-slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 {{ $s === 1 ? 'opacity-100' : 'opacity-0' }}"
            style="background-image: url('{{ asset('images/slider/' . $s . '.jpg') }}');">
    </div>
    @endfor
    {{-- dark overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(15,40,20,0.78) 0%, rgba(26,92,42,0.65) 100%);"></div>
    </div>

    {{-- Slider dots --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-2">
        @for ($s = 1; $s <= 4; $s++)
            <button class="hero-dot w-2 h-2 rounded-full transition-all duration-300 {{ $s === 1 ? 'w-6 bg-white' : 'bg-white/40' }}"
            data-index="{{ $s - 1 }}"></button>
            @endfor
    </div>

    {{-- Content --}}
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="w-full" data-aos="fade-up" data-aos-duration="800">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-5 text-white">
                Selamat Datang di
                <span style="color: #f4a47a;">MTSN 7 Jember</span>
            </h1>
            <p class="text-green-100 text-base md:text-lg leading-relaxed mb-8">
                Mencetak generasi yang berakhlak mulia, berprestasi, dan berwawasan global berlandaskan nilai-nilai Islam.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="#konten-utama"
                    id="btn-selengkapnya"
                    class="px-7 py-3 rounded-lg font-semibold text-white text-sm transition hover:opacity-90 flex items-center gap-2"
                    style="background-color: #e8521a;">
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
                <a href="{{ route('contact') }}"
                    class="px-7 py-3 rounded-lg font-semibold text-white text-sm border border-white transition hover:bg-white hover:text-green-800">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Anchor untuk scroll --}}
<div id="konten-utama"></div>

{{-- STATS --}}
<section class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4">
            @foreach ([
            ['value' => '500+', 'label' => 'Siswa Aktif'],
            ['value' => $totalTeachers, 'label' => 'Guru & Staf'],
            ['value' => '17', 'label' => 'Ekstrakurikuler'],
            ['value' => 'A', 'label' => 'Akreditasi'],
            ] as $i => $stat)
            <div class="py-8 px-4 text-center {{ $i < 3 ? 'border-r border-gray-100' : '' }}"
                data-aos="zoom-in" data-aos-delay="{{ $i * 100 }}" data-aos-duration="600">
                <p class="text-3xl md:text-4xl font-extrabold" style="color: #1a5c2a;">{{ $stat['value'] }}</p>
                <p class="text-gray-500 text-sm mt-1">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PENGUMUMAN BERJALAN --}}
@if ($announcements->count())
<div style="background-color: #fff8f0; border-left: 4px solid #e8521a;" class="py-3">
    <div class="max-w-7xl mx-auto px-6 flex items-center gap-4 overflow-hidden">
        <span class="flex-shrink-0 font-bold text-sm" style="color: #e8521a;">Pengumuman :</span>
        <div class="overflow-hidden flex-1">
            <div id="marquee" class="flex gap-10 whitespace-nowrap">
                @foreach ($announcements as $ann)
                <a href="{{ route('articles.show', $ann->slug) }}"
                    class="text-sm hover:underline flex-shrink-0" style="color: #1a5c2a;">
                    {{ $ann->title }}
                </a>
                <span class="text-gray-300 flex-shrink-0">|</span>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

{{-- BERITA TERBARU --}}
{{-- BERITA TERBARU --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-end justify-between mb-10" data-aos="fade-up" data-aos-duration="600">
            <div>
                <span class="text-xs font-semibold uppercase tracking-widest" style="color: #e8521a;">Terkini</span>
                <h2 class="text-2xl md:text-3xl font-bold mt-1" style="color: #1a5c2a;">Berita & Kegiatan</h2>
            </div>
            <a href="{{ route('articles') }}" class="text-sm font-semibold flex items-center gap-1 hover:underline" style="color: #1a5c2a;">
                Lihat Semua &rarr;
            </a>
        </div>

        @if ($latestArticles->count())
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            {{-- Kiri: Featured (col-8) --}}
            @php $featured = $latestArticles->first(); @endphp
            <div class="lg:col-span-7" data-aos="fade-right" data-aos-duration="700">
                <a href="{{ route('articles.show', $featured->slug) }}"
                    class="group flex flex-col bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition h-full">
                    <div class="overflow-hidden bg-gray-100" style="height: 380px;">
                        @if ($featured->thumbnail)
                        <img src="{{ Storage::url($featured->thumbnail) }}" alt="{{ $featured->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-green-50">
                            <img src="{{ asset('images/logo.png') }}" class="h-20 opacity-20">
                        </div>
                        @endif
                    </div>
                    <div class="p-7 flex flex-col flex-1">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full"
                                style="{{ $featured->category === 'berita' ? 'background:#e8f5e9;color:#1a5c2a;' : 'background:#fff3e0;color:#e8521a;' }}">
                                {{ ucfirst($featured->category) }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $featured->published_at?->format('d M Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 leading-snug mb-3 group-hover:text-green-700 transition">
                            {{ $featured->title }}
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3">
                            {{ Str::limit(strip_tags($featured->body), 220) }}
                        </p>
                        <span class="mt-5 text-sm font-semibold inline-flex items-center gap-1" style="color:#1a5c2a;">
                            Baca Selengkapnya &rarr;
                        </span>
                    </div>
                </a>
            </div>

            {{-- Kanan: 3 artikel (col-4) --}}
            <div class="lg:col-span-5 flex flex-col gap-4">
                @foreach ($latestArticles->skip(1)->take(3) as $idx => $article)
                <a href="{{ route('articles.show', $article->slug) }}"
                    class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex"
                    data-aos="fade-left" data-aos-duration="600" data-aos-delay="{{ $idx * 100 }}">
                    {{-- Thumbnail --}}
                    <div class="flex-shrink-0 overflow-hidden bg-gray-100" style="width:110px; height:110px;">
                        @if ($article->thumbnail)
                        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-green-50">
                            <img src="{{ asset('images/logo.png') }}" class="h-8 opacity-20">
                        </div>
                        @endif
                    </div>
                    {{-- Konten --}}
                    <div class="p-3 flex flex-col justify-center flex-1 min-w-0">
                        <div class="flex items-center gap-1.5 mb-1 flex-wrap">
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full flex-shrink-0"
                                style="{{ $article->category === 'berita' ? 'background:#e8f5e9;color:#1a5c2a;' : 'background:#fff3e0;color:#e8521a;' }}">
                                {{ ucfirst($article->category) }}
                            </span>
                            <span class="text-xs text-gray-400 flex-shrink-0">{{ $article->published_at?->format('d M Y') }}</span>
                        </div>
                        <h3 class="font-semibold text-gray-800 leading-snug text-sm group-hover:text-green-700 transition line-clamp-3">
                            {{ $article->title }}
                        </h3>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
        @else
        <div class="text-center py-16 text-gray-400">Belum ada berita.</div>
        @endif
    </div>
</section>

{{-- KELAS UNGGULAN --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="600">
            <span class="text-xs font-semibold uppercase tracking-widest" style="color: #e8521a;">Program Unggulan</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-1" style="color: #1a5c2a;">Kelas Unggulan</h2>
            <p class="text-gray-500 text-sm mt-2 max-w-xl mx-auto">Program kelas khusus yang dirancang untuk mengembangkan potensi terbaik setiap siswa.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $kelasUnggulan = [
            ['nama' => 'Kelas Olimpiade', 'desc' => 'Menggembleng siswa berprestasi akademik tinggi untuk kompetisi sains & olimpiade nasional.', 'icon' => '🏆', 'img' => 'images/kelas-olimpiade.jpeg', 'color' => '#1a5c2a'],
            ['nama' => 'Kelas Cabor', 'desc' => 'Pembinaan atlet muda berprestasi di bidang olahraga untuk kompetisi daerah hingga nasional.', 'icon' => '⚽', 'img' => 'images/kelas-cabor.jpeg', 'color' => '#c8961a'],
            ['nama' => 'Kelas Tahfidz', 'desc' => 'Program hafalan Al-Qur\'an dengan bimbingan intensif dari pengajar tahfidz berpengalaman.', 'icon' => '📖', 'img' => 'images/kelas-tahfidz.jpeg', 'color' => '#1a5c2a'],
            ['nama' => 'Kelas Bilingual', 'desc' => 'Pembelajaran bilingual (Indonesia-Inggris/Arab) untuk mempersiapkan siswa berwawasan global.', 'icon' => '🌐', 'img' => 'images/kelas-bilingual.jpeg', 'color' => '#e8521a'],
            ];
            @endphp

            @foreach ($kelasUnggulan as $idx => $kelas)
            <div class="kelas-card group relative rounded-2xl overflow-hidden cursor-pointer"
                style="height: 320px; background: #1a2a1e;"
                data-aos="fade-up" data-aos-duration="700" data-aos-delay="{{ $idx * 120 }}">
                <div class="kelas-bg absolute inset-0 bg-cover bg-center transition-transform duration-700"
                    style="background-image: url('{{ asset($kelas['img']) }}'); filter: brightness(0.45);"></div>
                <div class="absolute inset-0 transition-opacity duration-500"
                    style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);"></div>
                <div class="kelas-overlay absolute inset-0 opacity-0 group-hover:opacity-30 transition-opacity duration-500"
                    style="background: {{ $kelas['color'] }};"></div>
                <div class="relative z-10 h-full flex flex-col justify-end p-6 text-white">
                    <span class="text-3xl mb-3 block">{{ $kelas['icon'] }}</span>
                    <h3 class="font-extrabold text-lg leading-tight mb-2">{{ $kelas['nama'] }}</h3>
                    <p class="text-gray-300 text-xs leading-relaxed kelas-desc opacity-0 group-hover:opacity-100 transition-all duration-500 max-h-0 group-hover:max-h-20 overflow-hidden">
                        {{ $kelas['desc'] }}
                    </p>
                    <div class="kelas-line mt-3 h-0.5 w-8 rounded-full transition-all duration-500 group-hover:w-16"
                        style="background: {{ $kelas['color'] }};"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- EKSTRAKULIKULER --}}
<section class="py-20" style="background: #f7faf8;">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="600">
            <span class="text-xs font-semibold uppercase tracking-widest" style="color: #e8521a;">Pengembangan Diri</span>
            <h2 class="text-2xl md:text-3xl font-bold mt-1" style="color: #1a5c2a;">Ekstrakulikuler</h2>
            <p class="text-gray-500 text-sm mt-2 max-w-xl mx-auto">17 pilihan kegiatan untuk mengembangkan bakat dan minat siswa di luar pembelajaran.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @php
            $ekskul = [
            ['no' => 1, 'nama' => 'Pramuka (Artsatu)', 'icon' => '⛺'],
            ['no' => 2, 'nama' => 'PMR (Palang Merah Remaja)', 'icon' => '🩺'],
            ['no' => 3, 'nama' => 'Jurnalistik', 'icon' => '📰'],
            ['no' => 4, 'nama' => 'Seni Musik', 'icon' => '🎵'],
            ['no' => 5, 'nama' => 'Hadrah', 'icon' => '🥁'],
            ['no' => 6, 'nama' => 'Paduan Suara', 'icon' => '🎤'],
            ['no' => 7, 'nama' => 'Sepakbola', 'icon' => '⚽'],
            ['no' => 8, 'nama' => 'Bola Voli', 'icon' => '🏐'],
            ['no' => 9, 'nama' => 'Tenis Meja', 'icon' => '🏓'],
            ['no' => 10, 'nama' => 'Bulutangkis', 'icon' => '🏸'],
            ['no' => 11, 'nama' => 'Kaligrafi', 'icon' => '✍️'],
            ['no' => 12, 'nama' => 'Tartil Al-Qur\'an', 'icon' => '📖'],
            ['no' => 13, 'nama' => 'Komunitas Bahasa Inggris', 'icon' => '🇬🇧'],
            ['no' => 14, 'nama' => 'Komunitas Bahasa Arab', 'icon' => '🌙'],
            ['no' => 15, 'nama' => 'Robotik', 'icon' => '🤖'],
            ['no' => 16, 'nama' => 'Komputer', 'icon' => '💻'],
            ['no' => 17, 'nama' => 'Tim Mobile Legends', 'icon' => '🎮'],
            ];
            @endphp

            @foreach ($ekskul as $idx => $e)
            <div class="ekskul-card group bg-white rounded-xl p-4 text-center shadow-sm cursor-pointer border-2 border-transparent hover:border-green-500 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg"
                data-aos="zoom-in" data-aos-duration="500" data-aos-delay="{{ ($idx % 6) * 60 }}">
                <div class="ekskul-icon text-3xl mb-2 transition-transform duration-300 group-hover:scale-125 inline-block">{{ $e['icon'] }}</div>
                <p style="font-size: 16px;" class="text-xs font-semibold text-gray-700 leading-snug group-hover:text-green-700 transition-colors">{{ $e['nama'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SAMBUTAN KEPALA MADRASAH --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="flex-shrink-0 text-center" data-aos="fade-right" data-aos-duration="700">
                <div class="relative inline-block">
                    <div class="absolute inset-0 rounded-full scale-110"
                        style="background: linear-gradient(135deg, #1a5c2a, #e8521a); opacity: 0.15; border-radius: 9999px;"></div>
                    <img src="{{ asset('images/kepala_madrasah.jpeg') }}"
                        alt="Kepala Madrasah MTSN 7 Jember"
                        class="relative z-10 w-52 h-52 rounded-full object-cover object-top shadow-xl border-4 border-white"
                        style="box-shadow: 0 0 0 4px #1a5c2a30, 0 16px 40px rgba(0,0,0,0.15);">
                </div>
                <div class="mt-4">
                    <p class="font-extrabold text-base" style="color:#1a5c2a;">
                        {{ \App\Models\Setting::get('principal_name', 'Nama Kepala Madrasah') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-0.5">Kepala MTsN 7 Jember</p>
                </div>
            </div>

            <div class="flex-1" data-aos="fade-left" data-aos-duration="700" data-aos-delay="150">
                <span class="text-xs font-semibold uppercase tracking-widest" style="color: #e8521a;">Sambutan</span>
                <h2 class="text-2xl md:text-3xl font-bold mt-1 mb-5" style="color: #1a5c2a;">Kepala Madrasah</h2>
                <div class="relative pl-6">
                    <div class="absolute left-0 top-0 bottom-0 w-1 rounded-full" style="background: linear-gradient(to bottom, #1a5c2a, #e8521a);"></div>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base italic">
                        "{{ \App\Models\Setting::get('sambutan_kepala', 'Assalamu\'alaikum Wr. Wb. Selamat datang di website resmi MTsN 7 Jember. Kami berkomitmen untuk mencetak generasi penerus bangsa yang berakhlak mulia, berprestasi tinggi, dan berwawasan global, berlandaskan nilai-nilai Islam yang kuat. Semoga website ini bermanfaat bagi seluruh sivitas akademika dan masyarakat luas.') }}"
                    </p>
                </div>
                <div class="mt-6 flex items-center gap-2">
                    <span class="w-8 h-0.5 rounded-full" style="background:#e8521a;"></span>
                    <span class="text-xs text-gray-400 font-medium">MTsN 7 Jember</span>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.zi-banner-modal')

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

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    #marquee {
        animation: marquee 25s linear infinite;
    }

    /* ── Hero Slider ── */
    .hero-slide {
        will-change: opacity;
    }

    /* ── PPDB Banner ── */
    @keyframes ppdb-pulse {
        0% {
            transform: scale(1);
            opacity: 0.6;
        }

        70% {
            transform: scale(1.9);
            opacity: 0;
        }

        100% {
            transform: scale(1.9);
            opacity: 0;
        }
    }

    @keyframes live-blink {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.3;
        }
    }

    .ppdb-pulse-ring {
        position: absolute;
        inset: 0;
        border-radius: 9999px;
        border: 2px solid #e8521a;
        animation: ppdb-pulse 2s ease-out infinite;
    }

    .ppdb-pulse-ring--delay {
        animation-delay: 0.6s;
    }

    .ppdb-live-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #e8521a;
        animation: live-blink 1.4s ease-in-out infinite;
    }

    .ppdb-cta-btn:hover {
        background: #c73f0f !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(232, 82, 26, 0.45);
    }

    /* ── Kelas Unggulan ── */
    .kelas-card:hover .kelas-bg {
        transform: scale(1.08);
        filter: brightness(0.55);
    }

    /* ── Ekskul ── */
    .ekskul-card:hover {
        background: linear-gradient(135deg, #f0faf2, #fff) !important;
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

    // ── Hero Slider ──
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    let current = 0;

    function goTo(idx) {
        slides[current].classList.remove('opacity-100');
        slides[current].classList.add('opacity-0');
        dots[current].classList.remove('w-6', 'bg-white');
        dots[current].classList.add('bg-white/40');

        current = idx;

        slides[current].classList.remove('opacity-0');
        slides[current].classList.add('opacity-100');
        dots[current].classList.remove('bg-white/40');
        dots[current].classList.add('w-6', 'bg-white');
    }

    dots.forEach((dot, i) => dot.addEventListener('click', () => {
        clearInterval(timer);
        goTo(i);
        timer = setInterval(() => goTo((current + 1) % slides.length), 4000);
    }));

    let timer = setInterval(() => goTo((current + 1) % slides.length), 4000);

    // ── Scroll smooth untuk tombol Selengkapnya ──
    document.getElementById('btn-selengkapnya').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('konten-utama').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>
@endpush