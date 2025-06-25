<?php
// filepath: c:\laragon\www\market-it\admin\process\hapus_kontak_saya.php
include '../../koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM kontak_saya WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../kontak_saya.php?hapus=sukses");
        exit();
    } else {
        header("Location: ../kontak_saya.php?hapus=gagal");
        exit();
    }
} else {
    header("Location: ../kontak_saya.php");
    exit();
}