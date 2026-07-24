@extends('layouts.app')

@section('title', 'Wadul Gus Dar - MTSN 7 Jember')

@section('content')

{{-- PAGE HEADER --}}
<section class="relative py-20 overflow-hidden"
    style="background: linear-gradient(135deg, #0f3d1a 0%, #1a5c2a 60%, #0f3d1a 100%);">
    <div style="position:absolute;top:-40px;left:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-60px;right:8%;width:220px;height:220px;border-radius:50%;background:rgba(232,82,26,0.07);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="700">
        <span class="text-xs font-semibold uppercase tracking-widest" style="color:#f4a47a;">Layanan Aspirasi</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mt-2 leading-tight">
            Wadul <span style="color:#f4a47a;">Gus Dar</span>
        </h1>
        <p class="text-green-200 text-sm md:text-base mt-4 max-w-xl mx-auto leading-relaxed">
            Sampaikan pengaduan, curhat, atau saran Anda kepada Gus Dar. Boleh anonim, akan ditindaklanjuti dengan penuh kerahasiaan.
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 text-xs text-green-300">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="text-green-600">/</span>
            <span class="text-white font-semibold">Wadul Gus Dar</span>
        </div>
    </div>
</section>

{{-- KONTEN --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-3xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-sm p-7 md:p-10" data-aos="fade-up" data-aos-duration="700">

            <div class="mb-7">
                <span class="text-xs font-semibold uppercase tracking-widest" style="color:#e8521a;">Form Wadul</span>
                <h2 class="text-xl font-bold mt-1" style="color:#1a5c2a;">Sampaikan Wadul Anda</h2>
                <p class="text-gray-400 text-sm mt-1">Isi formulir di bawah, identitas Anda akan kami jaga kerahasiaannya.</p>
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

            <form action="{{ route('wadul-gusdar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5" id="wadul-form">
                @csrf

                {{-- Jenis Wadul --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Jenis Wadul <span style="color:#e8521a;">*</span>
                    </label>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach ([
                        'pengaduan' => 'Pengaduan',
                        'curhat' => 'Curhat',
                        'saran' => 'Saran',
                        ] as $value => $label)
                        <label class="flex items-center justify-center gap-2 border border-gray-200 rounded-lg py-2.5 cursor-pointer text-sm font-medium text-gray-600 transition">
                            <input type="radio" name="type" value="{{ $value }}" class="hidden"
                                {{ old('type') === $value ? 'checked' : '' }} required>
                            <span>{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Peran Pengisi --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                            Anda Sebagai <span style="color:#e8521a;">*</span>
                        </label>
                        <select name="pengisi_role" required
                            class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition"
                            style="--tw-ring-color:#1a5c2a;">
                            <option value="">-- Pilih Peran --</option>
                            <option value="siswa" {{ old('pengisi_role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="guru" {{ old('pengisi_role') === 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="wali_murid" {{ old('pengisi_role') === 'wali_murid' ? 'selected' : '' }}>Wali Murid</option>
                            <option value="masyarakat" {{ old('pengisi_role') === 'masyarakat' ? 'selected' : '' }}>Masyarakat Umum</option>
                        </select>
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

                {{-- Anonim --}}
                <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-4 py-3">
                    <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1"
                        {{ old('is_anonymous') ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-gray-300 text-green-700 focus:ring-green-600">
                    <label for="is_anonymous" class="text-sm text-gray-700">
                        Isi sebagai <span class="font-semibold">anonim</span> (nama tidak akan dicantumkan)
                    </label>
                </div>

                {{-- Nama --}}
                <div id="name-field">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        placeholder="Nama Anda"
                        class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition"
                        style="--tw-ring-color:#1a5c2a;">
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Keterangan <span style="color:#e8521a;">*</span>
                    </label>
                    <textarea name="message" rows="5" required
                        placeholder="Sampaikan pengaduan, curhat, atau saran Anda di sini..."
                        class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition resize-none"
                        style="--tw-ring-color:#1a5c2a;">{{ old('message') }}</textarea>
                </div>

                {{-- Lampiran --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Lampiran Foto <span class="text-gray-400 font-normal">(opsional, maks. 2MB)</span>
                    </label>
                    <input type="file" name="attachment" accept="image/*"
                        class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-lg font-semibold text-sm text-white transition hover:opacity-90 flex items-center justify-center gap-2"
                    style="background:#e8521a;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Kirim Wadul
                </button>

                <p class="text-xs text-gray-400 text-center leading-relaxed">
                    Kerahasiaan identitas Anda kami jaga. Wadul ini akan diterima dan ditindaklanjuti langsung oleh Gus Dar.
                </p>
            </form>
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
    AOS.init({
        once: true,
        easing: 'ease-out-cubic',
        offset: 60
    });

    // Toggle field Nama saat checkbox anonim dicentang
    const isAnonymous = document.getElementById('is_anonymous');
    const nameField = document.getElementById('name-field');
    const nameInput = document.getElementById('name');

    function toggleNameField() {
        if (isAnonymous.checked) {
            nameField.style.display = 'none';
            nameInput.value = '';
        } else {
            nameField.style.display = 'block';
        }
    }

    isAnonymous.addEventListener('change', toggleNameField);
    toggleNameField();

    // Styling radio Jenis Wadul saat dipilih
    const radioInputs = document.querySelectorAll('input[name="type"]');

    function updateRadioStyle() {
        radioInputs.forEach(radio => {
            const label = radio.closest('label');
            if (radio.checked) {
                label.style.background = '#1a5c2a';
                label.style.color = '#fff';
                label.style.borderColor = 'transparent';
            } else {
                label.style.background = '';
                label.style.color = '';
                label.style.borderColor = '';
            }
        });
    }
    radioInputs.forEach(radio => radio.addEventListener('change', updateRadioStyle));
    updateRadioStyle();
</script>
@endpush