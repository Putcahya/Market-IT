<?php include 'layouts/header_admin.php'; ?>
<?php
require_once '../koneksi.php'; // Pastikan path ke koneksi database benar

// Query untuk mengambil data dari tabel barang
$query = "SELECT * FROM hub_kami ORDER BY id DESC";
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
                text: 'Pesan telah berhasil dihapus permanen.',
                });
        </script>";
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center my-3">
                    <h4>Pesan Masuk</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Time</th>
                                    <th>Nama Pengirim Pesan</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Pesan</th>
                                    <th>Status Pesan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($pesan as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td>" . htmlspecialchars($row['time']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nama_pengirim']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email_pengirim']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['telepon']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['pesan']) . "</td>";

                                    // Status Pesan
                                    if ($row['status'] == 0) {
                                        echo "<td><span class='badge bg-warning text-dark'>Belum Dijawab</span></td>";
                                    } else if ($row['status'] == 1) {
                                        echo "<td><span class='badge bg-success text-light'>Sudah Dijawab</span></td>";
                                    } else {
                                        echo "<td><span class='badge bg-secondary'>Tidak Diketahui</span></td>";
                                    }

                                    // Tombol Jawab ke WhatsApp
                                    $waNumber = preg_replace('/[^0-9]/', '', $row['telepon']); // hanya angka
                                    if (substr($waNumber, 0, 1) == '0') {
                                        $waNumber = '62' . substr($waNumber, 1); // ubah 08xxx jadi 628xxx
                                    }
                                    $waMessage = urlencode("Halo " . $row['nama_pengirim'] . ", kami dari Market-IT. Menanggapi pesan Anda: " . $row['pesan']);

                                    // Jika status 0 (belum dijawab), tampilkan tombol Jawab via WA dan update status
                                    if ($row['status'] == 0) {
                                        echo "<td>
                                                <div class='d-flex justify-content-center'>
                                                    <a href='https://wa.me/$waNumber?text=$waMessage' target='_blank' class='btn btn-success btn-sm mr-1' onclick=\"setTimeout(function(){ window.location.href='process/update_status_pesan.php?id=" . $row['id'] . "'; }, 1000);\">Jawab via WA</a>
                                                    <button type='button' class='btn btn-danger btn-sm' onclick='confirmDelete(" . $row['id'] . ")'>
                                                        <i class='bi bi-trash'></i>
                                                    </button>
                                                </div>
                                            </td>";
                                    } else {
                                        // Jika sudah dijawab, hanya tampilkan tombol buka pesan WA
                                        echo "<td>
                                                <div class='d-flex justify-content-center'>
                                                    <a href='https://wa.me/$waNumber' target='_blank' class='btn btn-primary btn-sm mr-1'>Buka Pesan WA</a>
                                                    <button type='button' class='btn btn-danger btn-sm ms-2' onclick='confirmDelete(" . $row['id'] . ")'>
                                                        <i class='bi bi-trash'></i>
                                                    </button>
                                                </div>
                                            </td>";
                                    }
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
                window.location.href = 'process/hapus_pesan.php?id=' + id;
            }
        });
    }
</script>

</div>
</section>
</div>


<?php if (isset($_GET['hapus'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        icon: '<?=$_GET['hapus']=='sukses' ? 'success' : 'error'?>',
        title: '<?=$_GET['hapus']=='sukses' ? 'Berhasil!' : 'Gagal!'?>',
        text: '<?=$_GET['hapus']=='sukses' ? 'Pesan berhasil dihapus.' : 'Pesan gagal dihapus.'?>',
        timer: 2000,
        showConfirmButton: true
      });
    });
  </script>
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

