<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Literasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'literasi_tema_id',
        'judul',
        'slug',
        'nama_penulis',
        'tipe',
        'isi',
        'thumbnail',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Literasi $literasi) {
            if (empty($literasi->slug)) {
                $literasi->slug = static::generateUniqueSlug($literasi->judul);
            }
        });
    }

    /**
     * Generate slug unik dari judul, nambah -2, -3, dst kalau sudah ada yang sama.
     */
    public static function generateUniqueSlug(string $judul): string
    {
        $baseSlug = Str::slug($judul);
        $slug = $baseSlug;
        $counter = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    /**
     * Route model binding otomatis pakai slug, bukan id.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Tema bulanan tempat literasi ini disubmit.
     */
    public function literasiTema(): BelongsTo
    {
        return $this->belongsTo(LiterasiTema::class);
    }

    /**
     * Scope untuk filter berdasarkan tipe (siswa/guru).
     */
    public function scopeTipe($query, string $tipe)
    {
        return $query->where('tipe', $tipe);
    }
}