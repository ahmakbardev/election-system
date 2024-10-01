<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilih extends Model
{
    use HasFactory;

    // Add the fields that can be mass assigned
    protected $fillable = [
        'no_absen',
        'nama',
        'tingkat',
        'kelas',
    ];
}
