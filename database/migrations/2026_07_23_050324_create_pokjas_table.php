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
        Schema::create('pokjas', function (Blueprint $table) {
            $table->id();
            $table->string('name');            // "Pokja 1. Manajemen Perubahan"
            $table->string('logo')->nullable(); // path logo/icon pokja
            $table->text('description');
            $table->string('gdrive_url');       // link folder Google Drive evidence
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokjas');
    }
};
