<?php include 'layouts/header_admin.php'?>
<?php
require_once '../koneksi.php';

// Banyak slider aktif
$slider_aktif = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM slider WHERE status=1"))[0];

// Banyak produk favorit (star=1)
$produk_favorit = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM barang WHERE star=1"))[0];

// Total barang
$total_barang = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM barang"))[0];

if (isset($_GET['success']) && $_GET['success'] === 'login_success') {
    echo "
    <script>
    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil !',
                        text: 'Selamat datang, " . htmlspecialchars($_SESSION['nama'] ). "',
                    });
    </script>";
}
?>
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-7 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Slider Aktif</h5>
                                <h2 class="mb-3 font-18"><?= $slider_aktif ?></h2>
                                <p class="mb-0"><span class="col-green"><?= $slider_aktif > 0 ? 'Aktif' : 'Tidak Ada' ?></span></p>
                            </div>
                        </div>
                        <div class="col-5 pl-0 text-right">
                            <div class="banner-img">
                                <img src="../assets/img/banner/1.png" alt="" style="max-width:60px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-7 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Produk Favorit</h5>
                                <h2 class="mb-3 font-18"><?= $produk_favorit ?></h2>
                                <p class="mb-0"><span class="col-orange"><?= $produk_favorit ?> Favorit</span></p>
                            </div>
                        </div>
                        <div class="col-5 pl-0 text-right">
                            <div class="banner-img">
                                <img src="../assets/img/banner/2.png" alt="" style="max-width:60px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-7 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Total Barang</h5>
                                <h2 class="mb-3 font-18"><?= $total_barang ?></h2>
                                <p class="mb-0"><span class="col-blue"><?= $total_barang ?> Barang</span></p>
                            </div>
                        </div>
                        <div class="col-5 pl-0 text-right">
                            <div class="banner-img">
                                <img src="../assets/img/banner/3.png" alt="" style="max-width:60px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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