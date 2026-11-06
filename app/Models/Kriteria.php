<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    public const NAMA_STANDAR = [
        'dribbling',
        'passing',
        'shooting',
        'heading',
        'positioning',
        'stamina',
        'agility',
        'komunikasi',
        'sprint',
    ];

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'bobot_penyerang',
        'bobot_tengah',
        'bobot_bertahan',
        'jenis',
        'keterangan',
    ];

    protected $casts = [
        'bobot_penyerang' => 'float',
        'bobot_tengah' => 'float',
        'bobot_bertahan' => 'float',
    ];

    /**
     * Relasi ke Penilaian
     */
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    /**
     * Accessor untuk jenis kriteria lengkap
     */
    public function getJenisLengkapAttribute()
    {
        return $this->jenis === 'benefit' ? 'Benefit (Semakin besar semakin baik)' : 'Cost (Semakin kecil semakin baik)';
    }

    public function getBobotByPosisi(?string $posisi): float
    {
        return match ($posisi) {
            'penyerang' => (float) $this->bobot_penyerang,
            'tengah' => (float) $this->bobot_tengah,
            'bertahan' => (float) $this->bobot_bertahan,
            default => (float) (($this->bobot_penyerang + $this->bobot_tengah + $this->bobot_bertahan) / 3),
        };
    }

    public function getBobotAttribute(): float
    {
        return $this->getBobotByPosisi(null);
    }
}
