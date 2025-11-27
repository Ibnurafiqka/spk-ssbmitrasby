<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'atlet_id',
        'kriteria_id',
        'nilai',
    ];

    protected $casts = [
        'nilai' => 'float',
    ];

    /**
     * Relasi ke Atlet
     */
    public function atlet()
    {
        return $this->belongsTo(Atlet::class);
    }

    /**
     * Relasi ke Kriteria
     */
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}