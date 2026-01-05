# 🔧 TROUBLESHOOTING - Sistem Manajemen Ruangan

Panduan lengkap untuk mengatasi masalah umum yang mungkin terjadi saat instalasi atau menjalankan aplikasi.

---

## 📋 Daftar Isi

1. [Web Tidak Muncul / Blank Page](#web-tidak-muncul--blank-page)
2. [Error "Vite manifest not found"](#error-vite-manifest-not-found)
3. [Error 500 - Internal Server Error](#error-500---internal-server-error)
4. [Database Connection Error](#database-connection-error)
5. [Assets Tidak Ter-load (CSS/JS)](#assets-tidak-ter-load-cssjs)
6. [Port Already in Use](#port-already-in-use)
7. [Composer Install Failed](#composer-install-failed)
8. [NPM Install Failed](#npm-install-failed)
9. [Migration Failed](#migration-failed)
10. [Login Error](#login-error)

---

## Web Tidak Muncul / Blank Page

### Gejala
- Browser menampilkan halaman kosong/blank
- Tidak ada error message yang terlihat
- Halaman loading terus menerus

### Penyebab Umum
1. Assets belum di-build dengan Vite
2. File `.env` belum dikonfigurasi
3. Application key belum di-generate
4. Cache Laravel corrupt

### Solusi

#### Solusi 1: Build Assets
```bash
# Build assets dengan Vite
npm install
npm run build
```

#### Solusi 2: Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

#### Solusi 3: Generate APP_KEY
```bash
php artisan key:generate
```

#### Solusi 4: Check .env File
Pastikan file `.env` ada dan berisi konfigurasi yang benar:
```env
APP_NAME="Sistem Manajemen Ruangan"
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxx
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projectadm
DB_USERNAME=root
DB_PASSWORD=
```

#### Solusi 5: Gunakan CDN Fallback
Aplikasi ini sudah dikonfigurasi dengan CDN fallback. Jika Vite build gagal, Tailwind CSS akan otomatis di-load dari CDN.

---

## Error "Vite manifest not found"

### Gejala
```
Vite manifest not found at: /path/to/public/build/manifest.json
```

### Penyebab
Assets belum di-build atau folder `public/build` tidak ada.

### Solusi

#### Solusi 1: Build Assets (Recommended)
```bash
npm install
npm run build
```

Setelah build berhasil, folder `public/build` akan otomatis dibuat dengan `manifest.json` di dalamnya.

#### Solusi 2: CDN Fallback (Otomatis)
Aplikasi sudah dikonfigurasi untuk menggunakan Tailwind CDN jika `manifest.json` tidak ditemukan. Tidak perlu action tambahan.

#### Solusi 3: Development Mode
Untuk development, gunakan Vite dev server:
```bash
npm run dev
```

Kemudian di terminal terpisah:
```bash
php artisan serve
```

---

## Error 500 - Internal Server Error

### Gejala
- HTTP 500 error di browser
- Error page Laravel atau blank page

### Penyebab Umum
1. File `.env` tidak ada atau salah konfigurasi
2. APP_KEY tidak ada
3. Permission error pada folder storage/cache
4. Database connection error

### Solusi

#### Solusi 1: Check Laravel Log
```bash
# Lihat error log
tail -f storage/logs/laravel.log
```

#### Solusi 2: Fix Permissions (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

#### Solusi 3: Fix Permissions (Windows)
Pastikan folder `storage` dan `bootstrap/cache` tidak read-only.

#### Solusi 4: Debug Mode
Set `APP_DEBUG=true` di file `.env` untuk melihat error detail:
```env
APP_DEBUG=true
```

#### Solusi 5: Reinstall Dependencies
```bash
# Hapus vendor dan reinstall
rm -rf vendor
composer install

# Atau untuk Windows
rmdir /s vendor
composer install
```

---

## Database Connection Error

### Gejala
```
SQLSTATE[HY000] [2002] Connection refused
SQLSTATE[HY000] [1045] Access denied for user
SQLSTATE[HY000] [1049] Unknown database 'projectadm'
```

### Solusi

#### Solusi 1: Check MySQL Service
**Windows (XAMPP):**
- Buka XAMPP Control Panel
- Start Apache dan MySQL

**Windows (MySQL Service):**
```bash
net start MySQL
```

**Linux/Mac:**
```bash
sudo service mysql start
# atau
brew services start mysql
```

#### Solusi 2: Create Database
```sql
CREATE DATABASE projectadm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Solusi 3: Import Database
```bash
# Via command line
mysql -u root -p projectadm < projectadm.sql

# Atau via phpMyAdmin
# Import file projectadm.sql
```

#### Solusi 4: Check Credentials
Periksa file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1          # atau 'localhost'
DB_PORT=3306
DB_DATABASE=projectadm
DB_USERNAME=root           # sesuaikan dengan user MySQL Anda
DB_PASSWORD=               # kosongkan jika tidak ada password
```

#### Solusi 5: Test Connection
```bash
php artisan db:show
```

---

## Assets Tidak Ter-load (CSS/JS)

### Gejala
- Halaman tampil tapi tanpa styling
- Layout berantakan
- JavaScript tidak berfungsi

### Solusi

#### Solusi 1: Build Assets
```bash
npm install
npm run build
```

#### Solusi 2: Check Public Build Folder
```bash
# Check apakah folder public/build ada
ls -la public/build

# Jika tidak ada, build ulang
npm run build
```

#### Solusi 3: Clear Browser Cache
- Chrome: Ctrl + Shift + Delete
- Firefox: Ctrl + Shift + Delete
- Atau buka incognito/private mode

#### Solusi 4: CDN Fallback
Aplikasi akan otomatis menggunakan Tailwind CDN jika build assets gagal.

---

## Port Already in Use

### Gejala
```
Failed to listen on 127.0.0.1:8000 (reason: Address already in use)
```

### Solusi

#### Solusi 1: Gunakan Port Berbeda
```bash
php artisan serve --port=8080
# atau
php artisan serve --port=3000
```

#### Solusi 2: Kill Process (Windows)
```bash
# Cari process yang menggunakan port 8000
netstat -ano | findstr :8000

# Kill process berdasarkan PID
taskkill /PID <PID> /F
```

#### Solusi 3: Kill Process (Linux/Mac)
```bash
# Cari process yang menggunakan port 8000
lsof -i :8000

# Kill process
kill -9 <PID>
```

#### Solusi 4: Gunakan XAMPP/WAMP
Sebagai alternatif, deploy aplikasi ke XAMPP atau WAMP:
1. Copy folder project ke `C:\xampp\htdocs\`
2. Akses via: `http://localhost/nama-folder/public`

---

## Composer Install Failed

### Gejala
```
Your requirements could not be resolved to an installable set of packages
```

### Solusi

#### Solusi 1: Update Composer
```bash
composer self-update
```

#### Solusi 2: Clear Composer Cache
```bash
composer clear-cache
composer install
```

#### Solusi 3: Install dengan Flag
```bash
composer install --ignore-platform-reqs
# atau
composer install --no-scripts
```

#### Solusi 4: Check PHP Version
```bash
php -v
# Pastikan PHP >= 8.2
```

---

## NPM Install Failed

### Gejala
```
npm ERR! code ENOENT
npm ERR! network request failed
```

### Solusi

#### Solusi 1: Clear NPM Cache
```bash
npm cache clean --force
npm install
```

#### Solusi 2: Hapus node_modules dan package-lock.json
```bash
# Linux/Mac
rm -rf node_modules package-lock.json
npm install

# Windows
rmdir /s node_modules
del package-lock.json
npm install
```

#### Solusi 3: Gunakan Yarn (Alternative)
```bash
npm install -g yarn
yarn install
yarn build
```

#### Solusi 4: Check Node Version
```bash
node -v
npm -v
# Pastikan Node >= 18.x
```

---

## Migration Failed

### Gejala
```
SQLSTATE[42S01]: Base table or view already exists
SQLSTATE[HY000]: General error
```

### Solusi

#### Solusi 1: Fresh Migration
```bash
php artisan migrate:fresh
```

⚠️ **WARNING:** Ini akan menghapus semua data di database!

#### Solusi 2: Rollback dan Migrate Ulang
```bash
php artisan migrate:rollback
php artisan migrate
```

#### Solusi 3: Skip Migration (Jika Database Sudah Di-import)
Jika Anda sudah import file `projectadm.sql`, maka:
```bash
# Tandai semua migration sebagai completed
php artisan migrate --pretend
```

Atau skip migration dan langsung jalankan server.

---

## Login Error

### Gejala
- Tidak bisa login meskipun credentials benar
- Error "These credentials do not match our records"
- Redirect ke halaman login terus menerus

### Solusi

#### Solusi 1: Check User di Database
```sql
-- Via MySQL
SELECT * FROM pengguna WHERE USERNAME = 'admin';
```

#### Solusi 2: Create Admin User
```sql
INSERT INTO pengguna (NAMA_USER, USERNAME, PASSWORD, ROLE) 
VALUES ('Admin', 'admin', 'admin123', 'admin');
```

#### Solusi 3: Clear Session
```bash
php artisan session:clear
php artisan cache:clear
```

#### Solusi 4: Check Session Configuration
Di file `.env`:
```env
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

Pastikan tabel `sessions` sudah dibuat:
```bash
php artisan migrate
```

---

## 🆘 Masih Mengalami Masalah?

### Quick Diagnostic
Jalankan perintah ini untuk melihat status aplikasi:
```bash
php artisan about
php artisan config:show
php artisan db:show
```

### Full Reset (Last Resort)
Jika semua solusi di atas tidak berhasil, lakukan full reset:

```bash
# 1. Hapus cache dan compiled files
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
rm -rf bootstrap/cache/*.php

# 2. Reinstall dependencies
rm -rf vendor node_modules
composer install
npm install

# 3. Rebuild environment
cp .env.example .env
php artisan key:generate

# 4. Build assets
npm run build

# 5. Clear dan migrate database
php artisan migrate:fresh

# 6. Start server
php artisan serve
```

### Hubungi Support
Jika masih mengalami masalah:
1. Screenshot error message
2. Copy isi file `storage/logs/laravel.log`
3. Jalankan `php artisan about` dan copy outputnya
4. Hubungi tim development dengan informasi di atas

---

## 📚 Dokumentasi Tambahan

- [README.md](README.md) - Panduan instalasi
- [CARA_JALANKAN_WEB.md](CARA_JALANKAN_WEB.md) - Cara menjalankan web
- [SETUP_DATABASE.md](SETUP_DATABASE.md) - Setup database

---

**Last Updated:** 2026-01-05
