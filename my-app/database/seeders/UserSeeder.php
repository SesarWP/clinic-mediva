<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Patient;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ============================================
        // USER BIDAN
        // ============================================
        
        $bidan1 = User::create([
            'name' => 'Bidan Siti',
            'email' => 'bidan@mediva.com',
            'password' => Hash::make('password'),
            'role' => 'bidan',
        ]);

        $bidan2 = User::create([
            'name' => 'Bidan Ani',
            'email' => 'ani@mediva.com',
            'password' => Hash::make('password'),
            'role' => 'bidan',
        ]);

        // ============================================
        // USER PASIEN
        // ============================================
        
        // Pasien 1
        $userPasien1 = User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);

        Patient::create([
            'user_id' => $userPasien1->id,
            'nik' => '3201234567890001',
            'nama_lengkap' => 'Dewi Lestari',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1995-05-15',
            'golongan_darah' => 'A',
            'gravida' => 2,
            'para' => 1,
            'abortus' => 0,
            'hpht' => '2025-10-01',
            'taksiran_persalinan' => '2026-07-08',
        ]);

        // Pasien 2
        $userPasien2 = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);

        Patient::create([
            'user_id' => $userPasien2->id,
            'nik' => '3201234567890002',
            'nama_lengkap' => 'Siti Nurhaliza',
            'alamat' => 'Jl. Sudirman No. 45, Bandung',
            'no_hp' => '082345678901',
            'tanggal_lahir' => '1998-08-20',
            'golongan_darah' => 'B',
            'gravida' => 1,
            'para' => 0,
            'abortus' => 0,
            'hpht' => '2025-11-15',
            'taksiran_persalinan' => '2026-08-22',
        ]);

        // Pasien 3
        $userPasien3 = User::create([
            'name' => 'Rina Wijaya',
            'email' => 'rina@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);

        Patient::create([
            'user_id' => $userPasien3->id,
            'nik' => '3201234567890003',
            'nama_lengkap' => 'Rina Wijaya',
            'alamat' => 'Jl. Gatot Subroto No. 78, Surabaya',
            'no_hp' => '083456789012',
            'tanggal_lahir' => '1992-03-10',
            'golongan_darah' => 'O',
            'gravida' => 3,
            'para' => 2,
            'abortus' => 0,
            'hpht' => '2025-09-20',
            'taksiran_persalinan' => '2026-06-27',
        ]);

        // Pasien 4
        $userPasien4 = User::create([
            'name' => 'Maya Putri',
            'email' => 'maya@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);

        Patient::create([
            'user_id' => $userPasien4->id,
            'nik' => '3201234567890004',
            'nama_lengkap' => 'Maya Putri',
            'alamat' => 'Jl. Ahmad Yani No. 90, Semarang',
            'no_hp' => '084567890123',
            'tanggal_lahir' => '2000-12-25',
            'golongan_darah' => 'AB',
            'gravida' => 1,
            'para' => 0,
            'abortus' => 0,
            'hpht' => '2025-12-01',
            'taksiran_persalinan' => '2026-09-07',
        ]);

        // Pasien 5
        $userPasien5 = User::create([
            'name' => 'Lina Marlina',
            'email' => 'lina@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);

        Patient::create([
            'user_id' => $userPasien5->id,
            'nik' => '3201234567890005',
            'nama_lengkap' => 'Lina Marlina',
            'alamat' => 'Jl. Diponegoro No. 12, Yogyakarta',
            'no_hp' => '085678901234',
            'tanggal_lahir' => '1997-07-07',
            'golongan_darah' => 'A',
            'gravida' => 2,
            'para' => 1,
            'abortus' => 0,
            'hpht' => '2025-10-10',
            'taksiran_persalinan' => '2026-07-17',
        ]);

        echo "\n✅ User seeder berhasil!\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📋 AKUN BIDAN:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "1. Email: bidan@mediva.com | Password: password\n";
        echo "2. Email: ani@mediva.com   | Password: password\n";
        echo "\n📋 AKUN PASIEN:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "1. Email: dewi@gmail.com | Password: password\n";
        echo "2. Email: siti@gmail.com | Password: password\n";
        echo "3. Email: rina@gmail.com | Password: password\n";
        echo "4. Email: maya@gmail.com | Password: password\n";
        echo "5. Email: lina@gmail.com | Password: password\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    }
}
