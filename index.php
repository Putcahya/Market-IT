<?php
include 'koneksi.php'; // Menghubungkan ke database
// Query untuk mengambil data dari tabel barang
$query = "SELECT * FROM barang";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Ambil semua data sebagai array
$barang = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Query untuk mengambil data dari tabel barang
$query = "SELECT * FROM slider WHERE status = 1";
$resultSlider = mysqli_query($conn, $query);

if (!$resultSlider) {
    die("Query gagal: " . mysqli_error($conn));
}

// Ambil semua data sebagai array
$slider = mysqli_fetch_all($resultSlider, MYSQLI_ASSOC);

// Query untuk mengambil data dari tabel barang
$query = "SELECT * FROM barang WHERE star = 1";
$barangStar = mysqli_query($conn, $query);

if (!$barangStar) {
    die("Query gagal: " . mysqli_error($conn));
}

// Ambil semua data sebagai array
$slider = mysqli_fetch_all($barangStar, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Market-IT</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        /* Membuat tinggi gambar seragam dan mencegah gambar melengkung */
        .img-container {
            height: 200px;
            overflow: hidden;
        }

        .img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Animasi Zoom saat hover pada kartu */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Card Animasi Hover */
        .card-hover {
            transition: transform 0.3s cubic-bezier(.25, .8, .25, 1), box-shadow 0.3s cubic-bezier(.25, .8, .25, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            position: relative;
        }

        .card-hover:hover {
            transform: translateY(-10px) scale(1.04);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.18);
            z-index: 2;
        }

        /* Gambar Zoom saat Hover */
        .card-hover .img-container {
            overflow: hidden;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }

        .card-hover img {
            transition: transform 0.4s cubic-bezier(.25, .8, .25, 1);
        }

        .card-hover:hover img {
            transform: scale(1.08) rotate(-2deg);
        }

        /* Tombol Animasi */
        .btn-primary {
            transition: background 0.2s, transform 0.2s;
            border-radius: 20px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            background: #2d6cdf;
            transform: scale(1.07);
            box-shadow: 0 4px 16px rgba(45, 108, 223, 0.15);
        }

        /* Fade-in animasi dengan AOS */
        [data-aos="fade-up"] {
            opacity: 0;
            transform: translateY(40px);
            transition-property: opacity, transform;
        }

        [data-aos="fade-up"].aos-animate {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <style>
        .carousel-caption h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .carousel-caption p {
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .carousel-caption h5 {
                font-size: 0.95rem;
            }

            .carousel-caption p {
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body class="starter-page-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/logomarket.png" alt="Logo Market-IT"
                    style="height:68px;width:auto;box-shadow:0 2px 12px 0 rgba(255,255,255,0.8);border-radius:8px;background:#fff;margin-right:10px;">
                <h1 class="sitename mb-0" style="font-size:1.7rem;">Market-IT</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#main" class="active">Home</a></li>
                    <li><a href="#produkTeratas" class="active">Produk Teratas</a></li>
                    <li><a href="#produkSelengkapnya" class="active">Produk Selengkapnya</a></li>
                    <li><a href="#kontak" class="active">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade">
            <div class="hero">
                <div class="container">
                    <div class="content-fluid row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <section id="main">
                                <h1>Market-IT</h1>
                                <h2>Selamat Datang di Market-IT</h2>
                                <p class="mt-3">Market-IT adalah platform yang menyediakan berbagai produk teknologi
                                    terkini
                                    untuk memenuhi kebutuhan Anda. Temukan produk terbaik dengan harga terjangkau.</p>
                            </section>

                            <!-- Carousel Laptop -->
                            <div id="laptopCarousel" class="carousel slide mt-4 mb-3" data-bs-ride="carousel"
                                data-bs-interval="2000">
                                <div class="carousel-inner rounded shadow">
                                    <?php foreach ($resultSlider as $i => $row): ?>
                                    <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                                        <img src="assets/img/slider/<?= htmlspecialchars($row['gambar']) ?>"
                                            class="d-block w-100" alt="Slider <?= $i+1 ?>"
                                            style="height:260px;object-fit:cover;">
                                        <div
                                            class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                                            <h5 class="mb-1"><?= htmlspecialchars($row['title']) ?></h5>
                                            <p class="mb-0"><?= htmlspecialchars($row['deskripsi']) ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#laptopCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#laptopCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <!-- End Carousel -->
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="#produkTeratas">Market-IT</a></li>
                        <li class="current">Beranda</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Starter Section Section -->
        <section id="produkTeratas" class="starter-section section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Daftar Produk</h2>
                <div><span class="description-title">Teratas</span></div>
            </div><!-- End Section Title -->
            <div class="container">
                <div class="row">
                    <?php foreach ($barangStar as $row):?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-aos="fade-up">
                        <div class="card shadow card-hover h-100">
                            <div class="img-container">
                                <img src="assets/img/blog/<?=htmlspecialchars($row['gambar'])?>" class="card-img-top"
                                    alt="<?=htmlspecialchars($row['nama_barang'])?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title font-bold fw-bold"><?=htmlspecialchars($row['nama_barang'])?></h5>
                                <p class="card-text" style="
                                    display: -webkit-box;
                                    -webkit-line-clamp: 3;  /* batas 3 baris */
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: ellipsis;

                                    ">
                                    <?=htmlspecialchars($row['deskripsi'])?> </p>
                                <div class="mt-auto d-flex justify-content-end">
                                    <a href="detail_produk.php?id=<?=urlencode($row['id'])?>"
                                        class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach?>
                </div>
            </div>
        </section><!-- /Starter Section Section -->
        <!-- Starter Section Section -->
        <section id="produkSelengkapnya" class="starter-section section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Daftar Produk</h2>
                <div><span class="description-title">Selengkapnya</span></div>
            </div><!-- End Section Title -->
            <div class="container">
                <div class="row">
                    <?php foreach ($barang as $row):?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-aos="fade-up">
                        <div class="card shadow card-hover h-100">
                            <div class="img-container">
                                <img src="assets/img/blog/<?=htmlspecialchars($row['gambar'])?>" class="card-img-top"
                                    alt="<?=htmlspecialchars($row['nama_barang'])?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title font-bold"><?=htmlspecialchars($row['nama_barang'])?></h5>
                                <p class="card-text" style="
                                    display: -webkit-box;
                                    -webkit-line-clamp: 3;  /* batas 3 baris */
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: ellipsis;

                                    ">
                                    <?=htmlspecialchars($row['deskripsi'])?> </p>
                                <div class="mt-auto d-flex justify-content-end">
                                    <a href="detail_produk.php?id=<?=urlencode($row['id'])?>"
                                        class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach?>
                </div>
            </div>
        </section><!-- /Starter Section Section -->

        <section id="kontak" class="starter-section section bg-light">
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak Kami</h2>
                <div><span class="description-title">Hubungi Market-IT</span></div>
            </div>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <!-- Google Maps Embed -->
                        <div class="rounded shadow overflow-hidden" style="min-height:300px;">
                            <iframe src="https://www.google.com/maps?q=Yogyakarta,Indonesia&output=embed" width="100%"
                                height="300" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action="admin/process/kirim_pesan.php" method="post" class="p-4 rounded shadow bg-white">
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
                                <input type="nomor_telepon" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="pesan" class="form-label">Pesan</label>
                                <textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
<?php
// Ambil hanya 1 data kontak_saya yang status=1, urutkan dari yang terbaru
$qKontakAktif = mysqli_query($conn, "SELECT * FROM kontak_saya WHERE status=1 ORDER BY id DESC LIMIT 1");
$kontakAktif = mysqli_fetch_assoc($qKontakAktif);
?>
<!-- Footer -->
<footer id="footer" class="footer dark-background">
    <div class="container footer-top">
        <?php if ($kontakAktif): ?>
        <div class="row gy-4">
            <div class="col-lg-4 col-md-4 footer-about">
                <a href="index.html" class="logo d-flex align-items-center">
                    <span class="sitename"><?= htmlspecialchars($kontakAktif['nama_perusahaan'] ?? 'Perusahaan') ?></span>
                </a>
                <p><?= htmlspecialchars($kontakAktif['deskripsi'] ?? '-') ?></p>
                <div class="footer-contact pt-3">
                    <p><?= htmlspecialchars($kontakAktif['alamat'] ?? '-') ?></p>
                    <p class="mt-3"><strong>Telepon:</strong> <span><?= htmlspecialchars($kontakAktif['telepon'] ?? '-') ?></span></p>
                    <p><strong>Email:</strong> <span><?= htmlspecialchars($kontakAktif['email'] ?? '-') ?></span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href="https://facebook.com"><i class="bi bi-facebook"></i></a>
                    <a href="https://instagram.com/_yoxsz"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.linkedin.com/"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 footer-links">
                <h4>Link Menu</h4>
                <ul>
                    <li><a href="#main">Home</a></li>
                    <li><a href="#produkTeratas">Produk Teratas</a></li>
                    <li><a href="#produkSelengkapnya">Produk Selengkapnya</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 footer-info">
                <h4>Pelayanan</h4>
                <div class="mt-3">
                    <span class="small text-light">Jam Operasional Offline:</span><br>
                    <span class="fw-semibold">Senin - Sabtu : 08.00 - 17.00</span>
                </div>
                <div class="mt-3">
                    <span class="small text-light">Jam Operasional Online:</span><br>
                    <span class="fw-semibold">Setiap Hari : 08.00 - 17.00</span>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Market-IT Sri-Cahya-Putra 23111100062</strong>
            <span>All Rights Reserved</span>

        </p>
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>
<script>
    AOS.init();
</script>

</body>

</html>