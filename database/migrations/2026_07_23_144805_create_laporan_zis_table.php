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
        Schema::create('laporan_zis', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();  // logo/lambang instansi
            $table->string('title');              // "Laporan Capaian Kinerja Triwulan I Tahun 2023"
            $table->text('description');
            $table->string('file');               // path file PDF laporan
            $table->date('published_at')->nullable(); // tanggal terbit, ditampilkan sebagai badge
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_zis');
    }
};
