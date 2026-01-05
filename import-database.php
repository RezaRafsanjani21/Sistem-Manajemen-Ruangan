<?php

try {
    echo "Connecting to MySQL...\n";
    $pdo = new PDO('mysql:host=127.0.0.1', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Creating database projectadm...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS projectadm");
    
    echo "Selecting database...\n";
    $pdo->exec("USE projectadm");
    
    echo "Importing SQL file...\n";
    $sqlFile = 'C:/Users/USER/Downloads/projectadm.sql';
    
    if (!file_exists($sqlFile)) {
        die("Error: File $sqlFile tidak ditemukan!\n");
    }
    
    $sql = file_get_contents($sqlFile);
    
    // Split queries
    $queries = array_filter(
        array_map('trim', 
        explode(';', $sql)
    ));
    
    $success = 0;
    $errors = 0;
    
    foreach ($queries as $query) {
        if (empty($query) || strpos($query, '--') === 0) {
            continue;
        }
        
        try {
            $pdo->exec($query);
            $success++;
        } catch (PDOException $e) {
            // Skip errors for already existing objects
            if (strpos($e->getMessage(), 'already exists') === false) {
                $errors++;
                echo "Warning: " . substr($e->getMessage(), 0, 100) . "...\n";
            }
        }
    }
    
    echo "\n=================================\n";
    echo "✅ Import selesai!\n";
    echo "Queries berhasil: $success\n";
    echo "Queries error/skip: $errors\n";
    echo "=================================\n\n";
    
    // Verify tables
    echo "Memeriksa tabel...\n";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tabel yang berhasil dibuat: " . count($tables) . "\n";
    foreach ($tables as $table) {
        echo "  - $table\n";
    }
    
    // Add admin user if not exists
    echo "\nMenambahkan user admin...\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM pengguna WHERE USERNAME = 'admin'");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO pengguna (NAMA_USER, USERNAME, PASSWORD, ROLE) VALUES ('Admin', 'admin', 'admin123', 'admin')");
        echo "✅ User admin berhasil ditambahkan\n";
    } else {
        echo "ℹ️  User admin sudah ada\n";
    }
    
    echo "\n🎉 DATABASE SIAP DIGUNAKAN!\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
