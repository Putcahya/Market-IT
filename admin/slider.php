<?php include 'layouts/header_admin.php'; ?>
<?php
require_once '../koneksi.php'; // Pastikan path ke koneksi database benar

// Query untuk mengambil data dari tabel slider
$query = "SELECT * FROM slider";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Ambil semua data sebagai array
$slider = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<style>
    .modal {
        z-index: 1050 !important;
    }

    .modal-backdrop {
        z-index: 1040 !important;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center my-3">
                    <h4>Data Gambar</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahBarang">Tambah
                        Gambar</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No</th>
                                    <th>Gambar</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($slider as $row) {
                                    echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td><img src='../assets/img/slider/" . htmlspecialchars($row['gambar']) . "' alt='Gambar Slider' class='img-fluid' style='max-width: 250px; height: auto;'></td>";
                                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                                        echo "<td>";
                                        if ($row['status'] == 1) {
                                            echo "<div class='badge badge-success badge-shadow'>On</div>";
                                        } else {
                                            echo "<div class='badge badge-danger badge-shadow'>Off</div>";
                                        }
                                        echo "</td>";
                                        echo "<td>
                                                <div class='d-flex justify-content-center'>
                                                    <button type='button' class='btn btn-warning btn-sm mr-1' data-bs-toggle='modal' data-bs-target='#editSliderModal" . $row['id'] . "'><i class='bi bi-pencil'></i></button>
                                                    <button type='button' class='btn btn-danger btn-sm' onclick='confirmDelete(" . $row['id'] . ")'><i class='bi bi-trash'></i></button>
                                                </div>
                                            </td>";
                                    echo "</tr>";
                                }
                                ?>
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
            text: "Gambar slider akan dihapus !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke file hapus_slider.php dengan parameter id
                window.location.href = 'process/hapus_slider.php?id=' + id;
            }
        });
    }
</script>

</div>
</section>
</div>


<!-- Modal Tambah Gambar/Slider -->
<div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="tambahBarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="process/tambah_slider.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBarangLabel">Tambah Slider</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="gambarBarang" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambarBarang" name="gambar" required>
                    </div>
                    <div class="mb-3">
                        <label for="titleBarang" class="form-label">Title</label>
                        <input type="text" class="form-control" id="titleBarang" name="title" placeholder="Judul slider" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsiBarang" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiBarang" name="deskripsi" rows="3" placeholder="Deskripsi slider" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="statusBarang" class="form-label">Status</label>
                        <select class="form-control" id="statusBarang" name="status" required>
                            <option value="1">On</option>
                            <option value="0">Off</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($slider as $row) { ?>
<!-- Modal Edit Slider -->
<div class="modal fade" id="editSliderModal<?php echo $row['id']; ?>" tabindex="-1"
    aria-labelledby="editSliderModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="process/edit_slider.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSliderModalLabel<?php echo $row['id']; ?>">Edit Slider</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <img src="../assets/img/slider/<?= $row['gambar']; ?>" alt="" class="img-thumbnail" style="max-width: 180px; height: auto;">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="mb-3">
                        <label for="gambarSlider<?php echo $row['id']; ?>" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambarSlider<?php echo $row['id']; ?>"
                            name="gambar">
                        <small class="text-danger">*Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>
                    <div class="mb-3">
                        <label for="titleSlider<?php echo $row['id']; ?>" class="form-label">Title</label>
                        <input type="text" class="form-control" id="titleSlider<?php echo $row['id']; ?>" name="title" value="<?= htmlspecialchars($row['title']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsiSlider<?php echo $row['id']; ?>" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiSlider<?php echo $row['id']; ?>" name="deskripsi" rows="3" required><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="statusSlider<?php echo $row['id']; ?>" class="form-label">Status</label>
                        <select class="form-control" id="statusSlider<?php echo $row['id']; ?>" name="status" required>
                            <option value="1" <?php echo $row['status'] == 1 ? 'selected' : ''; ?>>On</option>
                            <option value="0" <?php echo $row['status'] == 0 ? 'selected' : ''; ?>>Off</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<!-- alert berhasil tambah -->
<?php if (isset($_SESSION['success_message'])): ?>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.min.css" integrity="sha256-J8SXTq+SCSrJ+GSCNWSoO3ef8idzOhhNAJRulSUr6mg=" crossorigin="anonymous">



<!-- Page Specific JS File -->
<script src="../assets/js/page/datatables.js"></script>

</body>

</html>