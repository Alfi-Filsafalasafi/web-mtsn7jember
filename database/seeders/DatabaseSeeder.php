<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@mtsn7jember.sch.id'],
            [
                'name'     => 'Admin MTSN 7 Jember',
                'password' => bcrypt('mts7maju'),
                'role'     => 'admin',
            ]
        );

        // Settings awal
        $settings = [
            ['key' => 'school_name',    'value' => 'MTSN 7 Jember'],
            ['key' => 'npsn',           'value' => '20581908'], // ganti sesuai NPSN asli
            ['key' => 'address',        'value' => 'Jl. Contoh No. 1, Jember, Jawa Timur'],
            ['key' => 'phone',          'value' => '(0331) 000000'],
            ['key' => 'email',          'value' => 'info@mtsn7jember.sch.id'],
            ['key' => 'maps_embed',     'value' => 'https://maps.google.com/...'],
            ['key' => 'principal_name', 'value' => 'Nama Kepala Sekolah'],
            ['key' => 'facebook_url',   'value' => 'https://facebook.com/mtsn7jember'],
            ['key' => 'instagram_url',  'value' => 'https://instagram.com/mtsn7jember'],
            ['key' => 'youtube_url',    'value' => 'https://youtube.com/@mtsn7jember'],
            ['key' => 'tiktok_url',     'value' => 'https://tiktok.com/@mtsn7jember'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
