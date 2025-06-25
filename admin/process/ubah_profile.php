<?php
session_start();
require_once '../../koneksi.php'; // Pastikan path ke koneksi database benar

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil data dari form
$username = $_POST['username'];
$pass_lama = $_POST['pass_lama'];
$pass_baru = $_POST['pass_baru'];
$konfirm_pass_baru = $_POST['konfirm_pass_baru'];
$fotoProfile = $_FILES['fotoProfile'];

// Ambil username dari session
$current_username = $_SESSION['username'];

// Query untuk mendapatkan data pengguna berdasarkan username
$query = "SELECT * FROM user WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $current_username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// Periksa apakah password lama diisi
if (!empty($pass_lama)) {
    // Periksa apakah password lama cocok
    if (sha1($pass_lama) !== $user['password']) {
        header("Location: ../profile.php?error=wrong_password");
        exit();
    }

    // Periksa apakah password baru diisi
    if (!empty($pass_baru) && !empty($konfirm_pass_baru)) {
        // Periksa apakah password baru dan konfirmasi password cocok
        if ($pass_baru !== $konfirm_pass_baru) {
            header("Location: ../profile.php?error=password_mismatch");
            exit();
        }

        // Hash password baru
        $hashed_password = sha1($pass_baru);
    } else {
        // Jika password baru tidak diisi, gunakan password lama
        $hashed_password = $user['password'];
    }
} else {
    // Jika password lama tidak diisi, tampilkan error
    header("Location: ../profile.php?error=missing_old_password");
    exit();
}

// Proses upload foto
if (isset($_FILES['fotoProfile']) && $_FILES['fotoProfile']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "../../assets/img/users/";
    $target_file = $target_dir . basename($_FILES['fotoProfile']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi tipe file
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        header("Location: ../profile.php?error=invalid_file_type");
        exit();
    }

    // Pindahkan file ke folder tujuan
    if (!move_uploaded_file($_FILES['fotoProfile']['tmp_name'], $target_file)) {
        header("Location: ../profile.php?error=upload_failed");
        exit();
    }

    // Update foto di database
    $foto_path =     basename($_FILES['fotoProfile']['name']);
} else {
    // Jika tidak ada foto yang diupload, gunakan foto lama
    $foto_path = $user['foto_profile'];
}

// Update data pengguna di database
$query = "UPDATE user SET username = ?, password = ?, foto_profile = ? WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ssss", $username, $hashed_password, $foto_path, $current_username);

if (mysqli_stmt_execute($stmt)) {
    // Perbarui session username jika username diubah
    $_SESSION['username'] = $username;

    // Redirect ke halaman profil dengan pesan sukses
    header("Location: ../profile.php?success=1");
    exit();
} else {
    // Redirect ke halaman profil dengan pesan error
    header("Location: ../profile.php?error=update_failed");
    exit();
}
?>