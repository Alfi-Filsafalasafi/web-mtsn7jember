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
        \App\Models\User::create([
            'name'     => 'Admin MTSN 7 Jember',
            'email'    => 'admin@mtsn7jember.sch.id',
            'password' => bcrypt('mts7maju'),
            'role'     => 'admin',
        ]);

        // Settings awal
        $settings = [
            ['key' => 'school_name',    'value' => 'MTSN 7 Jember'],
            ['key' => 'address',        'value' => 'Jl. Contoh No. 1, Jember, Jawa Timur'],
            ['key' => 'phone',          'value' => '(0331) 000000'],
            ['key' => 'email',          'value' => 'info@mtsn7jember.sch.id'],
            ['key' => 'maps_embed',     'value' => 'https://maps.google.com/...'],
            ['key' => 'principal_name', 'value' => 'Nama Kepala Sekolah'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::create($setting);
        }
    }
}
