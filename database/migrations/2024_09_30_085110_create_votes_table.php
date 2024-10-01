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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemilih_id'); // Relasi ke pemilih yang melakukan voting
            $table->unsignedBigInteger('calon_ketua_id'); // Relasi ke calon ketua yang dipilih
            $table->unsignedBigInteger('session_id'); // Relasi ke sesi pemilihan
            $table->timestamps();

            // Foreign keys
            $table->foreign('pemilih_id')->references('id')->on('pemilihs')->onDelete('cascade');
            $table->foreign('calon_ketua_id')->references('id')->on('calon_ketuas')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
