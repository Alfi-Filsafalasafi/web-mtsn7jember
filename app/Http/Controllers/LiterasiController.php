<?php

namespace App\Http\Controllers;

use App\Models\Literasi;
use App\Models\LiterasiPassword;
use App\Models\LiterasiTema;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LiterasiController extends Controller
{
    /**
     * Daftar literasi untuk 1 tema bulanan (dipilih lewat combobox bulan-tahun),
     * atau semua periode kalau combobox diarahkan ke "Semua Periode".
     */
    public function index(Request $request): View
    {
        // Semua tema yang isi comboboxnya, urut terbaru dulu.
        $temas = LiterasiTema::orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        $temaParam = $request->get('tema');
        $temaTerpilih = null;
        $tampilkanSemua = false;

        if ($temaParam === 'semua') {
            $tampilkanSemua = true;
        } elseif ($request->filled('tema')) {
            $temaTerpilih = $temas->firstWhere('id', (int) $temaParam);
        }

        if (! $tampilkanSemua && ! $temaTerpilih) {
            $temaTerpilih = $temas->first();
        }

        $query = Literasi::query()->latest();

        if ($temaTerpilih) {
            $query->where('literasi_tema_id', $temaTerpilih->id);
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        $literasis = ($tampilkanSemua || $temaTerpilih) ? $query->paginate(9)->withQueryString() : collect();

        return view('literasi', compact('temas', 'temaTerpilih', 'tampilkanSemua', 'literasis'));
    }

    /**
     * Detail 1 literasi.
     */
    public function show(Literasi $literasi): View
    {
        $literasi->load('literasiTema');

        return view('literasi-show', compact('literasi'));
    }

    /**
     * Form upload literasi publik.
     */
    public function create(): View
    {
        $temasAktif = LiterasiTema::where('status', 'belum')
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        $temaAktif = $temasAktif->first();

        return view('literasi-create', compact('temasAktif', 'temaAktif'));
    }

    /**
     * Simpan literasi baru dari form publik, dengan validasi password konfirmasi
     * dan centang pernyataan tulisan asli (bukan sepenuhnya AI).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'literasi_tema_id' => ['required', 'exists:literasi_temas,id'],
            'judul'             => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'unique:literasis,slug'],
            'nama_penulis'      => ['required', 'string', 'max:255'],
            'tipe'              => ['required', 'in:siswa,guru'],
            'isi'               => ['required', 'string'],
            'thumbnail'         => ['nullable', 'image', 'max:2048'],
            'is_original'       => ['accepted'],
            'password'          => ['required', 'string'],
        ], [
            'literasi_tema_id.required' => 'Tema bulanan wajib dipilih.',
            'judul.required'            => 'Judul literasi wajib diisi.',
            'slug.unique'               => 'Slug ini sudah dipakai artikel lain, coba ubah sedikit.',
            'nama_penulis.required'     => 'Nama penulis wajib diisi.',
            'tipe.required'             => 'Tipe penulis wajib dipilih.',
            'isi.required'              => 'Isi literasi wajib diisi.',
            'thumbnail.image'           => 'Thumbnail harus berupa file gambar.',
            'thumbnail.max'             => 'Ukuran thumbnail maksimal 2MB.',
            'is_original.accepted'      => 'Kamu harus menyatakan bahwa tulisan ini asli buatan sendiri.',
            'password.required'         => 'Password konfirmasi wajib diisi.',
        ]);

        if (! LiterasiPassword::check($validated['password'])) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['password' => 'Password konfirmasi salah. Silakan hubungi admin/guru pembina literasi.']);
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('literasi-thumbnails', 'public');
        }

        $literasi = Literasi::create([
            'literasi_tema_id' => $validated['literasi_tema_id'],
            'judul'             => $validated['judul'],
            'slug'              => $validated['slug'] ?? null,
            'nama_penulis'      => $validated['nama_penulis'],
            'tipe'              => $validated['tipe'],
            'isi'               => $validated['isi'],
            'thumbnail'         => $thumbnailPath,
        ]);

        return redirect()
            ->route('literasi.show', $literasi->slug)
            ->with('success', 'Literasi kamu berhasil diupload. Terima kasih sudah berkontribusi!');
    }
}