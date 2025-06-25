<?php
// filepath: c:\laragon\www\market-it\admin\process\tambah_kontak.php
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_perusahaan = mysqli_real_escape_string($conn, $_POST['nama_perusahaan']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = intval($_POST['status']);

    $query = "INSERT INTO kontak_saya (nama_perusahaan, deskripsi, alamat, telepon, email, status)
              VALUES ('$nama_perusahaan', '$deskripsi', '$alamat', '$telepon', '$email', '$status')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../kontak_saya.php?tambah=sukses");
        exit();
    } else {
        header("Location: ../kontak_saya.php?tambah=gagal");
        exit();
    }
} else {
    header("Location: ../kontak_saya.php");
    exit();
}