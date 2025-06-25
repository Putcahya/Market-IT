-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2025 at 02:39 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `gambar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` text NOT NULL,
  `stok` int NOT NULL,
  `harga` int NOT NULL,
  `star` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `gambar`, `deskripsi`, `stok`, `harga`, `star`) VALUES
(30, 'MacBook Air3', 'm3.jpeg', 'MacBook Air M3 adalah laptop ultra-tipis dari Apple yang dibekali chip Apple M3 terbaru, menawarkan performa cepat, efisiensi daya tinggi, dan layar Liquid Retina 13,6 atau 15,3 inci dengan warna tajam dan cerah. Desainnya ringan dan elegan, cocok untuk pengguna profesional yang mobile, dengan baterai tahan hingga 18 jam, konektivitas Wi-Fi 6E, dan dukungan dua layar eksternal. Harga MacBook Air M3 di Indonesia mulai dari Rp18.999.000 untuk versi 13 inci dan Rp22.499.000 untuk versi 15 inci, tergantung konfigurasi penyimpanan dan GPU.', 1, 18999000, 1),
(31, 'Laptop HP', 'hp2.jpeg', 'HP 14 inch Laptop 14s-dq3134TU adalah laptop entry-level dari HP yang dirancang untuk kebutuhan komputasi ringan sehari-hari seperti browsing, mengetik, dan streaming. Ditenagai oleh prosesor Intel Celeron, RAM 4GB, dan penyimpanan SSD 256GB, laptop ini menawarkan kinerja yang cukup untuk tugas-tugas dasar. Dengan layar 14 inci beresolusi HD dan desain yang ringkas, HP 14s-dq3134TU cocok untuk pelajar atau pengguna yang membutuhkan perangkat portabel dengan harga terjangkau. Di Indonesia, laptop ini tersedia dengan harga sekitar Rp4.949.000.', 4, 5000000, 0),
(32, 'Lenovo Slime 3', 'lenovo slime 3.jpg', 'Lenovo IdeaPad Slim 3 14IAH8 adalah laptop kelas menengah dari Lenovo yang dirancang untuk produktivitas harian dan multitasking ringan. Ditenagai oleh prosesor Intel Core i5-12450H generasi ke-12, RAM 16GB LPDDR5, dan penyimpanan SSD 512GB, laptop ini menawarkan kinerja yang responsif untuk berbagai kebutuhan. Layar 14 inci beresolusi Full HD IPS memberikan tampilan yang jernih dan nyaman untuk bekerja atau menikmati hiburan. Dengan bobot sekitar 1,37 kg dan desain tipis, laptop ini mudah dibawa bepergian. Fitur tambahan seperti kamera FHD dengan penutup privasi, keyboard backlit, dan sistem operasi Windows 11 Home menjadikannya pilihan yang solid untuk pelajar, pekerja kantoran, atau pengguna rumahan.', 5, 8799000, 1),
(33, 'Lenovo LOQ', 'loq.jpg', 'Lenovo LOQ adalah lini laptop gaming terjangkau dari Lenovo yang dirancang untuk gamer pemula hingga menengah. Salah satu model populernya, Lenovo LOQ 15IAX9, dilengkapi dengan prosesor Intel Core i5-12450HX, RAM 12GB DDR5, SSD 512GB, dan GPU NVIDIA GeForce RTX 3050 6GB, menawarkan performa solid untuk gaming 1080p dan produktivitas berat. Layar 15,6 inci FHD IPS dengan refresh rate 144Hz dan dukungan G-SYNC memberikan pengalaman visual yang mulus. Desainnya kokoh dan minimalis, serta dilengkapi dengan sistem pendingin efisien dan keyboard backlit.', 1, 12400000, 0),
(34, 'Asus VivoBook14', 'vivobook14.jpg', 'ASUS Vivobook 14 adalah laptop portabel yang dirancang untuk memenuhi kebutuhan produktivitas sehari-hari, mulai dari pelajar hingga profesional muda. Dilengkapi dengan berbagai pilihan prosesor, seperti Intel Core i3 hingga i7 generasi terbaru dan AMD Ryzen, serta RAM hingga 16GB dan penyimpanan SSD hingga 1TB, laptop ini menawarkan performa yang responsif untuk multitasking dan aplikasi ringan hingga menengah. Layar 14 inci Full HD dengan bezel tipis memberikan pengalaman visual yang luas, sementara desainnya yang ringan dan tipis memudahkan mobilitas. Fitur tambahan seperti keyboard backlit, port USB-C, dan Windows 11 Home semakin meningkatkan kenyamanan dan produktivitas pengguna.', 2, 8799000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hub_kami`
--

CREATE TABLE `hub_kami` (
  `id` int NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `telepon` varchar(14) NOT NULL,
  `email_pengirim` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `time` datetime NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hub_kami`
--

INSERT INTO `hub_kami` (`id`, `nama_pengirim`, `telepon`, `email_pengirim`, `pesan`, `time`, `status`) VALUES
(18, 'Putra Cahya', '08884184536', 'cahya@gmail.com', '(Pertanyaan tentang produk: Acer Aspire 3) Pesan : wdefsdfsdfsdfsddddddddddddddd', '2025-06-04 21:02:15', 1),
(19, 'Putra Cahya', '08884184536', 'cahyaputra0305@gmail.com', '(Pertanyaan tentang produk: MacBook Air3) \nPesan : adsasdasdasdasd', '2025-06-04 21:02:43', 1),
(20, 'Putra Cahya', '08884184536', 'cahya@gmail.com', 'lokasi dimana kak', '2025-06-04 21:04:54', 1),
(21, 'Putra Cahya', '08884184536', 'cahya@gmail.com', '(Pertanyaan tentang produk: MacBook Air3) \nPesan : apakah produk ini masih kak?', '2025-06-04 21:53:40', 1),
(22, 'Putra Cahya', '08884184536', 'cahyaputra0305@gmail.com', '(Pertanyaan tentang produk: Laptop HP) \nPesan : harganya bisa nego kak?', '2025-06-04 22:25:38', 1),
(23, 'asd', '08884184536', 'cahya@gmail.com', 'asdasdad', '2025-06-10 20:00:36', 1),
(24, 'Cahya Putra', '08884184536', 'cahya@gmail.com', 'apakah toko buka kak?', '2025-06-24 22:14:39', 1),
(25, 'Ibnu Yunanto', '083870160392', 'ibnuyunan@gmail.com', '(Pertanyaan tentang produk: MacBook Air3) \nPesan : Apakah produk ini masih kak\r\n', '2025-06-24 22:38:57', 1),
(26, 'Putra Cahya', '083870160392', 'cahya@gmail.com', 'Dimana lokasinya  kak\r\n', '2025-06-24 23:04:38', 0),
(27, 'Cahya Putra', '08884184536', 'cahya@gmail.com', '(Pertanyaan tentang produk: MacBook Air3) \nPesan : Apakah produk ini masih kak?', '2025-06-25 06:57:03', 1),
(28, 'Putra Cahya', '08884184536', 'cahya@gmail.com', 'buka jam berapa kak?\r\n', '2025-06-25 07:05:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kontak_saya`
--

CREATE TABLE `kontak_saya` (
  `id` int NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kontak_saya`
--

INSERT INTO `kontak_saya` (`id`, `nama_perusahaan`, `deskripsi`, `alamat`, `telepon`, `email`, `status`) VALUES
(1, 'Market-IT', 'Market-IT adalah platform yang menyediakan berbagai produk teknologi terkini untuk memenuhi kebutuhan Anda. Temukan produk terbaik dengan harga terjangkau.', 'Bantul, Yogyakarta, Indonesia', '08884184536', 'marketit@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int NOT NULL,
  `gambar` varchar(40) NOT NULL,
  `title` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `gambar`, `title`, `deskripsi`, `status`) VALUES
(6, '3.png', 'Exclusive Collection', 'Dapatkan promo koleksi eksklusifnya hanya di Market-IT', 1),
(7, '4.png', 'New Series', 'Kini hadir, seri terbaru laptop tahun 2025, dapatkan di Market-IT', 1),
(8, '2.png', 'Laptop Terbaik 2025', 'Segera checkout barangnya hanya di Market-IT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nama` varchar(20) NOT NULL,
  `foto_profile` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `foto_profile`, `email`, `username`, `password`, `alamat`, `telepon`) VALUES
(1, 'Putra Cahya', 'sic6-dfa0dd3d-da89-448f-b93c-9c0d71b273aa.jpg', 'cahya@gmail.com', 'cahya', 'feb87d4c01803da67e4cdcbf0cf4fdf9be1dea85', 'Bantul, Yogyakarta', '085675432345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hub_kami`
--
ALTER TABLE `hub_kami`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak_saya`
--
ALTER TABLE `kontak_saya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `hub_kami`
--
ALTER TABLE `hub_kami`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kontak_saya`
--
ALTER TABLE `kontak_saya`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
