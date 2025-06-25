<?php
require_once '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $star = $_POST['star'];

    $gambar = $_FILES['gambar'];
    if ($gambar['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../../assets/img/blog/";
        $target_file = $target_dir . basename($gambar['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "<script>
                    alert('Tipe file tidak valid! Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.');
                    window.location.href = '../barang.php';
                  </script>";
            exit();
        }

        if (!move_uploaded_file($gambar['tmp_name'], $target_file)) {
            echo "<script>
                    alert('Gagal mengunggah gambar!');
                    window.location.href = '../barang.php';
                  </script>";
            exit();
        }

        // Update data dengan gambar baru
        $query = "UPDATE barang SET nama_barang = ?, deskripsi = ?, stok = ?, harga = ?, gambar = ?, star = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssissii", $nama_barang, $deskripsi, $stok, $harga, $gambar['name'], $star, $id);
    } else {
        // Update data tanpa mengganti gambar
        $query = "UPDATE barang SET nama_barang = ?, deskripsi = ?, stok = ?, harga = ?, star = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssiiii", $nama_barang, $deskripsi, $stok, $harga, $star, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        session_start();
        $_SESSION['success_message'] = 'Barang berhasil diperbarui!';
        header("Location: ../barang.php");
        exit();
    } else {
        session_start();
        $_SESSION['success_message'] = 'Gagal memperbarui barang!';
        header("Location: ../barang.php");
        exit();
    }
}
?>