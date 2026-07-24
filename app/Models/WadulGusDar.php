<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WadulGusDar extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'pengisi_role',
        'is_anonymous',
        'name',
        'phone',
        'message',
        'attachment',
        'status',
        'response',
        'responded_at',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'responded_at' => 'datetime',
    ];

    /**
     * Nama yang ditampilkan (menghormati status anonim).
     */
    public function getDisplayNameAttribute(): string
    {
        if ($this->is_anonymous || empty($this->name)) {
            return 'Anonim';
        }

        return $this->name;
    }

    /**
     * Label tipe wadul dalam Bahasa Indonesia.
     */
    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'pengaduan' => 'Pengaduan',
            'curhat'    => 'Curhat',
            'saran'     => 'Saran',
            default     => ucfirst($this->type),
        };
    }

    /**
     * Label peran pengisi dalam Bahasa Indonesia.
     */
    public function getPengisiRoleLabelAttribute(): string
    {
        return match ($this->pengisi_role) {
            'siswa'      => 'Siswa',
            'guru'       => 'Guru',
            'wali_murid' => 'Wali Murid',
            'masyarakat' => 'Masyarakat',
            default      => ucfirst($this->pengisi_role),
        };
    }
}
