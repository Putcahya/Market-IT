<?php
require_once '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $star = isset($_POST['status']) ? intval($_POST['status']) : 0;

    $gambar = $_FILES['gambar'];
    $gambar_name = '';
    if ($gambar['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../../assets/img/blog/";
        $gambar_name = basename($gambar['name']);
        $target_file = $target_dir . $gambar_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "<script>alert('Tipe file tidak valid!');window.location.href='../barang.php';</script>";
            exit();
        }
        if (!move_uploaded_file($gambar['tmp_name'], $target_file)) {
            echo "<script>alert('Gagal upload gambar!');window.location.href='../barang.php';</script>";
            exit();
        }
    }

    $query = "INSERT INTO barang (nama_barang, deskripsi, stok, harga, gambar, star) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssiisi", $nama_barang, $deskripsi, $stok, $harga, $gambar_name, $star);

    if (mysqli_stmt_execute($stmt)) {
        session_start();
        $_SESSION['success_message'] = 'Barang berhasil ditambahkan!';
        header("Location: ../barang.php");
        exit();
    } else {
        session_start();
        $_SESSION['success_message'] = 'Gagal menambah barang!';
        header("Location: ../barang.php");
        exit();
    }
}
?>