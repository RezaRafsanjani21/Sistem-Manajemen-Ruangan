<?php

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=projectadm', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Creating table pengguna...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `pengguna` (
          `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
          `NAMA_USER` varchar(20) NOT NULL,
          `PASSWORD` varchar(12) NOT NULL,
          `USERNAME` varchar(20) NOT NULL,
          `ROLE` varchar(20) NOT NULL,
          PRIMARY KEY (`ID_USER`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");
    echo "✅ Table pengguna created\n";
    
    echo "\nInserting sample users...\n";
    $pdo->exec("
        INSERT IGNORE INTO `pengguna` (`ID_USER`, `NAMA_USER`, `PASSWORD`, `USERNAME`, `ROLE`) VALUES
        (1, 'Budi Santoso', 'budi123', 'budi', 'penanggung_jawab'),
        (2, 'Siti Aminah', 'siti123', 'siti', 'penanggung_jawab'),
        (3, 'Andi Wijaya', 'andi123', 'andi', 'penanggung_jawab'),
        (4, 'Muhammad Riduan', 'riduan123', 'riduan', 'penanggung_jawab'),
        (5, 'Admin', 'admin123', 'admin', 'admin');
    ");
    echo "✅ Users inserted\n";
    
    echo "\nChecking other tables...\n";
    
    // Check and fix ruangan
    $stmt = $pdo->query("SELECT COUNT(*) FROM ruangan");
    if ($stmt->fetchColumn() == 0) {
        echo "Inserting ruangan data...\n";
        $pdo->exec("
            INSERT INTO `ruangan` (`ID_RUANGAN`, `NAMA_RUANGAN`, `KAPASITAS`, `LOKASI`, `FASILITAS`, `STATUS`) VALUES
            (1, 'Aula Utama', 300, 'Gedung A', 'Sound system, Proyektor, AC', 'tersedia'),
            (2, 'Ruang Rapat 1', 30, 'Gedung B', 'Meja rapat, AC, Proyektor', 'tersedia'),
            (3, 'Ruang Rapat 2', 25, 'Gedung B', 'Meja rapat, AC', 'tersedia'),
            (4, 'GSG', 40, 'Gedung Serba Guna', 'Proyektor, AC', 'tersedia');
        ");
        echo "✅ Ruangan data inserted\n";
    }
    
    // Check and fix kegiatan
    $stmt = $pdo->query("SELECT COUNT(*) FROM kegiatan");
    if ($stmt->fetchColumn() == 0) {
        echo "Inserting kegiatan data...\n";
        $pdo->exec("
            INSERT INTO `kegiatan` (`ID_KEGIATAN`, `NAMA_KEGIATAN`, `PENANGGUNG_JAWAB`, `KETERANGAN`) VALUES
            (1, 'Rapat Koordinasi', 'Budi Santoso', 'Rapat koordinasi antar divisi'),
            (2, 'Seminar Nasional', 'Siti Aminah', 'Kegiatan seminar nasional di aula utama'),
            (3, 'Pelatihan Sistem', 'Andi Wijaya', 'Pelatihan penggunaan sistem informasi'),
            (4, 'Mubes', 'Muhammad Riduan', 'Musyawarah Besar HME Poliban');
        ");
        echo "✅ Kegiatan data inserted\n";
    }
    
    // Check and fix waktu
    $stmt = $pdo->query("SELECT COUNT(*) FROM waktu");
    if ($stmt->fetchColumn() == 0) {
        echo "Inserting waktu data...\n";
        $pdo->exec("
            INSERT INTO `waktu` (`ID_WAKTU`, `TANGGAL`, `JAM_MULAI`, `JAM_SELESAI`) VALUES
            (1, '2025-01-10 00:00:00', '2025-01-10 08:00:00', '2025-01-10 10:00:00'),
            (2, '2025-01-11 00:00:00', '2025-01-11 09:00:00', '2025-01-11 11:00:00'),
            (3, '2025-01-12 00:00:00', '2025-01-12 13:00:00', '2025-01-12 15:00:00'),
            (4, '2025-01-13 00:00:00', '2025-01-13 14:00:00', '2025-01-13 16:30:00'),
            (5, '2025-01-01 00:00:00', '2025-01-01 08:00:00', '2025-01-01 10:00:00');
        ");
        echo "✅ Waktu data inserted\n";
    }
    
    // Check and fix peminjaman_ruangan
    $stmt = $pdo->query("SELECT COUNT(*) FROM peminjaman_ruangan");
    if ($stmt->fetchColumn() == 0) {
        echo "Inserting sample peminjaman data...\n";
        $pdo->exec("
            INSERT INTO `peminjaman_ruangan` (`ID_PEMINJAMAN`, `ID_RUANGAN`, `ID_KEGIATAN`, `ID_WAKTU`, `ID_USER`, `STATUS`) VALUES
            (1, 1, 1, 1, 1, 'disetujui'),
            (2, 3, 3, 3, 3, 'menunggu'),
            (3, 1, 1, 1, 1, 'selesai');
        ");
        echo "✅ Peminjaman data inserted\n";
    }
    
    echo "\n=================================\n";
    echo "🎉 DATABASE LENGKAP DAN SIAP!\n";
    echo "=================================\n\n";
    
    echo "Kredensial Login:\n";
    echo "Admin:\n";
    echo "  Username: admin\n";
    echo "  Password: admin123\n\n";
    echo "User:\n";
    echo "  Username: budi\n";
    echo "  Password: budi123\n\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
