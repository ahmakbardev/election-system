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
        Schema::table('calon_ketuas', function (Blueprint $table) {
            $table->integer('vote_count')->default(0)->after('foto'); // Kolom baru untuk menyimpan jumlah vote
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_ketuas', function (Blueprint $table) {
            $table->dropColumn('vote_count');
        });
    }
};
