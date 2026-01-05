# 🆘 SOLUSI: WEB TIDAK BISA DIJALANKAN

## Status Saat Ini

✅ **Sudah Selesai:**
- Laravel framework dan dependencies sudah terinstall
- NPM dependencies sudah terinstall  
- Application key sudah di-generate
- Assets sudah di-build

❌ **Yang Perlu Dipersiapkan:**
- Database dan tabel perlu di-setup manual

---

## 🔧 CARA SETUP DATABASE (PILIH SALAH SATU)

### **OPSI 1: Via phpMyAdmin (PALING MUDAH) ⭐**

1. **Buka phpMyAdmin**
   - Akses: http://localhost/phpmyadmin
   - Atau melalui XAMPP Control Panel → Admin (phpMyAdmin)

2. **Buat Database**
   - Klik "New" atau "Create new database"
   - Nama: `uyuh`
   - Collation: `utf8mb4_general_ci`
   - Klik "Create"

3. **Buat Tabel menggunakan SQL**
   - Klik database `uyuh`
   - Klik tab "SQL"
   - **Copy-paste SQL ini:**

```sql
-- Tabel Pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_USER` varchar(20) NOT NULL,
  `PASSWORD` varchar(12) NOT NULL,
  `USERNAME` varchar(20) NOT NULL UNIQUE,
  `ROLE` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel Ruangan
