@extends('layouts.app')

@section('title', 'Buat Artikel Literasi - MTSN 7 Jember')

@section('content')

{{-- PAGE HEADER --}}
<section class="relative py-20 overflow-hidden"
    style="background: linear-gradient(135deg, #0f3d1a 0%, #1a5c2a 60%, #0f3d1a 100%);">
    <div style="position:absolute;top:-40px;left:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-60px;right:8%;width:220px;height:220px;border-radius:50%;background:rgba(232,82,26,0.07);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="700">
        <span class="text-xs font-semibold uppercase tracking-widest" style="color:#f4a47a;">Literasi</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mt-2 leading-tight">
            Buat <span style="color:#f4a47a;">Artikel</span>
        </h1>
        <p class="text-green-200 text-sm md:text-base mt-4 max-w-xl mx-auto leading-relaxed">
            Tuangkan gagasanmu sesuai tema bulan ini. Tulisan harus karya asli, bukan hasil AI sepenuhnya.
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 text-xs text-green-300">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="text-green-600">/</span>
            <a href="{{ route('literasi') }}" class="hover:text-white transition">Literasi</a>
            <span class="text-green-600">/</span>
            <span class="text-white font-semibold">Buat Artikel</span>
        </div>
    </div>
</section>

{{-- KONTEN --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-3xl mx-auto px-6">

        {{-- Tema aktif info --}}
        @if ($temaAktif)
        <div style="background-color: #fff8f0; border-left: 4px solid #e8521a;" class="rounded-xl p-5 mb-6"
            data-aos="fade-up" data-aos-duration="600">
            <span class="text-xs font-bold uppercase tracking-widest" style="color:#e8521a;">
                Tema {{ $temaAktif->nama_bulan }} {{ $temaAktif->tahun }}
            </span>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-2">
                <div>
                    <p class="text-xs text-gray-400 font-semibold">Tema untuk Guru</p>
                    <p class="text-gray-800 text-sm font-bold">{{ $temaAktif->tema_guru }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-semibold">Tema untuk Siswa</p>
                    <p class="text-gray-800 text-sm font-bold">{{ $temaAktif->tema_siswa }}</p>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm p-7 md:p-10" data-aos="fade-up" data-aos-duration="700">

            <div class="mb-7">
                <span class="text-xs font-semibold uppercase tracking-widest" style="color:#e8521a;">Form Literasi</span>
                <h2 class="text-xl font-bold mt-1" style="color:#1a5c2a;">Isi Artikel Kamu</h2>
                <p class="text-gray-400 text-sm mt-1">Lengkapi formulir di bawah dengan data yang benar.</p>
            </div>

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

            <form action="{{ route('literasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5" id="literasi-form">
                @csrf

                {{-- Tema Bulanan --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                        Tema Bulanan <span style="color:#e8521a;">*</span>
                    </label>
                    @if ($temasAktif->isNotEmpty())
                    <select name="literasi_tema_id" required
                        class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition"
                        style="--tw-ring-color:#1a5c2a;">
                        @foreach ($temasAktif as $tema)
                        <option value="{{ $tema->id }}"
                            {{ (old('literasi_tema_id') ?? $temaAktif?->id) == $tema->id ? 'selected' : '' }}>
                            {{ $tema->nama_bulan }} {{ $tema->tahun }}
                        </option>
                        @endforeach
                    </select>
                    @else
                    <div class="px-4 py-2.5 text-sm rounded-lg border border-dashed border-gray-200 text-gray-400">
                        Belum ada tema aktif bulan ini, hubungi admin.
                    </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Tipe Penulis --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                            Kamu Sebagai <span style="color:#e8521a;">*</span>
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach (['siswa' => 'Siswa', 'guru' => 'Guru'] as $value => $label)
                            <label class="flex items-center justify-center gap-2 border border-gray-200 rounded-lg py-2.5 cursor-pointer text-sm font-medium text-gray-600 transition tipe-radio-label">
                                <input type="radio" name="tipe" value="{{ $value }}" class="hidden"
                                    {{ old('tipe') === $value ? 'checked' : '' }} required>
                                <span>{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Nama Penulis --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                            Nama Penulis <span style="color:#e8521a;">*</span>
                        </label>
                        <input type="text" name="nama_penulis" value="{{ old('nama_penulis') }}"
                            placeholder="Nama lengkap kamu"
                            class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition"
                            style="--tw-ring-color:#1a5c2a;">
                    </div>
                </div>

                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                        Judul Literasi <span style="color:#e8521a;">*</span>
                    </label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                        placeholder="Judul artikel kamu"
                        class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition"
                        style="--tw-ring-color:#1a5c2a;">
                </div>

                {{-- Slug --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                        Slug URL <span style="color:#e8521a;">*</span>
                    </label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                        placeholder="otomatis-dari-judul"
                        class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition font-mono"
                        style="--tw-ring-color:#1a5c2a;">
                    <p class="text-xs text-gray-400 mt-1.5">Otomatis terisi dari judul, boleh diedit kalau perlu. Dipakai untuk URL artikel.</p>
                </div>

                {{-- Thumbnail --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                        Foto Sampul <span class="text-gray-400 font-normal">(opsional, maks. 2MB)</span>
                    </label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                        class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    <div id="thumbnail-preview-wrapper" class="mt-3 hidden">
                        <img id="thumbnail-preview" src="" alt="Preview" class="w-full max-w-xs rounded-lg border border-gray-200 object-cover" style="height:180px;">
                    </div>
                </div>

                {{-- Isi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                        Isi Literasi <span style="color:#e8521a;">*</span>
                    </label>
                    <div id="isi-editor" style="min-height:220px; background:#fff;">{!! old('isi') !!}</div>
                    <textarea name="isi" id="isi" class="hidden"></textarea>
                    <p id="isi-error" class="text-xs mt-1.5 hidden" style="color:#e8521a;">Isi literasi wajib diisi.</p>
                </div>

                {{-- Checkbox originalitas --}}
                <div class="flex items-start gap-3 bg-gray-50 rounded-lg px-4 py-3">
                    <input type="checkbox" name="is_original" id="is_original" value="1"
                        {{ old('is_original') ? 'checked' : '' }}
                        class="w-4 h-4 mt-0.5 rounded border-gray-300 text-green-700 focus:ring-green-600">
                    <label for="is_original" class="text-sm text-gray-700">
                        Saya menyatakan bahwa tulisan ini adalah <span class="font-semibold">karya asli saya sendiri</span>,
                        bukan hasil sepenuhnya dari AI (Artificial Intelligence).
                    </label>
                </div>

                {{-- Password konfirmasi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">
                        Password Konfirmasi <span style="color:#e8521a;">*</span>
                    </label>
                    <input type="password" name="password"
                        placeholder="Minta password ke admin/guru pembina literasi"
                        class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition"
                        style="--tw-ring-color:#1a5c2a;">
                    <p class="text-xs text-gray-400 mt-1.5">Password ini dipakai untuk memverifikasi bahwa kamu benar-benar bagian dari MTsN 7 Jember.</p>
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-lg font-semibold text-sm text-white transition hover:opacity-90 flex items-center justify-center gap-2"
                    style="background:#e8521a;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Kirim Artikel
                </button>
            </form>
        </div>
    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
<style>
    #isi-editor {
        border-radius: 0 0 0.5rem 0.5rem;
    }
    .ql-toolbar.ql-snow {
        border-radius: 0.5rem 0.5rem 0 0;
        border-color: #e5e7eb;
    }
    .ql-container.ql-snow {
        border-color: #e5e7eb;
        font-size: 0.875rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    AOS.init({ once: true, easing: 'ease-out-cubic', offset: 60 });

    // Styling radio Tipe Penulis saat dipilih
    const radioInputs = document.querySelectorAll('input[name="tipe"]');

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

    // ── WYSIWYG (Quill) untuk Isi Literasi ──
    const isiTextarea = document.getElementById('isi');
    const quill = new Quill('#isi-editor', {
        theme: 'snow',
        placeholder: 'Tulis isi literasi kamu di sini...',
        modules: {
            toolbar: {
                container: [
                    [{ header: [2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['blockquote', 'link', 'image'],
                    ['clean'],
                ],
                handlers: {
                    image: function () {
                        const input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');
                        input.click();

                        input.onchange = () => {
                            const file = input.files[0];
                            if (!file) return;

                            const reader = new FileReader();
                            reader.onload = (e) => {
                                const range = quill.getSelection(true);
                                quill.insertEmbed(range.index, 'image', e.target.result, 'user');
                                quill.setSelection(range.index + 1);
                            };
                            reader.readAsDataURL(file);
                        };
                    },
                },
            },
        },
    });
    // Isi ulang kalau ada old('isi') sudah otomatis ke-render lewat HTML awal #isi-editor
    // Sinkronkan isi Quill ke textarea, validasi manual sebelum submit
    document.getElementById('literasi-form').addEventListener('submit', function (e) {
        isiTextarea.value = quill.root.innerHTML;

        const isEmpty = quill.getText().trim().length === 0;
        const isiError = document.getElementById('isi-error');

        if (isEmpty) {
            e.preventDefault();
            isiError.classList.remove('hidden');
            document.getElementById('isi-editor').scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            isiError.classList.add('hidden');
        }
    });

    // ── Auto-generate slug dari judul ──
    const judulInput = document.getElementById('judul');
    const slugInput = document.getElementById('slug');
    let slugManuallyEdited = slugInput.value.trim() !== '';

    function slugify(text) {
        return text
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    judulInput.addEventListener('input', function () {
        if (!slugManuallyEdited) {
            slugInput.value = slugify(judulInput.value);
        }
    });

    slugInput.addEventListener('input', function () {
        slugManuallyEdited = slugInput.value.trim() !== '';
    });

    // ── Preview thumbnail ──
    const thumbnailInput = document.getElementById('thumbnail');
    const previewWrapper = document.getElementById('thumbnail-preview-wrapper');
    const previewImage = document.getElementById('thumbnail-preview');

    thumbnailInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewWrapper.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            previewWrapper.classList.add('hidden');
            previewImage.src = '';
        }
    });
</script>
@endpush