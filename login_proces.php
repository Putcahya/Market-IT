<?php
session_start();
require_once 'koneksi.php'; // Menghubungkan ke database

// Ambil data dari form login
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Hash password menggunakan sha1
$hashed_password = sha1($password);

// Query untuk memeriksa username dan password
$query = "SELECT * FROM user WHERE username = ? AND password = ?";
$stmt = mysqli_prepare($conn, $query);
if ($stmt === false) {
    die("Error preparing statement: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    // Set session
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['is_logged_in'] = true;

    // Redirect ke dashboard
    header("Location: admin/dashboard.php?success=login_success");
    exit();
}

// Jika login gagal
header("Location: login.php?error=login_gagal");
exit();
?>