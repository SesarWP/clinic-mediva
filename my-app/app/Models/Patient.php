<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'nik',
        'nama_lengkap',
        'alamat',
        'no_hp',
        'tanggal_lahir',
        'golongan_darah',
        'gravida',
        'para',
        'abortus',
        'hpht',
        'taksiran_persalinan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'hpht' => 'date',
        'taksiran_persalinan' => 'date',
    ];

    /**
     * Relasi ke user (akun login)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Pemeriksaan ANC pasien
     */
    public function ancExaminations()
    {
        return $this->hasMany(AncExamination::class)->orderBy('tanggal_periksa', 'desc');
    }

    /**
     * Screening anemia pasien
     */
    public function anemiaScreenings()
    {
        return $this->hasMany(AnemiaScreening::class)->orderBy('tanggal_screening', 'desc');
    }

    /**
     * Hitung usia kehamilan dari HPHT
     */
    public function getUsiaKehamilanAttribute(): ?string
    {
        if (!$this->hpht) return null;

        $hpht = Carbon::parse($this->hpht);
        $now = Carbon::now();
        $diffDays = $hpht->diffInDays($now);
        $minggu = floor($diffDays / 7);
        $hari = $diffDays % 7;

        return "{$minggu} minggu {$hari} hari";
    }

    /**
     * Hitung usia dari tanggal lahir
     */
    public function getUsiaAttribute(): ?int
    {
        if (!$this->tanggal_lahir) return null;
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    /**
     * Cek apakah pasien berisiko tinggi
     */
    public function getIsRisikoTinggiAttribute(): bool
    {
        // Usia berisiko
        $usia = $this->usia;
        if ($usia && ($usia < 20 || $usia > 35)) return true;

        // Cek screening anemia terakhir
        $lastScreening = $this->anemiaScreenings()->first();
        if ($lastScreening && $lastScreening->kadar_hb < 10) return true;

        // Cek pemeriksaan ANC terakhir
        $lastAnc = $this->ancExaminations()->first();
        if ($lastAnc) {
            if ($lastAnc->tekanan_darah_sistolik >= 140 || $lastAnc->tekanan_darah_diastolik >= 90) return true;
            if ($lastAnc->lingkar_lengan_atas && $lastAnc->lingkar_lengan_atas < 23.5) return true;
        }

        return false;
    }

    /**
     * Ambil alasan risiko tinggi
     */
    public function getAlasanRisikoAttribute(): array
    {
        $alasan = [];

        $usia = $this->usia;
        if ($usia && $usia < 20) $alasan[] = "Usia < 20 tahun ({$usia} tahun)";
        if ($usia && $usia > 35) $alasan[] = "Usia > 35 tahun ({$usia} tahun)";

        $lastScreening = $this->anemiaScreenings()->first();
        if ($lastScreening && $lastScreening->kadar_hb < 10) {
            $alasan[] = "Anemia {$lastScreening->status_anemia} (HB: {$lastScreening->kadar_hb} g/dL)";
        }

        $lastAnc = $this->ancExaminations()->first();
        if ($lastAnc) {
            if ($lastAnc->tekanan_darah_sistolik >= 140 || $lastAnc->tekanan_darah_diastolik >= 90) {
                $alasan[] = "Hipertensi ({$lastAnc->tekanan_darah_sistolik}/{$lastAnc->tekanan_darah_diastolik} mmHg)";
            }
            if ($lastAnc->lingkar_lengan_atas && $lastAnc->lingkar_lengan_atas < 23.5) {
                $alasan[] = "LILA < 23.5 cm ({$lastAnc->lingkar_lengan_atas} cm)";
            }
        }

        return $alasan;
    }

    /**
     * Jadwal kunjungan berikutnya dari ANC terakhir
     */
    public function getJadwalBerikutnyaAttribute(): ?string
    {
        $lastAnc = $this->ancExaminations()->first();
        return $lastAnc?->jadwal_kunjungan_berikutnya;
    }
}
