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
        Schema::create('pilihan_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calon_ketua_id');
            $table->unsignedBigInteger('pemilih_id');
            $table->timestamps();

            // Foreign key untuk calon ketua
            $table->foreign('calon_ketua_id')->references('id')->on('calon_ketuas')->onDelete('cascade');

            // Foreign key untuk pemilih
            $table->foreign('pemilih_id')->references('id')->on('pemilihs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilihan_siswa');
    }
};
