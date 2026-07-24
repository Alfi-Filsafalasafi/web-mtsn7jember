<?php

namespace App\Http\Controllers;

use App\Models\WadulGusDar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WadulGusDarController extends Controller
{
    /**
     * Tampilkan halaman form Wadul Gus Dar.
     */
    public function create()
    {
        return view('wadul-gusdar');
    }

    /**
     * Simpan wadul baru dari publik.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type'         => ['required', 'in:pengaduan,curhat,saran'],
            'pengisi_role' => ['required', 'in:siswa,guru,wali_murid,masyarakat'],
            'is_anonymous' => ['nullable', 'boolean'],
            'name'         => ['nullable', 'required_if:is_anonymous,false', 'string', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:30'],
            'message'      => ['required', 'string', 'max:5000'],
            'attachment'   => ['nullable', 'image', 'max:2048'], // max 2MB
        ], [
            'name.required_if' => 'Nama wajib diisi jika tidak memilih anonim.',
            'message.required' => 'Keterangan / isi wadul wajib diisi.',
            'attachment.image' => 'Lampiran harus berupa file gambar (jpg, png, dll).',
            'attachment.max'   => 'Ukuran lampiran maksimal 2MB.',
        ]);

        $isAnonymous = $request->boolean('is_anonymous');

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('wadul-attachments', 'public');
        }

        WadulGusDar::create([
            'type'         => $validated['type'],
            'pengisi_role' => $validated['pengisi_role'],
            'is_anonymous' => $isAnonymous,
            'name'         => $isAnonymous ? null : ($validated['name'] ?? null),
            'phone'        => $validated['phone'] ?? null,
            'message'      => $validated['message'],
            'attachment'   => $attachmentPath,
            'status'       => 'baru',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Terima kasih, wadul Anda telah kami terima dan akan segera ditindaklanjuti oleh Gus Dar.');
    }
}
