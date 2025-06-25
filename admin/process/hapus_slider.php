<?php
require_once '../../koneksi.php'; // Pastikan path ke koneksi database benar
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data slider berdasarkan ID
    $query = "DELETE FROM slider WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = 'Slider berhasil dihapus!';
        header("Location: ../slider.php");
        exit();
    } else {
        $_SESSION['success_message'] = 'Gagal menghapus slider!';
        header("Location: ../slider.php");
        exit();
    }
} else {
    $_SESSION['success_message'] = 'ID slider tidak ditemukan!';
    header("Location: ../slider.php");
    exit();
}
?>