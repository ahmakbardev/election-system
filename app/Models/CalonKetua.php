<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonKetua extends Model
{
    use HasFactory;

    // Menambahkan kolom-kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'nama',
        'visi',
        'misi',
        'foto',
        'vote_count',
    ];
}
