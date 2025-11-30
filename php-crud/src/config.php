<?php

$host = 'localhost';
$database = 'crud_app';
$username = 'root';
$password = 'pensil19';

// Membentuk DSN untuk koneksi PDO
$connectionString = "mysql:host={$host};dbname={$database};charset=utf8mb4";

// Opsi konfigurasi PDO
$pdoConfig = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    // Inisialisasi koneksi database
    $pdo = new PDO($connectionString, $username, $password, $pdoConfig);
} catch (PDOException $error) {
    // Jika gagal, tampilkan pesan error
    exit('Koneksi database gagal: ' . $error->getMessage());
}