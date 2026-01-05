<?php

try {
    echo "Connecting to MySQL database...\n";
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=projectadm', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "\nCleaning up existing data...\n";
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    
    $tables = ['peminjaman_ruangan', 'kegiatan', 'waktu', 'ruangan', 'pengguna'];
    foreach ($tables as $table) {
        try {
            $pdo->exec("TRUNCATE TABLE $table");
            echo "  ✓ Truncated $table\n";
        } catch (Exception $e) {
            echo "  - Skipped $table (tidak ada)\n";
        }
    }
    
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    
    echo "\nInserting fresh data...\n";
    
    // Insert pengguna
    echo "  - Inserting pengguna...\n";
    $stmt = $pdo->prepare("INSERT INTO pengguna (ID_USER, NAMA_USER, PASSWORD, USERNAME, ROLE) VALUES (?, ?, ?, ?, ?)");
    $data = [
        [1, 'Budi Santoso', 'budi123', 'budi', 'penanggung_jawab'],
        [2, 'Siti Aminah', 'siti123', 'siti', 'penanggung_jawab'],
        [3, 'Andi Wijaya', 'andi123', 'andi', 'penanggung_jawab'],
        [4, 'Muhammad Riduan', 'riduan123', 'riduan', 'penanggung_jawab'],
        [5, 'Admin', 'admin123', 'admin', 'admin'],
    ];
    foreach ($data as $row) {
        $stmt->execute($row);
    }
    
    // Insert ruangan
    echo "  - Inserting ruangan...\n";
    $stmt = $pdo->prepare("INSERT INTO ruangan (ID_RUANGAN, NAMA_RUANGAN, KAPASITAS, LOKASI, FASILITAS, STATUS) VALUES (?, ?, ?, ?, ?, ?)");
    $data = [
        [1, 'Aula Utama', 300, 'Gedung A', 'Sound system, Proyektor, AC', 'tersedia'],
        [2, 'Ruang Rapat 1', 30, 'Gedung B', 'Meja rapat, AC, Proyektor', 'tersedia'],
        [3, 'Ruang Rapat 2', 25, 'Gedung B', 'Meja rapat, AC', 'tersedia'],
        [4, 'GSG', 40, 'Gedung Serba Guna', 'Proyektor, AC', 'tersedia'],
    ];
    foreach ($data as $row) {
        $stmt->execute($row);
    }
    
    // Insert kegiatan
    echo "  - Inserting kegiatan...\n";
    $stmt = $pdo->prepare("INSERT INTO kegiatan (ID_KEGIATAN, NAMA_KEGIATAN, PENANGGUNG_JAWAB, KETERANGAN) VALUES (?, ?, ?, ?)");
    $data = [
        [1, 'Rapat Koordinasi', 'Budi Santoso', 'Rapat koordinasi antar divisi'],
        [2, 'Seminar Nasional', 'Siti Aminah', 'Kegiatan seminar nasional di aula utama'],
        [3, 'Pelatihan Sistem', 'Andi Wijaya', 'Pelatihan penggunaan sistem informasi'],
        [4, 'Mubes', 'Muhammad Riduan', 'Musyawarah Besar HME Poliban'],
    ];
    foreach ($data as $row) {
        $stmt->execute($row);
    }
    
    // Insert waktu
    echo "  - Inserting waktu...\n";
    $stmt = $pdo->prepare("INSERT INTO waktu (ID_WAKTU, TANGGAL, JAM_MULAI, JAM_SELESAI) VALUES (?, ?, ?, ?)");
    $data = [
        [1, '2026-01-10 00:00:00', '2026-01-10 08:00:00', '2026-01-10 10:00:00'],
        [2, '2026-01-11 00:00:00', '2026-01-11 09:00:00', '2026-01-11 11:00:00'],
        [3, '2026-01-12 00:00:00', '2026-01-12 13:00:00', '2026-01-12 15:00:00'],
        [4, '2026-01-13 00:00:00', '2026-01-13 14:00:00', '2026-01-13 16:30:00'],
        [5, '2026-01-15 00:00:00', '2026-01-15 08:00:00', '2026-01-15 10:00:00'],
    ];
    foreach ($data as $row) {
        $stmt->execute($row);
    }
    
    // Insert peminjaman
    echo "  - Inserting peminjaman...\n";
    $stmt = $pdo->prepare("INSERT INTO peminjaman_ruangan (ID_PEMINJAMAN, ID_RUANGAN, ID_KEGIATAN, ID_WAKTU, ID_USER, STATUS) VALUES (?, ?, ?, ?, ?, ?)");
    $data = [
        [1, 1, 1, 1, 1, 'disetujui'],
        [2, 3, 3, 3, 3, 'menunggu'],
        [3, 2, 2, 2, 2, 'selesai'],
    ];
    foreach ($data as $row) {
        $stmt->execute($row);
    }
    
    echo "\n" . str_repeat("=", 55) . "\n";
    echo "✅ DATABASE SETUP BERHASIL!\n";
    echo str_repeat("=", 55) . "\n\n";
    
    // Show credentials
    echo "🔐 KREDENSIAL LOGIN:\n\n";
    echo "🔴 ADMIN PANEL (http://localhost:8080/admin)\n";
    echo "   Username: admin\n";
    echo "   Password: admin123\n\n";
    echo "🟢 USER BIASA (http://localhost:8080/login)\n";
    echo "   Username: budi\n";
    echo "   Password: budi123\n\n";
    
    echo str_repeat("=", 55) . "\n";
    echo "📌 SELANJUTNYA JALANKAN:\n";
    echo "   php artisan serve --port=8080\n";
    echo str_repeat("=", 55) . "\n\n";
    
} catch (PDOException $e) {
    echo "\n❌ ERROR KONEKSI DATABASE:\n";
    echo $e->getMessage() . "\n\n";
    echo "Pastikan:\n";
    echo "  1. MySQL/MariaDB sudah berjalan\n";
    echo "  2. Database 'projectadm' sudah dibuat\n";
    echo "  3. Tabel 'pengguna', 'ruangan', 'kegiatan', 'waktu', 'peminjaman_ruangan' sudah ada\n";
    echo "  4. Kredensial di .env sudah benar\n";
    exit(1);
}
