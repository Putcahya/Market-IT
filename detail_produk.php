<?php
include 'koneksi.php';

// Ambil id produk dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query produk
$query = "SELECT * FROM barang WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Produk tidak ditemukan.");
}

$produk = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Detail Produk - <?= htmlspecialchars($produk['nama_barang']) ?> | Market-IT</title>
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        .img-detail-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto 24px auto;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(0,0,0,0.10);
        }
        .img-detail-container img {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 320px;
            object-fit: contain;
            background: #f8f9fa; /* opsional: latar belakang terang */
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .badge-star {
            font-size: 1.2rem;
            color: #ffc107;
            vertical-align: middle;
        }
    </style>
</head>
<body class="starter-page-page">
    <header id="header" class="header d-flex align-items-center fixed-top dark-background"  style="background-color: #040677;">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center text-white">
                <h1 class="sitename">Market-IT</h1>
            </a>

            <nav id="navmenu" class="navmenu ">
                <ul>
                    <li><a href="#produk" class="text-white active">Detail Produk</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list text-white"></i>
            </nav>

        </div>
    </header>

    <main class="main" style="margin-top: 90px;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg p-4 pt-5">
                        <div class="img-detail-container mb-4 text-center">
                            <img src="assets/img/blog/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_barang']) ?>">
                        </div>
                        <h2 class="mb-2">
                            <?= htmlspecialchars($produk['nama_barang']) ?>
                            <?php if ($produk['star'] == 1): ?>
                                <i class="bi bi-star-fill badge-star"></i>
                            <?php endif; ?>
                        </h2>
                        <h5 class="text-muted mb-3">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></h5>
                        <div class="mb-3">
                            <span class="badge <?= $produk['stok'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                <?= $produk['stok'] > 0 ? 'Tersedia' : 'Tidak Tersedia' ?>
                            </span>
                            <span class="ms-3">Stok: <?= $produk['stok'] ?></span>
                        </div>
                        <div class="mb-4">
                            <h5>Deskripsi Produk</h5>
                            <p><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></p>
                        </div>
                        <!-- Tombol Tanyakan Produk Ini -->
                        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tanyaProdukModal">
                            <i class="bi bi-question-circle"></i> Tanyakan Produk Ini
                        </button>
                        <a href="index.php" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
                        <!-- Modal Tanya Produk -->
                        <div class="modal fade" id="tanyaProdukModal" tabindex="-1" aria-labelledby="tanyaProdukLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="admin/process/kirim_pesan.php" method="post" class="p-2">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="tanyaProdukLabel">Tanyakan Produk : <?= htmlspecialchars($produk['nama_barang']) ?></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="produk" value="<?= htmlspecialchars($produk['nama_barang']) ?>">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pesan" class="form-label">Pesan</label>
                                        <textarea class="form-control" id="pesan" name="pesan" rows="5" required placeholder="Tulis pertanyaan Anda tentang produk ini"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-success">Kirim Pertanyaan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer" class="footer dark-background mt-5">
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Market-IT Sri-Cahya-Putra 23111100062</strong>
                <span>All Rights Reserved</span>
            </p>
        </div>
    </footer>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>