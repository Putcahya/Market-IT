<?php
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telepon = mysqli_real_escape_string($conn, $_POST['nomor_telepon']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    // Tambahkan nama produk jika ada
    $produk = isset($_POST['produk']) ? mysqli_real_escape_string($conn, $_POST['produk']) : '';
    if ($produk != '') {
        $pesan = "(Pertanyaan tentang produk: $produk) \nPesan : " . $pesan;
    }

    // Query sesuai struktur tabel kontak (nama_pengirim, email_pengirim, telepon, pesan, time, status)
    $query = "INSERT INTO hub_kami (nama_pengirim, email_pengirim, telepon, pesan, time, status) 
              VALUES ('$nama', '$email', '$telepon', '$pesan', NOW(), 0)";
    if (mysqli_query($conn, $query)) {
        header("Location: ../../index.php?status=sukses#kontak");
        exit;
    } else {
        header("Location: ../../index.php?status=gagal#kontak");
        exit;
    }
} else {
    header("Location: ../../index.php");
    exit;
}
?>