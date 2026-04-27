<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use App\Models\AncExamination;
use App\Models\AnemiaScreening;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==========================================
        // BIDAN
        // ==========================================
        $bidan = User::create([
            'name' => 'Bidan Mediva',
            'email' => 'bidan@mediva.com',
            'password' => Hash::make('password123'),
            'role' => 'bidan',
        ]);

        // ==========================================
        // PASIEN 1 - Pasien Demo (dengan data lengkap)
        // ==========================================
        $pasienUser1 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'pasien@mediva.com',
            'password' => Hash::make('password123'),
            'role' => 'pasien',
        ]);

        $patient1 = Patient::create([
            'user_id' => $pasienUser1->id,
            'nik' => '3521234567890001',
            'nama_lengkap' => 'Siti Aminah',
            'alamat' => 'Jl. Raya Ngawi No. 10, Kel. Margomulyo, Kec. Ngawi',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1995-05-15',
            'golongan_darah' => 'O',
            'gravida' => 2,
            'para' => 1,
            'abortus' => 0,
            'hpht' => '2026-01-15',
            'taksiran_persalinan' => '2026-10-22',
        ]);

        // ANC Pemeriksaan untuk Pasien 1
        $anc1 = AncExamination::create([
            'patient_id' => $patient1->id,
            'bidan_id' => $bidan->id,
            'tanggal_periksa' => '2026-03-15',
            'usia_kehamilan_minggu' => 8,
            'tekanan_darah_sistolik' => 110,
            'tekanan_darah_diastolik' => 70,
            'berat_badan' => 55.5,
            'tinggi_fundus' => null,
            'lingkar_lengan_atas' => 25.0,
            'denyut_jantung_janin' => null,
            'keluhan' => 'Mual di pagi hari',
            'catatan_bidan' => 'Kehamilan normal, berikan vitamin dan zat besi.',
            'jadwal_kunjungan_berikutnya' => '2026-04-15',
        ]);

        $anc2 = AncExamination::create([
            'patient_id' => $patient1->id,
            'bidan_id' => $bidan->id,
            'tanggal_periksa' => '2026-04-15',
            'usia_kehamilan_minggu' => 13,
            'tekanan_darah_sistolik' => 115,
            'tekanan_darah_diastolik' => 75,
            'berat_badan' => 57.0,
            'tinggi_fundus' => 12,
            'lingkar_lengan_atas' => 25.5,
            'denyut_jantung_janin' => 140,
            'keluhan' => 'Sudah tidak mual',
            'catatan_bidan' => 'Perkembangan janin baik. Lanjutkan suplemen.',
            'jadwal_kunjungan_berikutnya' => '2026-05-15',
        ]);

        // Screening anemia untuk Pasien 1
        AnemiaScreening::create([
            'patient_id' => $patient1->id,
            'bidan_id' => $bidan->id,
            'anc_examination_id' => $anc1->id,
            'tanggal_screening' => '2026-03-15',
            'kadar_hb' => 11.5,
            'status_anemia' => 'normal',
            'tindakan' => 'Lanjutkan tablet Fe 1x1',
            'catatan' => 'Kadar HB normal',
        ]);

        AnemiaScreening::create([
            'patient_id' => $patient1->id,
            'bidan_id' => $bidan->id,
            'anc_examination_id' => $anc2->id,
            'tanggal_screening' => '2026-04-15',
            'kadar_hb' => 10.8,
            'status_anemia' => 'ringan',
            'tindakan' => 'Tingkatkan tablet Fe 2x1, konsumsi makanan kaya zat besi',
            'catatan' => 'HB sedikit turun, pantau lebih lanjut',
        ]);

        // ==========================================
        // PASIEN 2 - Tanpa akun login
        // ==========================================
        $patient2 = Patient::create([
            'nik' => '3521234567890002',
            'nama_lengkap' => 'Dewi Kartini',
            'alamat' => 'Jl. Merdeka No. 25, Kel. Karangtengah, Kec. Ngawi',
            'no_hp' => '085678901234',
            'tanggal_lahir' => '1990-08-20',
            'golongan_darah' => 'A',
            'gravida' => 3,
            'para' => 2,
            'abortus' => 0,
            'hpht' => '2026-02-01',
            'taksiran_persalinan' => '2026-11-08',
        ]);

        AncExamination::create([
            'patient_id' => $patient2->id,
            'bidan_id' => $bidan->id,
            'tanggal_periksa' => '2026-04-01',
            'usia_kehamilan_minggu' => 9,
            'tekanan_darah_sistolik' => 145,
            'tekanan_darah_diastolik' => 95,
            'berat_badan' => 62.0,
            'tinggi_fundus' => null,
            'lingkar_lengan_atas' => 22.0,
            'denyut_jantung_janin' => null,
            'keluhan' => 'Sering pusing dan lemas',
            'catatan_bidan' => 'PERHATIAN: Tekanan darah tinggi dan LILA kurang. Rujuk ke dokter.',
            'jadwal_kunjungan_berikutnya' => '2026-04-15',
        ]);

        AnemiaScreening::create([
            'patient_id' => $patient2->id,
            'bidan_id' => $bidan->id,
            'tanggal_screening' => '2026-04-01',
            'kadar_hb' => 8.5,
            'status_anemia' => 'sedang',
            'tindakan' => 'Rujuk ke dokter, tablet Fe 2x1, konseling gizi',
            'catatan' => 'Anemia sedang + hipertensi, risiko tinggi',
        ]);

        // ==========================================
        // PASIEN 3 - Tanpa akun login
        // ==========================================
        Patient::create([
            'nik' => '3521234567890003',
            'nama_lengkap' => 'Rina Puspita',
            'alamat' => 'Jl. Kartini No. 5, Kel. Beran, Kec. Ngawi',
            'no_hp' => '087890123456',
            'tanggal_lahir' => '2000-12-10',
            'golongan_darah' => 'B',
            'gravida' => 1,
            'para' => 0,
            'abortus' => 0,
            'hpht' => '2026-03-01',
            'taksiran_persalinan' => '2026-12-06',
        ]);
    }
}
