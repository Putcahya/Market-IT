<?php include 'layouts/header_admin.php'; ?>
<?php
require_once '../koneksi.php'; // Pastikan path ke koneksi database benar

// Query untuk mengambil data dari tabel barang
$query = "SELECT * FROM kontak_saya";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Ambil semua data sebagai array
$pesan = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<style>
    .modal {
        z-index: 1050 !important;
    }

    .modal-backdrop {
        z-index: 1040 !important;
    }
</style>
<?php
// Tampilkan alert jika update berhasil
if (isset($_GET['success']) && $_GET['success'] === '1') {
    echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil !',
                text: 'Kontak saya telah berhasil dihapus permanen.',
                });
        </script>";
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center my-3">
                    <h4>Kontak Saya</h4>
                    <!-- Tombol Tambah Kontak Saya -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKontakModal">
                        <i class="bi bi-plus"></i> Tambah Kontak
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Deskripsi</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($pesan as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama_perusahaan']) ?></td>
                                    <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                                    <td><?= htmlspecialchars($row['telepon']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td>
                                        <?php if ($row['status'] == 0): ?>
                                        <span class='badge bg-danger text-light'>Off</span>
                                        <?php elseif ($row['status'] == 1): ?>
                                        <span class='badge bg-success text-light'>On</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class='d-flex justify-content-center'>
                                            <!-- Tombol Edit -->
                                            <button type='button' class='btn btn-warning btn-sm mr-1'
                                                data-bs-toggle='modal'
                                                data-bs-target='#editKontakModal<?= $row['id'] ?>'>
                                                <i class='bi bi-pencil'></i>
                                            </button>
                                            <!-- Tombol Hapus -->
                                            <button type='button' class='btn btn-danger btn-sm'
                                                onclick='confirmDelete(<?= $row['id'] ?>)'>
                                                <i class='bi bi-trash'></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>


                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pesan akan dihapus permanen !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke file hapus_barang.php dengan parameter id
                window.location.href = 'process/hapus_kontak_saya.php?id=' + id;
            }
        });
    }
</script>

</div>
</section>
</div>


<?php if (isset($_GET['hapus'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: '<?= $_GET['hapus'] == 'sukses' ? 'success' : 'error' ?>',
            title: '<?= $_GET['hapus'] == 'sukses' ? 'Berhasil!' : 'Gagal!' ?>',
            text: '<?= $_GET['hapus'] == 'sukses' ? 'Pesan berhasil dihapus.' : 'Pesan gagal dihapus.' ?>',
            timer: 2000,
            showConfirmButton: true
        });
    });
</script>
<?php endif; ?>

<?php if (isset($_GET['edit'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        icon: '<?= $_GET['edit'] == 'sukses' ? 'success' : 'error' ?>',
        title: '<?= $_GET['edit'] == 'sukses' ? 'Berhasil!' : 'Gagal!' ?>',
        text: '<?= $_GET['edit'] == 'sukses' ? 'Kontak saya berhasil diperbarui!' : 'Kontak saya gagal diperbarui!' ?>',
        timer: 2000,
        showConfirmButton: true
      });
    });
  </script>
<?php endif; ?>

<?php foreach ($pesan as $row): ?>
<!-- Modal Edit Kontak Saya -->
<div class="modal fade" id="editKontakModal<?= $row['id'] ?>" tabindex="-1"
    aria-labelledby="editKontakModalLabel<?= $row['id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="process/edit_kontak_saya.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKontakModalLabel<?= $row['id'] ?>">Edit Kontak Saya</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="mb-3">
                        <label for="nama_perusahaan<?= $row['id'] ?>" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_perusahaan<?= $row['id'] ?>"
                            name="nama_perusahaan" value="<?= htmlspecialchars($row['nama_perusahaan']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi<?= $row['id'] ?>" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi<?= $row['id'] ?>" name="deskripsi"
                            required><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="alamat<?= $row['id'] ?>" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat<?= $row['id'] ?>" name="alamat"
                            value="<?= htmlspecialchars($row['alamat']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon<?= $row['id'] ?>" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telepon<?= $row['id'] ?>" name="telepon"
                            value="<?= htmlspecialchars($row['telepon']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email<?= $row['id'] ?>" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email<?= $row['id'] ?>" name="email"
                            value="<?= htmlspecialchars($row['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="status<?= $row['id'] ?>" class="form-label">Status</label>
                        <select class="form-control" id="status<?= $row['id'] ?>" name="status" required>
                            <option value="1" <?= $row['status'] == 1 ? 'selected' : '' ?>>On</option>
                            <option value="0" <?= $row['status'] == 0 ? 'selected' : '' ?>>Off</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Modal Tambah Kontak Saya -->
<div class="modal fade" id="tambahKontakModal" tabindex="-1" aria-labelledby="tambahKontakModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="process/tambah_kontak_saya.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahKontakModalLabel">Tambah Kontak Saya</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="nama_perusahaan_tambah" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control" id="nama_perusahaan_tambah" name="nama_perusahaan" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi_tambah" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi_tambah" name="deskripsi" required></textarea>
            </div>
            <div class="mb-3">
                <label for="alamat_tambah" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat_tambah" name="alamat" required>
            </div>
            <div class="mb-3">
                <label for="telepon_tambah" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon_tambah" name="telepon" required>
            </div>
            <div class="mb-3">
                <label for="email_tambah" class="form-label">Email</label>
                <input type="email" class="form-control" id="email_tambah" name="email" required>
            </div>
            <div class="mb-3">
                <label for="status_tambah" class="form-label">Status</label>
                <select class="form-control" id="status_tambah" name="status" required>
                    <option value="1">On</option>
                    <option value="0">Off</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
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
<!-- JS Libraies -->
<script src="../assets/bundles/datatables/datatables.min.js"></script>
<script src="../assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/bundles/jquery-ui/jquery-ui.min.js"></script>

<!-- filepath: c:\laragon\www\market-it\admin\barang.php -->
<script src="https://unpkg.com/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"
    integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous">
</script>
<!-- SweetAlert2 JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.min.css"
    integrity="sha256-J8SXTq+SCSrJ+GSCNWSoO3ef8idzOhhNAJRulSUr6mg=" crossorigin="anonymous">



<!-- Page Specific JS File -->
<script src="../assets/js/page/datatables.js"></script>

</body>

</html>