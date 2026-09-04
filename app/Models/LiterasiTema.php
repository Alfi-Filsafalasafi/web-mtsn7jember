<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LiterasiTema extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan',
        'tahun',
        'tema_guru',
        'tema_siswa',
        'aturan_penulisan',
        'status',
    ];

    protected $casts = [
        'bulan' => 'integer',
        'tahun' => 'integer',
    ];

    /**
     * Semua literasi yang masuk pada tema bulan ini.
     */
    public function literasis(): HasMany
    {
        return $this->hasMany(Literasi::class);
    }

    /**
     * Nama bulan dalam Bahasa Indonesia, misal "Januari".
     */
    public function getNamaBulanAttribute(): string
    {
        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        return $namaBulan[$this->bulan] ?? '';
    }
}