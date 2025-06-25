<?php include 'layouts/header_admin.php'; ?>
<?php
require_once '../koneksi.php'; // Pastikan path ke koneksi database benar

// Query untuk mengambil data dari tabel barang
$query = "SELECT * FROM barang";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Ambil semua data sebagai array
$barang = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                    <h4>Data Barang</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahBarang"><i class="bi bi-plus"></i>Tambah
                        Barang</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th></th>
                                    <th>Gambar</th>
                                    <th>Deskripsi</th>
                                    <th>Stok</th>
                                    <th style="width: 12%;">Harga</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($barang as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                                    echo "<td>";
                                    if ($row['star'] == 1) {
                                        echo "<i class='bi bi-star-fill text-warning'></i> ";
                                    }
                                    echo "<td>";
                                    // Jika gambar kosong, pakai default.png
                                    $gambar = !empty($row['gambar']) ? htmlspecialchars($row['gambar']) : 'default.png';
                                    echo "<img src='../assets/img/blog/$gambar' alt='Gambar Barang' class='img-fluid' style='max-width: 120px; height: auto;'>";
                                    echo "</td>";
                                    echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['stok']) . "</td>";
                                    echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                                    if ($row['stok'] < 1) {
                                        echo "<td><div class='badge badge-danger badge-shadow'>Tidak Tersedia</div></td>";
                                    } else {
                                        echo "<td><div class='badge badge-success badge-shadow'>Tersedia</div></td>";
                                    }
                                    echo "<td>
                                            <div class='d-flex justify-content-center'>
                                                <button type='button' class='btn btn-warning btn-sm mr-1' data-bs-toggle='modal' data-bs-target='#editBarangModal" . $row['id'] . "'><i class='bi bi-pencil'></i></button>
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
            text: "Data barang akan dihapus !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke file hapus_barang.php dengan parameter id
                window.location.href = 'process/hapus_barang.php?id=' + id;
            }
        });
    }
</script>

</div>
</section>
</div>


<!-- Modal Tambah Barang -->
<div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="tambahBarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="process/tambah_barang.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBarangLabel">Tambah Barang</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaBarang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="namaBarang" name="nama_barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambarBarang" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambarBarang" name="gambar" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsiBarang" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiBarang" name="deskripsi" rows="3"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="stokBarang" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stokBarang" name="stok" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="hargaBarang" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="hargaBarang" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="statusBarang" class="form-label">Produk teratas</label>
                        <select class="form-control" id="statusBarang" name="status" required>
                            <option value="0">Off</option>
                            <option value="1">On</option>
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

<?php
foreach ($barang as $row) {
?>
<!-- Modal Edit Barang -->
<div class="modal fade" id="editBarangModal<?php echo $row['id']; ?>" tabindex="-1"
    aria-labelledby="editBarangModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="process/edit_barang.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBarangModalLabel<?php echo $row['id']; ?>">Edit Barang</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="mb-3">
                        <label for="namaBarang<?php echo $row['id']; ?>" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="namaBarang<?php echo $row['id']; ?>"
                            name="nama_barang" value="<?php echo htmlspecialchars($row['nama_barang']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambarBarang<?php echo $row['id']; ?>" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambarBarang<?php echo $row['id']; ?>"
                            name="gambar">
                        <small class="text-danger">*Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsiBarang<?php echo $row['id']; ?>" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiBarang<?php echo $row['id']; ?>" name="deskripsi"
                            rows="3" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="stokBarang<?php echo $row['id']; ?>" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stokBarang<?php echo $row['id']; ?>" name="stok"
                            value="<?php echo $row['stok']; ?>" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="hargaBarang<?php echo $row['id']; ?>" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="hargaBarang<?php echo $row['id']; ?>" name="harga"
                            value="<?php echo $row['harga']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="statusBarang<?php echo $row['id']; ?>" class="form-label">Produk Teratas</label>
                        <select class="form-control" id="statusBarang<?php echo $row['id']; ?>" name="star" required>
                            <option value="1" <?php echo $row['star'] == 1 ? 'selected' : ''; ?>>On</option>
                            <option value="0" <?php echo $row['star'] == 0 ? 'selected' : ''; ?>>Off
                            </option>
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

<?php
}
?>

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