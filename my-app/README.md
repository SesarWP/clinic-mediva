# 🏥 Sistem ANC & Screening Anemia — Klinik Mediva Ngawi

Sistem informasi berbasis web untuk monitoring **Antenatal Care (ANC)** dan **Screening Anemia** pada ibu hamil di Klinik Mediva Ngawi. Dibangun menggunakan Laravel 12 dengan autentikasi dual-role (Bidan & Pasien).

---

## 📋 Daftar Isi

- [Fitur](#-fitur)
- [Tech Stack](#-tech-stack)
- [Instalasi](#-instalasi)
- [Akun Demo](#-akun-demo)
- [Struktur Database](#-struktur-database)
- [Struktur Folder](#-struktur-folder)
- [Alur Sistem](#-alur-sistem)
- [Klasifikasi Anemia](#-klasifikasi-anemia-who)
- [Deteksi Risiko Tinggi](#-deteksi-risiko-tinggi)

---

## ✨ Fitur

### 🔐 Authentication
- Halaman utama (`/`) dengan pilihan login sebagai **Bidan** atau **Pasien**
- Halaman login terpisah: `/login/bidan` dan `/login/pasien`
- Middleware `role` untuk proteksi route masing-masing
- Redirect otomatis berdasarkan role setelah login

### 👩‍⚕️ Dashboard Bidan
- **Statistik**: Total pasien, kunjungan hari ini, jumlah pasien anemia, pasien risiko tinggi
- **CRUD Data Pasien**: Lengkap dengan data kehamilan (Gravida/Para/Abortus, HPHT, taksiran persalinan)
- **Input Pemeriksaan ANC**: Tekanan darah, berat badan, tinggi fundus uteri, LILA, DJJ, keluhan, catatan bidan
- **Input Screening Anemia**: Kadar HB dengan auto-calculate status anemia berdasarkan standar WHO
- **Riwayat Pemeriksaan**: Detail lengkap per pasien (ANC & screening)
- **Highlight Risiko Tinggi**: Notifikasi otomatis untuk pasien berisiko
- **Jadwal Kunjungan**: Jadwal 7 hari ke depan di dashboard

### 🤰 Dashboard Pasien (Read-Only)
- Profil kehamilan (usia kehamilan, taksiran persalinan, G/P/A)
- Status anemia terakhir
- Jadwal kunjungan berikutnya
- Riwayat pemeriksaan ANC
- Hasil screening anemia
- Edit profil sendiri (nama, alamat, no HP)

---

## 🛠 Tech Stack

| Komponen | Teknologi |
|----------|-----------|
| Backend | Laravel 12 (PHP 8.2+) |
| Database | MySQL |
| Frontend | Blade Template + Bootstrap 5 |
| CSS Framework | Tailwind CSS 4 (Vite) + Bootstrap 5 CDN |
| Icons | Bootstrap Icons |
| Font | Inter (Google Fonts) |
| Build Tool | Vite |

---

## 🚀 Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Langkah Instalasi

```bash
# 1. Clone repository
git clone <repository-url>
cd my-app

# 2. Install dependencies PHP
composer install

# 3. Install dependencies Node.js
npm install

# 4. Copy file environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Konfigurasi database di file .env
#    Sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 7. Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# 8. Jalankan development server
php artisan serve

# 9. (Opsional) Jalankan Vite untuk asset compilation
npm run dev
```

Aplikasi dapat diakses di `http://localhost:8000`

---

## 🔑 Akun Demo

| Role | Email | Password |
|------|-------|----------|
| Bidan | `bidan@mediva.com` | `password123` |
| Pasien | `pasien@mediva.com` | `password123` |

---

## 🗄 Struktur Database

### Tabel `users`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| name | string | Nama user |
| email | string | Email (unique) |
| role | enum | `bidan` / `pasien` |
| password | string | Password (hashed) |

### Tabel `patients`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| user_id | bigint | FK ke users (nullable) |
| nik | string | NIK 16 digit (unique) |
| nama_lengkap | string | Nama lengkap |
| alamat | text | Alamat (nullable) |
| no_hp | string | No. HP (nullable) |
| tanggal_lahir | date | Tanggal lahir |
| golongan_darah | string | A/B/AB/O (nullable) |
| gravida | integer | Kehamilan ke- (nullable) |
| para | integer | Persalinan ke- (nullable) |
| abortus | integer | Keguguran (nullable) |
| hpht | date | Hari pertama haid terakhir |
| taksiran_persalinan | date | Estimasi tanggal persalinan |

### Tabel `anc_examinations`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| patient_id | bigint | FK ke patients |
| bidan_id | bigint | FK ke users (bidan) |
| tanggal_periksa | date | Tanggal pemeriksaan |
| usia_kehamilan_minggu | integer | Usia kehamilan (minggu) |
| tekanan_darah_sistolik | integer | TD sistolik (mmHg) |
| tekanan_darah_diastolik | integer | TD diastolik (mmHg) |
| berat_badan | decimal | Berat badan (kg) |
| tinggi_fundus | decimal | TFU (cm, nullable) |
| lingkar_lengan_atas | decimal | LILA (cm, nullable) |
| denyut_jantung_janin | integer | DJJ (bpm, nullable) |
| keluhan | text | Keluhan pasien (nullable) |
| catatan_bidan | text | Catatan bidan (nullable) |
| jadwal_kunjungan_berikutnya | date | Jadwal kontrol (nullable) |

### Tabel `anemia_screenings`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| patient_id | bigint | FK ke patients |
| bidan_id | bigint | FK ke users (bidan) |
| anc_examination_id | bigint | FK ke anc_examinations (nullable) |
| tanggal_screening | date | Tanggal screening |
| kadar_hb | decimal | Kadar hemoglobin (g/dL) |
| status_anemia | enum | `normal` / `ringan` / `sedang` / `berat` |
| tindakan | text | Tindak lanjut (nullable) |
| catatan | text | Catatan (nullable) |

---

## 📁 Struktur Folder

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php              # Login/logout
│   │   ├── Bidan/
│   │   │   ├── DashboardController.php     # Dashboard bidan
│   │   │   ├── PatientController.php       # CRUD pasien
│   │   │   ├── AncExaminationController.php # CRUD pemeriksaan ANC
│   │   │   └── AnemiaScreeningController.php # CRUD screening
│   │   └── Pasien/
│   │       ├── DashboardController.php     # Dashboard pasien
│   │       └── ProfileController.php       # Edit profil pasien
│   └── Middleware/
│       └── CheckRole.php                   # Middleware role
├── Models/
│   ├── User.php                            # + role, relasi
│   ├── Patient.php                         # + kehamilan, risiko
│   ├── AncExamination.php                  # Pemeriksaan ANC
│   └── AnemiaScreening.php                 # Screening anemia
resources/views/
├── layouts/
│   ├── app.blade.php                       # Master layout
│   ├── bidan.blade.php                     # Layout bidan (sidebar ungu)
│   └── pasien.blade.php                    # Layout pasien (sidebar teal)
├── auth/
│   ├── login-choice.blade.php              # Pilih role login
│   ├── login-bidan.blade.php               # Form login bidan
│   └── login-pasien.blade.php              # Form login pasien
├── bidan/
│   ├── dashboard.blade.php                 # Dashboard statistik
│   ├── patients/
│   │   ├── index.blade.php                 # Daftar pasien
│   │   ├── create.blade.php                # Form tambah pasien
│   │   ├── edit.blade.php                  # Form edit pasien
│   │   └── show.blade.php                  # Detail & riwayat pasien
│   ├── anc/
│   │   ├── create.blade.php                # Form input ANC
│   │   └── edit.blade.php                  # Form edit ANC
│   └── screening/
│       ├── create.blade.php                # Form input screening
│       └── edit.blade.php                  # Form edit screening
└── pasien/
    ├── dashboard.blade.php                 # Dashboard pasien
    ├── profil.blade.php                    # Edit profil
    ├── riwayat.blade.php                   # Riwayat pemeriksaan
    ├── screening.blade.php                 # Hasil screening
    └── no-data.blade.php                   # Akun belum terhubung
```

---

## 🔄 Alur Sistem

```
Halaman Utama (/)
├── Login Bidan (/login/bidan)
│   └── Dashboard Bidan (/bidan/dashboard)
│       ├── Data Pasien → CRUD
│       ├── Pemeriksaan ANC → Input per pasien
│       ├── Screening Anemia → Input per pasien
│       └── Riwayat → Detail per pasien
└── Login Pasien (/login/pasien)
    └── Dashboard Pasien (/pasien/dashboard)
        ├── Profil → Edit nama, alamat, no HP
        ├── Riwayat Pemeriksaan → Read only
        └── Screening Anemia → Read only
```

---

## 🩸 Klasifikasi Anemia (WHO)

| Status | Kadar HB | Keterangan |
|--------|----------|------------|
| ✅ Normal | ≥ 11 g/dL | Kadar HB baik |
| ⚠️ Ringan | 10 – 10.9 g/dL | Perlu suplemen Fe |
| 🟠 Sedang | 7 – 9.9 g/dL | Konsultasi dokter |
| 🔴 Berat | < 7 g/dL | Perlu transfusi darah |

> Status anemia **otomatis dihitung** dari kadar HB yang diinput oleh bidan.

---

## ⚠️ Deteksi Risiko Tinggi

Pasien otomatis ditandai **risiko tinggi** jika memenuhi salah satu kriteria:

| Faktor Risiko | Kriteria |
|---------------|----------|
| Usia | < 20 tahun atau > 35 tahun |
| Anemia | Kadar HB < 10 g/dL (sedang/berat) |
| Hipertensi | TD sistolik ≥ 140 atau diastolik ≥ 90 mmHg |
| KEK | LILA < 23.5 cm |

---

## 📄 Lisensi

Project ini dikembangkan untuk keperluan Capstone Project.

Dibangun dengan ❤️ menggunakan [Laravel](https://laravel.com).
