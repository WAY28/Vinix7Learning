<?php
// config.php
// Koneksi ke database sesuai struktur Anda

$host = "localhost";
$port = "3307";  // TAMBAHKAN PORT YANG SUDAH DIUBAH
$user = "root";
$pass = "";
$db   = "db_elearning"; // pastikan nama database Anda menggunakan ini

// Gunakan format host:port untuk koneksi
$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// timezone Indonesia
date_default_timezone_set("Asia/Jakarta");
?>