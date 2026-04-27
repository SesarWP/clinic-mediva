<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnemiaScreening extends Model
{
    protected $fillable = [
        'patient_id',
        'bidan_id',
        'anc_examination_id',
        'tanggal_screening',
        'kadar_hb',
        'status_anemia',
        'tindakan',
        'catatan',
    ];

    protected $casts = [
        'tanggal_screening' => 'date',
        'kadar_hb' => 'decimal:1',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function bidan()
    {
        return $this->belongsTo(User::class, 'bidan_id');
    }

    public function ancExamination()
    {
        return $this->belongsTo(AncExamination::class);
    }

    /**
     * Auto-calculate status anemia dari kadar HB (standar WHO)
     */
    public static function hitungStatusAnemia(float $kadarHb): string
    {
        return match(true) {
            $kadarHb >= 11 => 'normal',
            $kadarHb >= 10 => 'ringan',
            $kadarHb >= 7 => 'sedang',
            default => 'berat',
        };
    }

    /**
     * Warna badge sesuai status
     */
    public function getBadgeColorAttribute(): string
    {
        return match($this->status_anemia) {
            'normal' => 'success',
            'ringan' => 'warning',
            'sedang' => 'orange',
            'berat' => 'danger',
            default => 'secondary',
        };
    }
}