CREATE TABLE IF NOT EXISTS `ruangan` (
  `ID_RUANGAN` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_RUANGAN` varchar(25) NOT NULL,
  `KAPASITAS` int(11) NOT NULL,
  `LOKASI` varchar(25) NOT NULL,
  `FASILITAS` text DEFAULT NULL,
  `STATUS` varchar(12) NOT NULL DEFAULT 'tersedia',
  PRIMARY KEY (`ID_RUANGAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel Kegiatan
CREATE TABLE IF NOT EXISTS `kegiatan` (
  `ID_KEGIATAN` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_KEGIATAN` varchar(30) NOT NULL,
  `PENANGGUNG_JAWAB` varchar(30) NOT NULL,
  `KETERANGAN` text DEFAULT NULL,
  PRIMARY KEY (`ID_KEGIATAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel Waktu
CREATE TABLE IF NOT EXISTS `waktu` (
  `ID_WAKTU` int(11) NOT NULL AUTO_INCREMENT,
  `TANGGAL` datetime NOT NULL,
  `JAM_MULAI` datetime NOT NULL,
  `JAM_SELESAI` datetime NOT NULL,
  PRIMARY KEY (`ID_WAKTU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel Peminjaman Ruangan
CREATE TABLE IF NOT EXISTS `peminjaman_ruangan` (
  `ID_PEMINJAMAN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_RUANGAN` int(11) NOT NULL,
  `ID_KEGIATAN` int(11) NOT NULL,
  `ID_WAKTU` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `STATUS` varchar(25) NOT NULL DEFAULT 'menunggu',
  PRIMARY KEY (`ID_PEMINJAMAN`),
  KEY `FK_PR_RUANGAN` (`ID_RUANGAN`),
  KEY `FK_PR_KEGIATAN` (`ID_KEGIATAN`),
  KEY `FK_PR_WAKTU` (`ID_WAKTU`),
  KEY `FK_PR_USER` (`ID_USER`),
  CONSTRAINT `FK_PR_KEGIATAN` FOREIGN KEY (`ID_KEGIATAN`) REFERENCES `kegiatan` (`ID_KEGIATAN`),
  CONSTRAINT `FK_PR_RUANGAN` FOREIGN KEY (`ID_RUANGAN`) REFERENCES `ruangan` (`ID_RUANGAN`),
  CONSTRAINT `FK_PR_USER` FOREIGN KEY (`ID_USER`) REFERENCES `pengguna` (`ID_USER`),
  CONSTRAINT `FK_PR_WAKTU` FOREIGN KEY (`ID_WAKTU`) REFERENCES `waktu` (`ID_WAKTU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- INSERT DATA
INSERT INTO pengguna VALUES
(1, 'Budi Santoso', 'budi123', 'budi', 'penanggung_jawab'),
(2, 'Siti Aminah', 'siti123', 'siti', 'penanggung_jawab'),
(3, 'Andi Wijaya', 'andi123', 'andi', 'penanggung_jawab'),
(4, 'Muhammad Riduan', 'riduan123', 'riduan', 'penanggung_jawab'),
(5, 'Admin', 'admin123', 'admin', 'admin');

INSERT INTO ruangan VALUES
(1, 'Aula Utama', 300, 'Gedung A', 'Sound system, Proyektor, AC', 'tersedia'),
(2, 'Ruang Rapat 1', 30, 'Gedung B', 'Meja rapat, AC, Proyektor', 'tersedia'),
(3, 'Ruang Rapat 2', 25, 'Gedung B', 'Meja rapat, AC', 'tersedia'),
(4, 'GSG', 40, 'Gedung Serba Guna', 'Proyektor, AC', 'tersedia');

INSERT INTO kegiatan VALUES
(1, 'Rapat Koordinasi', 'Budi Santoso', 'Rapat koordinasi antar divisi'),
(2, 'Seminar Nasional', 'Siti Aminah', 'Kegiatan seminar nasional di aula utama'),
(3, 'Pelatihan Sistem', 'Andi Wijaya', 'Pelatihan penggunaan sistem informasi'),
(4, 'Mubes', 'Muhammad Riduan', 'Musyawarah Besar HME Poliban');

INSERT INTO waktu VALUES
(1, '2026-01-10 00:00:00', '2026-01-10 08:00:00', '2026-01-10 10:00:00'),
(2, '2026-01-11 00:00:00', '2026-01-11 09:00:00', '2026-01-11 11:00:00'),
(3, '2026-01-12 00:00:00', '2026-01-12 13:00:00', '2026-01-12 15:00:00'),
(4, '2026-01-13 00:00:00', '2026-01-13 14:00:00', '2026-01-13 16:30:00'),
(5, '2026-01-15 00:00:00', '2026-01-15 08:00:00', '2026-01-15 10:00:00');

INSERT INTO peminjaman_ruangan VALUES
(1, 1, 1, 1, 1, 'disetujui'),
(2, 3, 3, 3, 3, 'menunggu'),
(3, 2, 2, 2, 2, 'selesai');
```

4. **Jalankan SQL**
   - Klik tombol "Go"
   - Tunggu sampai selesai

---

### **OPSI 2: Menggunakan XAMPP**

1. **Pastikan MySQL sudah running**
   - Buka XAMPP Control Panel
   - Klik "Start" untuk Apache dan MySQL

2. **Copy folder GILAA ke htdocs**
   ```
   C:\xampp\htdocs\GILAA
   ```

3. **Akses via browser:**
   - http://localhost/phpmyadmin
   - Ikuti opsi 1 di atas

---

## ▶️ MENJALANKAN WEB

### **Setelah database sudah setup:**

**PowerShell:**
```powershell
cd C:\Users\USER\Documents\GILAA
php artisan serve --port=8080
```

**Atau buka browser:**
- http://localhost:8080 (jika port 8080 berhasil)
- http://localhost:8000 (jika port default)

---

## 🔐 LOGIN CREDENTIALS

**Admin Panel:**
- URL: http://localhost:8080/admin
- Username: `admin`
- Password: `admin123`

**User Biasa:**
- URL: http://localhost:8080/login
- Username: `budi`
- Password: `budi123`

---

## ❓ TROUBLESHOOTING

### Error: "Base table or view not found"
**→ Solusi:** Database belum di-setup. Ikuti langkah di atas.

### Error: "SQLSTATE[HY000]"
**→ Solusi:** MySQL belum running. Buka XAMPP dan start MySQL.

### Port sudah terpakai (8080)
**→ Solusi:** 
```powershell
php artisan serve --port=3000
# Atau coba port lain: 8000, 8001, 9000, dst
```

### Assets tidak loading
```powershell
npm run build
```

---

## 📞 BANTUAN

Jika masih ada masalah:
1. Screenshot error yang muncul
2. Pastikan MySQL running
3. Pastikan database `uyuh` sudah ada
4. Periksa file `.env` sudah benar:
   ```
   DB_DATABASE=uyuh
   DB_USERNAME=root
   DB_PASSWORD=
   ```
