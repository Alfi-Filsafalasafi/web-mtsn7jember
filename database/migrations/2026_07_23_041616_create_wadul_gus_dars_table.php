<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wadul_gus_dars', function (Blueprint $table) {
            $table->id();

            // Jenis wadul
            $table->enum('type', ['pengaduan', 'curhat', 'saran'])->default('curhat');

            // Peran pengisi
            $table->enum('pengisi_role', ['siswa', 'guru', 'wali_murid', 'masyarakat'])->default('masyarakat');

            // Identitas (nullable karena bisa anonim)
            $table->boolean('is_anonymous')->default(false);
            $table->string('name')->nullable();
            $table->string('phone')->nullable();

            // Isi
            $table->text('message');
            $table->string('attachment')->nullable(); // path foto lampiran

            // Tindak lanjut oleh admin/Gus Dar
            $table->enum('status', ['baru', 'diproses', 'selesai'])->default('baru');
            $table->text('response')->nullable(); // catatan tindak lanjut
            $table->timestamp('responded_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wadul_gus_dars');
    }
};
