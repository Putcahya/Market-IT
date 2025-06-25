<?php
require_once '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $title = $_POST['title'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar'];
    if ($gambar['error'] === UPLOAD_ERR_OK && $gambar['name'] != '') {
        $target_dir = "../../assets/img/slider/";
        $target_file = $target_dir . basename($gambar['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "<script>
                    alert('Tipe file tidak valid! Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.');
                    window.location.href = '../slider.php';
                  </script>";
            exit();
        }

        if (!move_uploaded_file($gambar['tmp_name'], $target_file)) {
            echo "<script>
                    alert('Gagal mengunggah gambar!');
                    window.location.href = '../slider.php';
                  </script>";
            exit();
        }

        // Update data dengan gambar baru, title, dan deskripsi
        $query = "UPDATE slider SET gambar = ?, title = ?, deskripsi = ?, status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssii", $gambar['name'], $title, $deskripsi, $status, $id);
    } else {
        // Update data tanpa mengganti gambar, hanya title dan deskripsi
        $query = "UPDATE slider SET title = ?, deskripsi = ?, status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssii", $title, $deskripsi, $status, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        session_start();
        $_SESSION['success_message'] = 'Slider berhasil diperbarui!';
        header("Location: ../slider.php");
        exit();
    } else {
        session_start();
        $_SESSION['success_message'] = 'Gagal memperbarui slider!';
        header("Location: ../slider.php");
        exit();
    }
}
?>