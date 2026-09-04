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
        Schema::create('literasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('literasi_tema_id')->constrained()->cascadeOnDelete();
            $table->string('judul');
            $table->string('nama_penulis');
            $table->enum('tipe', ['siswa', 'guru']);
            $table->longText('isi'); // WYSIWYG
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('literasis');
    }
};