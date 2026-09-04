<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiterasiPassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'password',
    ];

    /**
     * Cek apakah password yang diinput cocok dengan password konfirmasi literasi.
     * Selalu memakai record pertama (dianggap singleton/satu-satunya baris aktif).
     */
    public static function check(string $inputPassword): bool
    {
        $record = static::first();

        if (! $record) {
            return false;
        }

        return $inputPassword === $record->password;
    }
}