<?php

namespace Database\Seeders;

use App\Models\LiterasiPassword;
use Illuminate\Database\Seeder;

class LiterasiPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hanya buat 1 record kalau belum ada sama sekali (singleton).
        if (! LiterasiPassword::exists()) {
            LiterasiPassword::create([
                'password' => 'literasi',
            ]);
        }
    }
}