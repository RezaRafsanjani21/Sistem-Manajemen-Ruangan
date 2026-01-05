# ⚠️ INSTRUKSI PENTING - JALANKAN WEB

## Status Saat Ini ✅

1. ✅ Dependencies sudah terinstall (Composer + NPM)
2. ✅ Application key sudah di-generate
3. ✅ Assets sudah di-build
4. ❌ **DATABASE BELUM DI-IMPORT** ⬅️ INI MASALAHNYA!

## Langkah-Langkah Menjalankan Web

### 1️⃣ IMPORT DATABASE (WAJIB!)

Anda harus mengimpor file `projectadm.sql` yang ada di folder Downloads ke MySQL:

**Opsi A: Via phpMyAdmin**
1. Buka phpMyAdmin: http://localhost/phpmyadmin
2. Buat database baru bernama `projectadm` (jika belum ada)
3. Pilih database `projectadm`
4. Klik tab "Import"
5. Pilih file: `C:\Users\USER\Downloads\projectadm.sql`
6. Klik "Go"

**Opsi B: Via Command Line MySQL**
```powershell
# Masuk ke folder Downloads
cd C:\Users\USER\Downloads

# Import database
mysql -u root -p projectadm < projectadm.sql
# (Tekan Enter jika tidak ada password)
```

### 2️⃣ TAMBAH USER ADMIN

Setelah database di-import, jalankan seeder untuk membuat user admin:

```powershell
cd C:\Users\USER\Documents\GILAA
php artisan db:seed
```

Atau tambahkan manual via SQL:
```sql
INSERT INTO pengguna (NAMA_USER, USERNAME, PASSWORD, ROLE) 
VALUES ('Admin', 'admin', 'admin123', 'admin');
```

### 3️⃣ JALANKAN SERVER

Pilih salah satu cara:

**Opsi A: Gunakan XAMPP/WAMP (Recommended)**
1. Pastikan Apache dan MySQL sudah running
2. Copy folder `GILAA` ke `C:\xampp\htdocs\` atau `C:\wamp64\www\`
3. Akses via browser: http://localhost/GILAA/public

**Opsi B: PHP Artisan Serve**
```powershell
cd C:\Users\USER\Documents\GILAA

# Coba port berbeda jika port sudah terpakai
php artisan serve --port=8080

# Atau
php artisan serve --port=3000
```

## 🔑 Kredensial Login

### Admin Panel (Filament)
- URL: http://localhost:8080/admin
- Username: `admin`
- Password: `admin123`

### User Login
- URL: http://localhost:8080/login
- Username: `budi`
- Password: `budi123`

## ❌ Troubleshooting

### Error: "Table 'projectadm.pengguna' doesn't exist"
**Penyebab:** Database belum di-import
**Solusi:** Import file `projectadm.sql` dulu (lihat langkah 1)

### Error: "Failed to listen on port"
**Penyebab:** Port sudah digunakan
**Solusi:** 
- Coba port lain: `php artisan serve --port=3000`
- Atau matikan aplikasi yang menggunakan port tersebut
- Atau gunakan XAMPP/WAMP

### Error: "SQLSTATE[HY000] [1045] Access denied"
**Penyebab:** Kredensial database salah di file `.env`
**Solusi:** Periksa dan sesuaikan file `.env`:
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projectadm
DB_USERNAME=root
DB_PASSWORD=
```

### Web blank/error 500
**Solusi:**
```powershell
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📱 Akses Web

Setelah semua langkah di atas selesai:

1. **Landing Page**: http://localhost:8080
2. **User Dashboard**: http://localhost:8080/dashboard
3. **Admin Panel**: http://localhost:8080/admin
4. **Login User**: http://localhost:8080/login

## ✨ Fitur yang Bisa Digunakan

### User Side:
- ✅ Landing page dengan 6 kartu fitur
- ✅ Login user
- ✅ Dashboard dengan statistik
- ✅ Form peminjaman ruangan (validasi 2 jam, jam 08:00-17:00)
- ✅ Riwayat peminjaman
- ✅ Detail peminjaman

### Admin Side:
- ✅ Dashboard admin
- ✅ Manajemen ruangan (CRUD)
- ✅ Manajemen pengguna (CRUD)
- ✅ Manajemen peminjaman (Approve/Reject)
- ✅ Laporan lengkap dari database view

## 🆘 Jika Masih Belum Bisa

Jalankan command ini untuk diagnostik:
```powershell
cd C:\Users\USER\Documents\GILAA
php artisan about
```

Atau hubungi developer dengan screenshot error yang muncul.
