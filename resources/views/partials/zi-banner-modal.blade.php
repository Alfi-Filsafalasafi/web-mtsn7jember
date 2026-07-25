{{-- Modal Popup Banner Zona Integritas - hanya muncul di halaman Beranda --}}
<div id="zi-banner-modal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center p-4"
    style="background: rgba(15, 61, 26, 0.75);">
    <div class="relative max-w-2xl w-full" data-aos="zoom-in" data-aos-duration="400">

        {{-- Tombol close --}}
        <button id="zi-banner-close"
            type="button"
            class="absolute -top-3 -right-3 w-9 h-9 rounded-full bg-white shadow-lg flex items-center justify-center hover:bg-gray-100 transition z-10"
            aria-label="Tutup">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Gambar banner --}}
        <img src="{{ asset('images/banner-zi.png') }}"
            alt="Selamat Datang di Zona Integritas - Menuju WBK-WBBM"
            class="w-full h-auto rounded-xl shadow-2xl">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('zi-banner-modal');
        const closeBtn = document.getElementById('zi-banner-close');

        // Selalu tampilkan setiap halaman Beranda dibuka/reload
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        closeBtn.addEventListener('click', closeModal);

        // Klik di luar gambar (area overlay) juga menutup modal
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Tutup dengan tombol ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    });
</script>