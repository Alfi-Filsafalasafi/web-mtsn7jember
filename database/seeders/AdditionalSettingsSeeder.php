<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class AdditionalSettingsSeeder extends Seeder
{
    /**
     * Seed setting tambahan: NPSN dan media sosial.
     * Aman dijalankan berkali-kali (updateOrCreate, tidak bikin duplikat).
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'npsn',          'value' => '20581908'], // ganti sesuai NPSN asli
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/mtsn7jember'],
            ['key' => 'tiktok_url',    'value' => 'https://tiktok.com/@mtsn7jember'],
            ['key' => 'youtube_url',   'value' => 'https://youtube.com/@mtsn7jember'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
