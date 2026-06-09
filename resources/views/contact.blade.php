@extends('layouts.app')

@section('title', 'Hubungi Kami - MTSN 7 Jember')

@section('content')

{{-- PAGE HEADER --}}
<section class="relative py-20 overflow-hidden"
    style="background: linear-gradient(135deg, #0f3d1a 0%, #1a5c2a 60%, #0f3d1a 100%);">
    <div style="position:absolute;top:-40px;left:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-60px;right:8%;width:220px;height:220px;border-radius:50%;background:rgba(232,82,26,0.07);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="700">
        <span class="text-xs font-semibold uppercase tracking-widest" style="color:#f4a47a;">Kami Siap Membantu</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mt-2 leading-tight">
            Hubungi <span style="color:#f4a47a;">Kami</span>
        </h1>
        <p class="text-green-200 text-sm md:text-base mt-4 max-w-xl mx-auto leading-relaxed">
            Punya pertanyaan atau ingin mengetahui lebih lanjut? Kirimkan pesan dan kami akan segera merespons.
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 text-xs text-green-300">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="text-green-600">/</span>
            <span class="text-white font-semibold">Hubungi Kami</span>
        </div>
    </div>
</section>

{{-- KONTEN --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- Info Kontak --}}
            <div class="lg:w-2/5" data-aos="fade-right" data-aos-duration="700">

                {{-- Info cards --}}
                <div class="space-y-4 mb-8">
                    {{-- Alamat --}}
                    <div class="bg-white rounded-2xl p-5 shadow-sm flex items-start gap-4 hover:shadow-md transition">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background:linear-gradient(135deg,#1a5c2a,#2d8a45);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 mb-1">Alamat</p>
                            <p class="text-sm text-gray-700 leading-relaxed">
                                {{ \App\Models\Setting::get('address', '-') }}
                            </p>
                        </div>
                    </div>

                    {{-- Telepon --}}
                    <div class="bg-white rounded-2xl p-5 shadow-sm flex items-start gap-4 hover:shadow-md transition">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background:linear-gradient(135deg,#e8521a,#f47a3a);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 mb-1">Telepon</p>
                            <a href="tel:{{ \App\Models\Setting::get('phone') }}"
                                class="text-sm font-semibold transition hover:underline" style="color:#1a5c2a;">
                                {{ \App\Models\Setting::get('phone', '-') }}
                            </a>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="bg-white rounded-2xl p-5 shadow-sm flex items-start gap-4 hover:shadow-md transition">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background:linear-gradient(135deg,#1a5c2a,#2d8a45);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 mb-1">Email</p>
                            <a href="mailto:{{ \App\Models\Setting::get('email') }}"
                                class="text-sm font-semibold transition hover:underline" style="color:#1a5c2a;">
                                {{ \App\Models\Setting::get('email', '-') }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Maps embed --}}
                @php $mapsEmbed = \App\Models\Setting::get('maps_embed'); @endphp
                @if ($mapsEmbed)
                <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                    <iframe src="{{ $mapsEmbed }}" width="100%" height="240"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                @endif
            </div>

            {{-- Form --}}
            <div class="lg:w-3/5" data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
                <div class="bg-white rounded-2xl shadow-sm p-7 md:p-10">
                    <div class="mb-7">
                        <span class="text-xs font-semibold uppercase tracking-widest" style="color:#e8521a;">Form Kontak</span>
                        <h2 class="text-xl font-bold mt-1" style="color:#1a5c2a;">Kirim Pesan</h2>
                        <p class="text-gray-400 text-sm mt-1">Isi formulir di bawah dan tim kami akan segera menghubungi Anda.</p>
                    </div>

                    {{-- Notifikasi sukses --}}
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

                    {{-- Notifikasi error --}}
                    @if ($errors->any())
                    <div class="mb-6 px-4 py-4 rounded-xl text-sm" style="background:#fff3e0;color:#e8521a;">
                        <p class="font-semibold mb-1">Periksa kembali:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            {{-- Nama --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                    Nama Lengkap <span style="color:#e8521a;">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Nama Anda"
                                    class="w-full px-4 py-2.5 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:border-transparent transition
                                    {{ $errors->has('name') ? 'border-red-300' : 'border-gray-200' }}"
                                    style="--tw-ring-color:#1a5c2a;">
                            </div>

                            {{-- No. Telepon --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                    No. Telepon
                                </label>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    placeholder="08xxxxxxxxxx (opsional)"
                                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition"
                                    style="--tw-ring-color:#1a5c2a;">
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                Email <span style="color:#e8521a;">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="email@contoh.com"
                                class="w-full px-4 py-2.5 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:border-transparent transition
                                {{ $errors->has('email') ? 'border-red-300' : 'border-gray-200' }}"
                                style="--tw-ring-color:#1a5c2a;">
                        </div>

                        {{-- Pesan --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                Pesan <span style="color:#e8521a;">*</span>
                            </label>
                            <textarea name="message" rows="5"
                                placeholder="Tulis pesan Anda di sini..."
                                class="w-full px-4 py-2.5 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:border-transparent transition resize-none
                                {{ $errors->has('message') ? 'border-red-300' : 'border-gray-200' }}"
                                style="--tw-ring-color:#1a5c2a;">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-3 rounded-lg font-semibold text-sm text-white transition hover:opacity-90 flex items-center justify-center gap-2"
                            style="background:#e8521a;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

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
</script>
@endpush
