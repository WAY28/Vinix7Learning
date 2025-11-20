<?php
// login_process.php
// Deskripsi: memproses login, memeriksa email & password dari tabel `user`

session_start();
include "config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

$email = trim($_POST['email']);
$password = $_POST['password'];

$stmt = mysqli_prepare($conn, "SELECT id_user, fullname, password FROM `user` WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if ($res && mysqli_num_rows($res) === 1) {
    $row = mysqli_fetch_assoc($res);
    if (password_verify($password, $row['password'])) {
        // set session
        $_SESSION['user_id'] = $row['id_user'];
        $_SESSION['fullname'] = $row['fullname'];
        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: login.php?error=1");
        exit;
    }
} else {
    header("Location: login.php?error=1");
    exit;
}
?>
