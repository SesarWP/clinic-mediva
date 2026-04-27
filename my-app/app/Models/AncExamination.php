<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AncExamination extends Model
{
    protected $fillable = [
        'patient_id',
        'bidan_id',
        'tanggal_periksa',
        'usia_kehamilan_minggu',
        'tekanan_darah_sistolik',
        'tekanan_darah_diastolik',
        'berat_badan',
        'tinggi_fundus',
        'lingkar_lengan_atas',
        'denyut_jantung_janin',
        'keluhan',
        'catatan_bidan',
        'jadwal_kunjungan_berikutnya',
    ];

    protected $casts = [
        'tanggal_periksa' => 'date',
        'jadwal_kunjungan_berikutnya' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_fundus' => 'decimal:2',
        'lingkar_lengan_atas' => 'decimal:2',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function bidan()
    {
        return $this->belongsTo(User::class, 'bidan_id');
    }

    public function anemiaScreening()
    {
        return $this->hasOne(AnemiaScreening::class);
    }

    /**
     * Cek apakah tekanan darah tinggi
     */
    public function getIsHipertensiAttribute(): bool
    {
        return $this->tekanan_darah_sistolik >= 140 || $this->tekanan_darah_diastolik >= 90;
    }
}
