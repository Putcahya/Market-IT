<?php
include '../../koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM hub_kami WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        // Redirect dengan pesan sukses
        $_SESSION['success_message'] = 'Pesan berhasil dihapus permanen !';
        header("Location: ../pesan.php?hapus=sukses");
        exit;
    } else {
        $_SESSION['success_message'] = 'Pesan gagal dihapus permanen !';
        // Redirect dengan pesan gagal
        header("Location: ../pesan.php?hapus=gagal");
        exit;
    }
} else {
    $_SESSION['success_message'] = 'Pesan tidak ditemukan !';
    header("Location: ../pesan.php");
    exit;
}

?>