<?php include 'layouts/header_admin.php'; ?>
<?php

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil username dari session
$username = $_SESSION['username'];

// Query untuk mengambil data pengguna berdasarkan username
$query = "SELECT * FROM user WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Ambil data pengguna
$user = mysqli_fetch_assoc($result);
if (!$user) {
    echo "Data pengguna tidak ditemukan.";
    exit();
}
?>

<?php
// Tampilkan alert jika ada error
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'wrong_password') {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Password Tidak Sesuai !',
                text: 'Periksa kembali password lama anda.',
                });
        </script>";
    } elseif ($_GET['error'] === 'password_mismatch') {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Password Tidak Sesuai !',
                text: 'Periksa kembali password baru dan konfirmasi password anda.',
                });
        </script>";
    } elseif ($_GET['error'] === 'invalid_file_type') {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Tipe file tidak valid!',
                text: 'Hanya diperbolehkan JPG, JPEG, PNG, dan GIF.',
                });
        </script>";
    } elseif ($_GET['error'] === 'upload_failed') {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal mengunggah foto!',
                });
        </script>";
    } elseif ($_GET['error'] === 'update_failed') {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal memperbarui data! Silakan coba lagi.',
                });
        </script>";
    }
}

// Tampilkan alert jika update berhasil
if (isset($_GET['success']) && $_GET['success'] === '1') {
    echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil !',
                text: 'Profile berhasil diperbarui',
                });
        </script>";
}
?>
<div class="row">
    <!-- Kolom Kiri -->
    <div class="col-md-4 col-12 pt-3">
        <div class="card author-box h-100">
            <div class="card-body">
                <div class="author-box-center">
                    <img alt="image" src="../assets/img/users/<?php echo $user['foto_profile']?>"
                        class="rounded-circle author-box-picture">
                    <div class="clearfix"></div>
                    <div class="author-box-name">
                        <a href="#"><?php echo htmlspecialchars($user['nama']); ?></a>
                    </div>
                    <div class="author-box-job"><?php echo htmlspecialchars($user['alamat']); ?></div>
                </div>
                <div class="text-center">
                    <div class="author-box-description">
                        <p>Selamat datang di halaman profil Anda.</p>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 150px;">Full Name</th>
                                    <td><?php echo htmlspecialchars($user['nama']); ?></td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td><?php echo htmlspecialchars($user['telepon']); ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><?php echo htmlspecialchars($user['alamat']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan -->
    <div class="col-md-8 col-12 pt-3">
        <div class="card h-100">
            <h4 class="text-center p-4">Form Ubah Profile</h4>
            <div class="card-body">
                <form action="process/ubah_profile.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNama">Full Name</label>
                            <input type="text" class="form-control" id="inputNama" name="nama"
                                value="<?php echo htmlspecialchars($user['nama']); ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name="email"
                                value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputTelepon">Telepon</label>
                            <input type="text" class="form-control" id="inputTelepon" name="telepon"
                                value="<?php echo htmlspecialchars($user['telepon']); ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAlamat">Alamat</label>
                            <input type="text" class="form-control" id="inputAlamat" name="alamat"
                                value="<?php echo htmlspecialchars($user['alamat']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputUsername">Username</label>
                            <input type="text" class="form-control" id="inputUsername" name="username"
                                value="<?php echo htmlspecialchars($user['username']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputFotoProfile">Foto Profile</label>
                            <input type="file" class="form-control" id="inputFotoProfile" name="fotoProfile"
                                value="<?php echo htmlspecialchars($user['foto_profile']); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassLama">Password Lama</label>
                            <?php if (isset($_GET['error']) && $_GET['error'] === 'wrong_password') {
                                echo "<strong><small class='text-danger'>  (Password Lama Tidak Akurat)</small></strong>";
                            }
                            ?>
                            <input type="password" class="form-control" id="inputPassLama" name="pass_lama" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassBaru">Password Baru</label>
                            <input type="password" class="form-control" id="inputPassBaru" name="pass_baru">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputKonfirmPassBaru">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="inputKonfirmPassBaru"
                                name="konfirm_pass_baru">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 text-right">
                        <button type="button" class="btn btn-danger" onclick="history.back()">Kembali</button>                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- General JS Scripts -->
<script src="../assets/js/app.min.js"></script>
<!-- JS Libraies -->
<script src="../assets/bundles/prism/prism.js"></script>
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="../assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="../assets/js/custom.js"></script>
</body>


<!-- modal.html  21 Nov 2019 03:54:30 GMT -->

</html>