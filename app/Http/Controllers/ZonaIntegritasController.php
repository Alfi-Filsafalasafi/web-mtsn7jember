<?php

namespace App\Http\Controllers;

use App\Models\LaporanZi;
use App\Models\Pokja;
use App\Models\Survei;

class ZonaIntegritasController extends Controller
{
    /**
     * Halaman Evidence ZI - daftar Pokja dengan link ke Google Drive.
     */
    public function evidence()
    {
        $pokjas = Pokja::orderBy('sort_order')->get();

        return view('zona-integritas.evidence', compact('pokjas'));
    }

    /**
     * Halaman Laporan-Laporan ZI - daftar laporan dengan file PDF.
     */
    public function laporan()
    {
        $laporans = LaporanZi::orderBy('sort_order')
            ->orderByDesc('published_at')
            ->get();

        return view('zona-integritas.laporan', compact('laporans'));
    }

    /**
     * Halaman Survei - daftar survei dengan link ke web eksternal.
     */
    public function survei()
    {
        $surveis = Survei::orderBy('sort_order')->get();

        return view('zona-integritas.survei', compact('surveis'));
    }
}
