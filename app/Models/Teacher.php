<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nip',
        'position',
        'subject',
        'photo',
        'status',
        'sort_order',
    ];

    // Scope: hanya guru yang aktif, diurutkan
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif')
            ->orderBy('sort_order');
    }
}
