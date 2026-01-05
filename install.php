<?php

try {
    echo "🔄 DATABASE SETUP - STEP 1: CREATE TABLES\n";
    echo str_repeat("=", 55) . "\n\n";
    
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=projectadm', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Membuat tabel-tabel...\n\n";
    
    // Create pengguna
    echo "1. Creating table 'pengguna'...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `pengguna` (
          `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
          `NAMA_USER` varchar(20) NOT NULL,
          `PASSWORD` varchar(12) NOT NULL,
          `USERNAME` varchar(20) NOT NULL,
          `ROLE` varchar(20) NOT NULL,
          PRIMARY KEY (`ID_USER`),
          UNIQUE KEY `USERNAME` (`USERNAME`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ");
    echo "   ✓ Tabel pengguna siap\n\n";
    
    // Create ruangan
    echo "2. Creating table 'ruangan'...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `ruangan` (
          `ID_RUANGAN` int(11) NOT NULL AUTO_INCREMENT,
          `NAMA_RUANGAN` varchar(25) NOT NULL,
          `KAPASITAS` int(11) NOT NULL,
          `LOKASI` varchar(25) NOT NULL,
          `FASILITAS` text DEFAULT NULL,
          `STATUS` varchar(12) NOT NULL DEFAULT 'tersedia',
          PRIMARY KEY (`ID_RUANGAN`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ");
    echo "   ✓ Tabel ruangan siap\n\n";
    
    // Create kegiatan
    echo "3. Creating table 'kegiatan'...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `kegiatan` (
          `ID_KEGIATAN` int(11) NOT NULL AUTO_INCREMENT,
          `NAMA_KEGIATAN` varchar(30) NOT NULL,
          `PENANGGUNG_JAWAB` varchar(30) NOT NULL,
          `KETERANGAN` text DEFAULT NULL,
          PRIMARY KEY (`ID_KEGIATAN`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ");
    echo "   ✓ Tabel kegiatan siap\n\n";
    
    // Create waktu
    echo "4. Creating table 'waktu'...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `waktu` (
          `ID_WAKTU` int(11) NOT NULL AUTO_INCREMENT,
          `TANGGAL` datetime NOT NULL,
          `JAM_MULAI` datetime NOT NULL,
          `JAM_SELESAI` datetime NOT NULL,
          PRIMARY KEY (`ID_WAKTU`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ");
    echo "   ✓ Tabel waktu siap\n\n";
    
    // Create peminjaman_ruangan
    echo "5. Creating table 'peminjaman_ruangan'...\n";
    $pdo->exec("
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
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ");
    echo "   ✓ Tabel peminjaman_ruangan siap\n\n";
    
    echo str_repeat("=", 55) . "\n";
    echo "✅ SEMUA TABEL BERHASIL DIBUAT!\n";
    echo str_repeat("=", 55) . "\n\n";
    
    // Now insert data
    echo "🔄 STEP 2: INSERT DATA\n";
    echo str_repeat("=", 55) . "\n\n";
    
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    
    // Clear existing data
    $pdo->exec("DELETE FROM peminjaman_ruangan");
    $pdo->exec("DELETE FROM kegiatan");
    $pdo->exec("DELETE FROM waktu");
    $pdo->exec("DELETE FROM ruangan");
    $pdo->exec("DELETE FROM pengguna");
    
    // Insert pengguna
    echo "Inserting pengguna...\n";
    $pdo->exec("
        INSERT INTO pengguna VALUES
        (1, 'Budi Santoso', 'budi123', 'budi', 'penanggung_jawab'),
        (2, 'Siti Aminah', 'siti123', 'siti', 'penanggung_jawab'),
        (3, 'Andi Wijaya', 'andi123', 'andi', 'penanggung_jawab'),
        (4, 'Muhammad Riduan', 'riduan123', 'riduan', 'penanggung_jawab'),
        (5, 'Admin', 'admin123', 'admin', 'admin')
    ");
    echo "✓ 5 pengguna ditambahkan\n\n";
    
    // Insert ruangan
    echo "Inserting ruangan...\n";
    $pdo->exec("
        INSERT INTO ruangan VALUES
        (1, 'Aula Utama', 300, 'Gedung A', 'Sound system, Proyektor, AC', 'tersedia'),
        (2, 'Ruang Rapat 1', 30, 'Gedung B', 'Meja rapat, AC, Proyektor', 'tersedia'),
        (3, 'Ruang Rapat 2', 25, 'Gedung B', 'Meja rapat, AC', 'tersedia'),
        (4, 'GSG', 40, 'Gedung Serba Guna', 'Proyektor, AC', 'tersedia')
    ");
    echo "✓ 4 ruangan ditambahkan\n\n";
    
    // Insert kegiatan
    echo "Inserting kegiatan...\n";
    $pdo->exec("
        INSERT INTO kegiatan VALUES
        (1, 'Rapat Koordinasi', 'Budi Santoso', 'Rapat koordinasi antar divisi'),
        (2, 'Seminar Nasional', 'Siti Aminah', 'Kegiatan seminar nasional di aula utama'),
        (3, 'Pelatihan Sistem', 'Andi Wijaya', 'Pelatihan penggunaan sistem informasi'),
        (4, 'Mubes', 'Muhammad Riduan', 'Musyawarah Besar HME Poliban')
    ");
    echo "✓ 4 kegiatan ditambahkan\n\n";
    
    // Insert waktu
    echo "Inserting waktu...\n";
    $pdo->exec("
        INSERT INTO waktu VALUES
        (1, '2026-01-10 00:00:00', '2026-01-10 08:00:00', '2026-01-10 10:00:00'),
        (2, '2026-01-11 00:00:00', '2026-01-11 09:00:00', '2026-01-11 11:00:00'),
        (3, '2026-01-12 00:00:00', '2026-01-12 13:00:00', '2026-01-12 15:00:00'),
        (4, '2026-01-13 00:00:00', '2026-01-13 14:00:00', '2026-01-13 16:30:00'),
        (5, '2026-01-15 00:00:00', '2026-01-15 08:00:00', '2026-01-15 10:00:00')
    ");
    echo "✓ 5 jadwal waktu ditambahkan\n\n";
    
    // Insert peminjaman
    echo "Inserting peminjaman...\n";
    $pdo->exec("
        INSERT INTO peminjaman_ruangan VALUES
        (1, 1, 1, 1, 1, 'disetujui'),
        (2, 3, 3, 3, 3, 'menunggu'),
        (3, 2, 2, 2, 2, 'selesai')
    ");
    echo "✓ 3 peminjaman ditambahkan\n\n";
    
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    
    echo str_repeat("=", 55) . "\n";
    echo "✅ SEMUA DATA BERHASIL DIINPUT!\n";
    echo str_repeat("=", 55) . "\n\n";
    
    echo "🔑 LOGIN CREDENTIALS:\n\n";
    echo "👑 ADMIN PANEL (http://localhost:8080/admin)\n";
    echo "   Username: admin\n";
    echo "   Password: admin123\n\n";
    echo "👤 USER BIASA (http://localhost:8080/login)\n";
    echo "   Username: budi\n";
    echo "   Password: budi123\n\n";
    
    echo str_repeat("=", 55) . "\n";
    echo "🚀 UNTUK MENJALANKAN SERVER:\n";
    echo "   php artisan serve --port=8080\n";
    echo str_repeat("=", 55) . "\n";
    
} catch (PDOException $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n\n";
    echo "Penyebab:\n";
    echo "- Database 'projectadm' belum dibuat\n";
    echo "- MySQL/MariaDB tidak berjalan\n";
    echo "- Kredensial wrong\n\n";
    exit(1);
}
