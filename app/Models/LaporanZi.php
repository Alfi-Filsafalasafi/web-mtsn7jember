<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanZi extends Model
{
    use HasFactory;

    protected $table = 'laporan_zis';

    protected $fillable = [
        'logo',
        'title',
        'description',
        'file',
        'published_at',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    /**
     * Tanggal yang ditampilkan di badge (fallback ke created_at kalau kosong).
     */
    public function getDisplayDateAttribute()
    {
        return $this->published_at ?? $this->created_at;
    }
}
