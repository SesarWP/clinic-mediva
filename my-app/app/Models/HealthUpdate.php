<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'bidan_id',
        'tanggal_update',
        'tipe_update',
        'keluhan',
        'kondisi_umum',
        'suhu_tubuh',
        'tekanan_darah_sistolik',
        'tekanan_darah_diastolik',
        'mual_muntah',
        'pusing',
        'nyeri_perut',
        'pendarahan',
        'kontraksi',
        'gerakan_janin_berkurang',
        'kualitas_tidur',
        'nafsu_makan',
        'aktivitas_fisik',
        'catatan_pasien',
        'catatan_bidan',
        'perlu_tindak_lanjut',
        'sumber_input',
    ];

    protected $casts = [
        'tanggal_update' => 'date',
        'mual_muntah' => 'boolean',
        'pusing' => 'boolean',
        'nyeri_perut' => 'boolean',
        'pendarahan' => 'boolean',
        'kontraksi' => 'boolean',
        'gerakan_janin_berkurang' => 'boolean',
        'perlu_tindak_lanjut' => 'boolean',
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function bidan()
    {
        return $this->belongsTo(User::class, 'bidan_id');
    }

    // Accessors
    public function getHasGejalaBahayaAttribute()
    {
        return $this->pendarahan || 
               $this->kontraksi || 
               $this->gerakan_janin_berkurang ||
               ($this->suhu_tubuh && $this->suhu_tubuh >= 38) ||
               ($this->tekanan_darah_sistolik && $this->tekanan_darah_sistolik >= 140);
    }

    public function getGejalaListAttribute()
    {
        $gejala = [];
        if ($this->mual_muntah) $gejala[] = 'Mual/Muntah';
        if ($this->pusing) $gejala[] = 'Pusing';
        if ($this->nyeri_perut) $gejala[] = 'Nyeri Perut';
        if ($this->pendarahan) $gejala[] = 'Pendarahan';
        if ($this->kontraksi) $gejala[] = 'Kontraksi';
        if ($this->gerakan_janin_berkurang) $gejala[] = 'Gerakan Janin Berkurang';
        
        return $gejala;
    }

    public function getKondisiColorAttribute()
    {
        return match($this->kondisi_umum) {
            'baik' => 'success',
            'cukup' => 'warning',
            'kurang' => 'danger',
            default => 'secondary'
        };
    }

    public function getTekananDarahAttribute()
    {
        if ($this->tekanan_darah_sistolik && $this->tekanan_darah_diastolik) {
            return $this->tekanan_darah_sistolik . '/' . $this->tekanan_darah_diastolik;
        }
        return null;
    }
}
