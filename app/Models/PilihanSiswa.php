<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanSiswa extends Model
{
    use HasFactory;

    protected $table = 'pilihan_siswa';

    protected $fillable = [
        'calon_ketua_id',
        'pemilih_id',
    ];
}
