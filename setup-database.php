<?php

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=projectadm', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Dropping and recreating tables...\n\n";
    
    // Drop tables if exist (in correct order due to foreign keys)
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("DROP TABLE IF EXISTS peminjaman_ruangan");
    $pdo->exec("DROP TABLE IF EXISTS kegiatan");
    $pdo->exec("DROP TABLE IF EXISTS waktu");
    $pdo->exec("DROP TABLE IF EXISTS ruangan");
    $pdo->exec("DROP TABLE IF EXISTS pengguna");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    
    // Create pengguna table
    echo "Creating pengguna table...\n";
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
    echo "Creating ruangan table...\n";
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
    echo "Creating kegiatan table...\n";
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
    echo "Creating waktu table...\n";
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
    echo "Creating peminjaman_ruangan table...\n";
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
    
    echo "\n✅ All tables created successfully!\n\n";
    
    // Insert data
    echo "Inserting data...\n\n";
    
    // Insert users
    echo "- Inserting users...\n";
    $pdo->exec("
        INSERT INTO `pengguna` (`ID_USER`, `NAMA_USER`, `PASSWORD`, `USERNAME`, `ROLE`) VALUES
        (1, 'Budi Santoso', 'budi123', 'budi', 'penanggung_jawab'),
        (2, 'Siti Aminah', 'siti123', 'siti', 'penanggung_jawab'),
        (3, 'Andi Wijaya', 'andi123', 'andi', 'penanggung_jawab'),
        (4, 'Muhammad Riduan', 'riduan123', 'riduan', 'penanggung_jawab'),
        (5, 'Admin', 'admin123', 'admin', 'admin');
    ");
    
    // Insert ruangan
    echo "- Inserting ruangan...\n";
    $pdo->exec("
        INSERT INTO `ruangan` (`ID_RUANGAN`, `NAMA_RUANGAN`, `KAPASITAS`, `LOKASI`, `FASILITAS`, `STATUS`) VALUES
        (1, 'Aula Utama', 300, 'Gedung A', 'Sound system, Proyektor, AC', 'tersedia'),
        (2, 'Ruang Rapat 1', 30, 'Gedung B', 'Meja rapat, AC, Proyektor', 'tersedia'),
        (3, 'Ruang Rapat 2', 25, 'Gedung B', 'Meja rapat, AC', 'tersedia'),
        (4, 'GSG', 40, 'Gedung Serba Guna', 'Proyektor, AC', 'tersedia');
    ");
    
    // Insert kegiatan
    echo "- Inserting kegiatan...\n";
    $pdo->exec("
        INSERT INTO `kegiatan` (`ID_KEGIATAN`, `NAMA_KEGIATAN`, `PENANGGUNG_JAWAB`, `KETERANGAN`) VALUES
        (1, 'Rapat Koordinasi', 'Budi Santoso', 'Rapat koordinasi antar divisi'),
        (2, 'Seminar Nasional', 'Siti Aminah', 'Kegiatan seminar nasional di aula utama'),
        (3, 'Pelatihan Sistem', 'Andi Wijaya', 'Pelatihan penggunaan sistem informasi'),
        (4, 'Mubes', 'Muhammad Riduan', 'Musyawarah Besar HME Poliban');
    ");
    
    // Insert waktu
    echo "- Inserting waktu...\n";
    $pdo->exec("
        INSERT INTO `waktu` (`ID_WAKTU`, `TANGGAL`, `JAM_MULAI`, `JAM_SELESAI`) VALUES
        (1, '2026-01-10 00:00:00', '2026-01-10 08:00:00', '2026-01-10 10:00:00'),
        (2, '2026-01-11 00:00:00', '2026-01-11 09:00:00', '2026-01-11 11:00:00'),
        (3, '2026-01-12 00:00:00', '2026-01-12 13:00:00', '2026-01-12 15:00:00'),
        (4, '2026-01-13 00:00:00', '2026-01-13 14:00:00', '2026-01-13 16:30:00'),
        (5, '2026-01-15 00:00:00', '2026-01-15 08:00:00', '2026-01-15 10:00:00');
    ");
    
    // Insert peminjaman
    echo "- Inserting peminjaman...\n";
    $pdo->exec("
        INSERT INTO `peminjaman_ruangan` (`ID_PEMINJAMAN`, `ID_RUANGAN`, `ID_KEGIATAN`, `ID_WAKTU`, `ID_USER`, `STATUS`) VALUES
        (1, 1, 1, 1, 1, 'disetujui'),
        (2, 3, 3, 3, 3, 'menunggu'),
        (3, 2, 2, 2, 2, 'selesai');
    ");
    
    echo "\n✅ All data inserted successfully!\n\n";
    
    echo "=================================\n";
    echo "🎉 DATABASE SIAP DIGUNAKAN!\n";
    echo "=================================\n\n";
    
    echo "📊 Summary:\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM pengguna");
    echo "- Users: " . $stmt->fetchColumn() . "\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM ruangan");
    echo "- Ruangan: " . $stmt->fetchColumn() . "\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM kegiatan");
    echo "- Kegiatan: " . $stmt->fetchColumn() . "\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM waktu");
    echo "- Waktu: " . $stmt->fetchColumn() . "\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM peminjaman_ruangan");
    echo "- Peminjaman: " . $stmt->fetchColumn() . "\n\n";
    
    echo "🔑 Login Credentials:\n";
    echo "\nAdmin Panel (/admin):\n";
    echo "  Username: admin\n";
    echo "  Password: admin123\n\n";
    echo "User Login (/login):\n";
    echo "  Username: budi\n";
    echo "  Password: budi123\n\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
