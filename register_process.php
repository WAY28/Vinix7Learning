<?php
// register_process.php
// Deskripsi: memproses data registrasi, menyimpan ke tabel `db_elearning_user`.

include "config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: register.php");
    exit;
}

$fullname = trim($_POST['fullname']);
$dob = $_POST['dob'];
$email = trim($_POST['email']);
$password = $_POST['password'];

// Validasi dasar
if (!$fullname || !$dob || !$email || !$password) {
    header("Location: register.php?error=" . urlencode("Semua field wajib diisi."));
    exit;
}

// 1. Cek apakah email sudah terdaftar
// Menggunakan nama tabel `db_elearning_user` sesuai ERD Anda
$stmtC = mysqli_prepare($conn, "SELECT id_user FROM `user` WHERE email = ?");
mysqli_stmt_bind_param($stmtC, "s", $email);
mysqli_stmt_execute($stmtC);
$resC = mysqli_stmt_get_result($stmtC);

if ($resC && mysqli_num_rows($resC) > 0) {
    mysqli_stmt_close($stmtC); // Tutup statement cek email
    header("Location: register.php?error=" . urlencode("Email sudah terdaftar."));
    exit;
}
mysqli_stmt_close($stmtC); // Tutup statement cek email jika email belum terdaftar

// 2. Hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

// 3. Insert user baru
// Menggunakan nama tabel `db_elearning_user` sesuai ERD Anda
$stmt = mysqli_prepare($conn, "INSERT INTO `user` (fullname, dob, email, password, created_at) VALUES (?, ?, ?, ?, NOW())");

// Cek jika prepared statement gagal (misalnya, masalah koneksi atau query salah)
if ($stmt === false) {
    error_log("MySQLi Prepare Error: " . mysqli_error($conn));
    header("Location: register.php?error=" . urlencode("Kesalahan database internal."));
    exit;
}

mysqli_stmt_bind_param($stmt, "ssss", $fullname, $dob, $email, $hash);
$ok = mysqli_stmt_execute($stmt);

if ($ok) {
    mysqli_stmt_close($stmt); // Tutup statement insert
    header("Location: login.php?registered=1");
    exit;
} else {
    // Menampilkan error database jika insert gagal (hanya untuk debugging, hapus di production)
    // error_log("MySQLi Execute Error: " . mysqli_stmt_error($stmt));
    mysqli_stmt_close($stmt); // Tutup statement insert
    header("Location: register.php?error=" . urlencode("Registrasi gagal. Silakan coba lagi."));
    exit;
}
?>