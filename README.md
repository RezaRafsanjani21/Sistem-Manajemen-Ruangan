# Sistem Manajemen Ruangan

Sistem manajemen ruangan berbasis web menggunakan Laravel 11 dan Filament PHP 3.

## Fitur Utama

### User Side
- **Landing Page** dengan 6 kartu fitur informatif
- **Login User** dengan desain kartu biru muda yang bersih
- **Dashboard** dengan statistik peminjaman
- **Form Peminjaman** dengan validasi:
  - Minimal durasi 2 jam
  - Jam operasional 08:00 - 17:00
  - Pilihan ruangan yang tersedia
- **Riwayat Peminjaman** dengan status tracking

### Admin Side (Filament)
- **Dashboard Admin** dengan statistik lengkap
- **Manajemen Ruangan** (CRUD)
- **Manajemen Pengguna** (CRUD)
- **Manajemen Peminjaman** dengan approval workflow:
  - Setujui peminjaman
  - Tolak peminjaman
  - Tandai selesai
- **Laporan Peminjaman** dari database view

## Database

Database yang digunakan: **projectadm** (sesuai dengan SQL dump yang diberikan)

### Struktur Tabel:
- `pengguna` - Data user dan admin
- `ruangan` - Data ruangan
- `kegiatan` - Data kegiatan
- `waktu` - Jadwal peminjaman
- `peminjaman_ruangan` - Data peminjaman
- `sessions` - Session Laravel (sudah dibuat migrationnya)

### View Database:
- `view_peminjaman_5_tabel` - Digunakan untuk laporan lengkap

## Instalasi

### 1. Install Dependencies

```powershell
# Install Composer dependencies
composer install

# Install NPM dependencies
npm install
```

### 2. Konfigurasi Environment

File `.env` sudah dikonfigurasi dengan:
- Database: `projectadm`
- Host: `127.0.0.1`
- Username: `root`
- Password: (kosong)

### 3. Generate Application Key

```powershell
php artisan key:generate
```

### 4. Migrasi Database

```powershell
# Jalankan migration untuk tabel sessions
php artisan migrate
```

**Note:** Tabel lainnya sudah ada dari SQL dump, hanya perlu menambahkan tabel `sessions`.

### 5. Buat Admin User

Tambahkan user admin ke database:

```sql
INSERT INTO pengguna (NAMA_USER, USERNAME, PASSWORD, ROLE) 
VALUES ('Admin', 'admin', 'admin123', 'admin');
```

### 6. Build Assets

```powershell
# Development
npm run dev

# Production
npm run build
```

### 7. Jalankan Server

```powershell
php artisan serve
```

## Akses Aplikasi

- **User Landing Page:** http://localhost:8000
- **User Login:** http://localhost:8000/login
- **Admin Panel:** http://localhost:8000/admin

### Credential Login

#### Admin (Filament)
- Username: `admin`
- Password: `admin123`

#### User Biasa
Gunakan data dari tabel `pengguna` dengan role `penanggung_jawab`:
- Username: `budi`
- Password: `budi123`

## Struktur Folder

```
GILAA/
├── app/
│   ├── Filament/
│   │   ├── Pages/
│   │   │   └── LaporanPeminjaman.php
│   │   └── Resources/
│   │       ├── PenggunaResource.php
│   │       ├── RuanganResource.php
│   │       └── PeminjamanRuanganResource.php
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       ├── HomeController.php
│   │       └── PeminjamanController.php
│   └── Models/
│       ├── Pengguna.php
│       ├── Ruangan.php
│       ├── Kegiatan.php
│       ├── Waktu.php
│       └── PeminjamanRuangan.php
├── database/
│   └── migrations/
│       ├── 2024_01_01_000001_create_sessions_table.php
│       ├── 2024_01_01_000002_create_cache_table.php
│       └── 2024_01_01_000003_create_jobs_table.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── auth/
│   │   │   └── login.blade.php
│   │   ├── peminjaman/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── show.blade.php
│   │   ├── home.blade.php
│   │   └── dashboard.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
└── routes/
    └── web.php
```

## Teknologi

- **Framework:** Laravel 11
- **Admin Panel:** Filament PHP 3
- **CSS:** Tailwind CSS
- **Database:** MySQL (MariaDB)
- **PHP:** ^8.2

## Fitur Database

### Stored Procedures
- `peminjaman_user` - Mendapatkan peminjaman berdasarkan user
- `tambah_peminjaman` - Menambah peminjaman baru
- `update_status` - Update status peminjaman

### Functions
- `cek_status` - Cek status peminjaman
- `total_peminjaman` - Total semua peminjaman
- `TOTAL_USER` - Total user berdasarkan role

### Triggers
- `trg_auto_status_insert` - Set status default 'menunggu'
- `trg_update_ruangan_disetujui` - Update status ruangan saat disetujui
- `trg_update_ruangan_selesai` - Update status ruangan saat selesai
- `after_update_peminjaman` - Log perubahan status

### Views
- `view_peminjaman_3_tabel` - Join 3 tabel
- `view_peminjaman_4_tabel` - Join 4 tabel
- `view_peminjaman_5_tabel` - Join 5 tabel (digunakan di laporan)

## Validasi Form Peminjaman

1. **Durasi minimal:** 2 jam
2. **Jam operasional:** 08:00 - 17:00 WIB
3. **Ruangan:** Harus tersedia
4. **Field required:** Semua field wajib diisi kecuali keterangan

## Status Peminjaman

- **Menunggu** (kuning) - Menunggu approval admin
- **Disetujui** (hijau) - Sudah disetujui, ruangan di-booking
- **Ditolak** (merah) - Ditolak oleh admin
- **Selesai** (abu-abu) - Kegiatan sudah selesai

## Troubleshooting

### Error "Base table or view not found: sessions"
Sudah diatasi dengan migration yang disediakan. Jalankan:
```powershell
php artisan migrate
```

### Error koneksi database
Pastikan:
1. MySQL/MariaDB sudah berjalan
2. Database `projectadm` sudah dibuat dan di-import
3. Credential di `.env` sudah benar

### Assets tidak ter-load
Jalankan:
```powershell
npm run build
```

## Lisensi

MIT License

## Support

Untuk pertanyaan dan dukungan, silakan hubungi tim development.
