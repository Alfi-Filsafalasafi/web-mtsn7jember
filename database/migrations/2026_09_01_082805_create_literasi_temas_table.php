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
        Schema::create('literasi_temas', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('bulan'); // 1-12
            $table->unsignedSmallInteger('tahun');
            $table->string('tema_guru');
            $table->string('tema_siswa');
            $table->longText('aturan_penulisan')->nullable(); // WYSIWYG
            $table->enum('status', ['selesai', 'belum'])->default('belum');
            $table->timestamps();

            $table->unique(['bulan', 'tahun']); // satu tema per bulan-tahun
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('literasi_temas');
    }
};