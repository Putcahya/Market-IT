<?php
require_once '../../koneksi.php'; // Pastikan path ke koneksi database benar
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data barang berdasarkan ID
    $query = "DELETE FROM barang WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = 'Barang berhasil dihapus!';
        header("Location: ../barang.php");
        exit();
    } else {
        $_SESSION['success_message'] = 'Gagal menghapus barang!';
        header("Location: ../barang.php");
        exit();
    }
} else {
    $_SESSION['success_message'] = 'ID barang tidak ditemukan!';
    header("Location: ../barang.php");
    exit();
}
?>