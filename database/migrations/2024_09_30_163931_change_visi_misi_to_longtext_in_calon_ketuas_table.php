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
            $table->longText('visi')->change();
            $table->longText('misi')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_ketuas', function (Blueprint $table) {
            $table->string('visi')->change();
            $table->string('misi')->change();
        });
    }
};
