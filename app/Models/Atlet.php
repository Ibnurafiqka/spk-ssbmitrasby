<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atlet extends Model
{
    use HasFactory;

    public const POSISI = ['penyerang', 'tengah', 'bertahan'];

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'umur',
        'posisi',
        'orang_tua_id',
        'cabang_olahraga',
    ];


    /**
     * Relasi ke Penilaian
     */
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    /**
     * Relasi ke OrangTua
     */
    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }


    /**
     * Accessor untuk jenis kelamin lengkap
     */
    public function getJenisKelaminLengkapAttribute()
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getPosisiLabelAttribute(): string
    {
        return match ($this->posisi) {
            'penyerang' => 'Penyerang',
            'tengah' => 'Tengah',
            'bertahan' => 'Bertahan',
            default => '-',
        };
    }
}
