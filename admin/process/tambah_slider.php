<?php
require_once '../../koneksi.php'; // Pastikan path ke koneksi database benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $title = $_POST['title'];
    $deskripsi = $_POST['deskripsi'];

    // Proses upload gambar
    $gambar = $_FILES['gambar'];
    $target_dir = "../../assets/img/slider/";
    $target_file = $target_dir . basename($gambar['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi tipe file
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        echo "<script>
                alert('Tipe file tidak valid! Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.');
                window.location.href = '../slider.php';
              </script>";
        exit();
    }

    // Pindahkan file ke folder tujuan
    if (!move_uploaded_file($gambar['tmp_name'], $target_file)) {
        echo "<script>
                alert('Gagal mengunggah gambar slider!');
                window.location.href = '../slider.php';
              </script>";
        exit();
    }

    // Simpan data ke database (tambahkan title dan deskripsi)
    $query = "INSERT INTO slider (gambar, title, deskripsi, status) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $gambar['name'], $title, $deskripsi, $status);

    if (mysqli_stmt_execute($stmt)) {
        session_start();
        $_SESSION['success_message'] = 'Gambar berhasil ditambahkan!';
        header("Location: ../slider.php");
        exit();
    } else {
        session_start();
        $_SESSION['success_message'] = 'Gagal menambahkan gambar!';
        header("Location: ../slider.php");
        exit();
    }
}
?>