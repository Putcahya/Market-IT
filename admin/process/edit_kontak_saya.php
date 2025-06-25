<?php
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nama_perusahaan = mysqli_real_escape_string($conn, $_POST['nama_perusahaan']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = intval($_POST['status']);

    $query = "UPDATE kontak_saya SET 
                nama_perusahaan = '$nama_perusahaan',
                deskripsi = '$deskripsi',
                alamat = '$alamat',
                telepon = '$telepon',
                email = '$email',
                status = '$status'
              WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = 'Kontak saya berhasil diperbarui!';
        header("Location: ../kontak_saya.php?edit=sukses");
        exit();
    } else {
        $_SESSION['success_message'] = 'Kontal saya gagal diperbarui!';
        header("Location: ../kontak_saya.php?edit=gagal");
        exit();
    }
} else {
    header("Location: ../kontak_saya.php");
    exit();
}


if (isset($_SESSION['success_message'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?php echo addslashes($_SESSION['success_message']); ?>',
        confirmButtonText: 'OK'
      });
    });
  </script>
  <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>