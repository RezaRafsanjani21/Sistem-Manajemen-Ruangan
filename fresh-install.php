<?php

try {
    echo "Connecting to MySQL...\n";
    $pdo = new PDO('mysql:host=127.0.0.1', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Dropping existing database...\n";
    $pdo->exec("DROP DATABASE IF EXISTS projectadm");
    
    echo "Creating fresh database...\n";
    $pdo->exec("CREATE DATABASE projectadm DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    
    echo "Selecting database...\n";
    $pdo->exec("USE projectadm");
    
    echo "\nCreating tables...\n";
    
    // Create pengguna table
    echo "- pengguna\n";
    $pdo->exec("
        CREATE TABLE `pengguna` (
          `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
          `NAMA_USER` varchar(20) NOT NULL,
          `PASSWORD` varchar(12) NOT NULL,
          `USERNAME` varchar(20) NOT NULL,
          `ROLE` varchar(20) NOT NULL,
          PRIMARY KEY (`ID_USER`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    
    // Create ruangan table
    echo "- ruangan\n";
    $pdo->exec("
        CREATE TABLE `ruangan` (
          `ID_RUANGAN` int(11) NOT NULL AUTO_INCREMENT,
          `NAMA_RUANGAN` varchar(25) NOT NULL,
          `KAPASITAS` int(11) NOT NULL,
          `LOKASI` varchar(25) NOT NULL,
          `FASILITAS` text DEFAULT NULL,
          `STATUS` varchar(12) NOT NULL,
          PRIMARY KEY (`ID_RUANGAN`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    
    // Create kegiatan table
    echo "- kegiatan\n";
    $pdo->exec("
        CREATE TABLE `kegiatan` (
          `ID_KEGIATAN` int(11) NOT NULL AUTO_INCREMENT,
          `NAMA_KEGIATAN` varchar(30) NOT NULL,
          `PENANGGUNG_JAWAB` varchar(30) NOT NULL,
          `KETERANGAN` text DEFAULT NULL,
          PRIMARY KEY (`ID_KEGIATAN`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    
    // Create waktu table
    echo "- waktu\n";
    $pdo->exec("
        CREATE TABLE `waktu` (
          `ID_WAKTU` int(11) NOT NULL AUTO_INCREMENT,
          `TANGGAL` datetime NOT NULL,
          `JAM_MULAI` datetime NOT NULL,
          `JAM_SELESAI` datetime NOT NULL,
          PRIMARY KEY (`ID_WAKTU`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    
    // Create peminjaman_ruangan table
    echo "- peminjaman_ruangan\n";
    $pdo->exec("
        CREATE TABLE `peminjaman_ruangan` (
          `ID_PEMINJAMAN` int(11) NOT NULL AUTO_INCREMENT,
          `ID_RUANGAN` int(11) NOT NULL,
          `ID_KEGIATAN` int(11) NOT NULL,
          `ID_WAKTU` int(11) NOT NULL,
          `ID_USER` int(11) NOT NULL,
          `STATUS` varchar(25) NOT NULL,
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
    ");
    
    echo "\nInserting sample data...\n";
    
    // Insert users
    echo "- users\n";
    $pdo->exec("
        INSERT INTO `pengguna` VALUES
        (1, 'Budi Santoso', 'budi123', 'budi', 'penanggung_jawab'),
        (2, 'Siti Aminah', 'siti123', 'siti', 'penanggung_jawab'),
        (3, 'Andi Wijaya', 'andi123', 'andi', 'penanggung_jawab'),
        (4, 'Muhammad Riduan', 'riduan123', 'riduan', 'penanggung_jawab'),
        (5, 'Admin', 'admin123', 'admin', 'admin');
    ");
    
    // Insert ruangan
    echo "- ruangan\n";
    $pdo->exec("
        INSERT INTO `ruangan` VALUES
        (1, 'Aula Utama', 300, 'Gedung A', 'Sound system, Proyektor, AC', 'tersedia'),
        (2, 'Ruang Rapat 1', 30, 'Gedung B', 'Meja rapat, AC, Proyektor', 'tersedia'),
        (3, 'Ruang Rapat 2', 25, 'Gedung B', 'Meja rapat, AC', 'tersedia'),
        (4, 'GSG', 40, 'Gedung Serba Guna', 'Proyektor, AC', 'tersedia');
    ");
    
    // Insert kegiatan
    echo "- kegiatan\n";
    $pdo->exec("
        INSERT INTO `kegiatan` VALUES
        (1, 'Rapat Koordinasi', 'Budi Santoso', 'Rapat koordinasi antar divisi'),
        (2, 'Seminar Nasional', 'Siti Aminah', 'Kegiatan seminar nasional di aula utama'),
        (3, 'Pelatihan Sistem', 'Andi Wijaya', 'Pelatihan penggunaan sistem informasi'),
        (4, 'Mubes', 'Muhammad Riduan', 'Musyawarah Besar HME Poliban');
    ");
    
    // Insert waktu
    echo "- waktu\n";
    $pdo->exec("
        INSERT INTO `waktu` VALUES
        (1, '2026-01-10 00:00:00', '2026-01-10 08:00:00', '2026-01-10 10:00:00'),
        (2, '2026-01-11 00:00:00', '2026-01-11 09:00:00', '2026-01-11 11:00:00'),
        (3, '2026-01-12 00:00:00', '2026-01-12 13:00:00', '2026-01-12 15:00:00'),
        (4, '2026-01-13 00:00:00', '2026-01-13 14:00:00', '2026-01-13 16:30:00'),
        (5, '2026-01-15 00:00:00', '2026-01-15 08:00:00', '2026-01-15 10:00:00');
    ");
    
    // Insert peminjaman
    echo "- peminjaman\n";
    $pdo->exec("
        INSERT INTO `peminjaman_ruangan` VALUES
        (1, 1, 1, 1, 1, 'disetujui'),
        (2, 3, 3, 3, 3, 'menunggu'),
        (3, 2, 2, 2, 2, 'selesai');
    ");
    
    echo "\n" . str_repeat("=", 50) . "\n";
    echo "✅ DATABASE BERHASIL DIBUAT!\n";
    echo str_repeat("=", 50) . "\n\n";
    
    // Summary
    $stmt = $pdo->query("SELECT COUNT(*) FROM pengguna");
    echo "📊 Data yang tersimpan:\n";
    echo "   - Pengguna: " . $stmt->fetchColumn() . "\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM ruangan");
    echo "   - Ruangan: " . $stmt->fetchColumn() . "\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM kegiatan");
    echo "   - Kegiatan: " . $stmt->fetchColumn() . "\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM waktu");
    echo "   - Jadwal Waktu: " . $stmt->fetchColumn() . "\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM peminjaman_ruangan");
    echo "   - Peminjaman: " . $stmt->fetchColumn() . "\n\n";
    
    echo "🔐 Kredensial Login:\n\n";
    echo "📱 ADMIN PANEL (http://localhost:8080/admin):\n";
    echo "   Username: admin\n";
    echo "   Password: admin123\n\n";
    echo "👤 USER LOGIN (http://localhost:8080/login):\n";
    echo "   Username: budi\n";
    echo "   Password: budi123\n\n";
    
    echo str_repeat("=", 50) . "\n";
    echo "🚀 Jalankan: php artisan serve --port=8080\n";
    echo str_repeat("=", 50) . "\n";
    
} catch (PDOException $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
