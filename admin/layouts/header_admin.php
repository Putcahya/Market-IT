<?php
include '../koneksi.php'; // Menghubungkan ke database
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    // Redirect ke halaman login jika belum login
    header("Location: ../login.php?error=login_gagal");
    exit();
}
?>

<?php
// Cek apakah login berhasil
if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
    echo "
    <script>
        Swal.fire({
            title: 'Login Berhasil!',
            text: 'Selamat datang, " . htmlspecialchars($_SESSION['nama']) . "!',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
    ";
    // Hapus session login_success agar SweetAlert tidak muncul lagi saat refresh
    unset($_SESSION['login_success']);
}

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

// Dapatkan nama file halaman saat ini
$current_page = basename($_SERVER['PHP_SELF']);
  
// Hitung jumlah pesan belum dijawab
$countBelumDijawab = 0;
$qCount = mysqli_query($conn, "SELECT COUNT(*) as total FROM hub_kami WHERE status = 0");
if ($qCount) {
    $rowCount = mysqli_fetch_assoc($qCount);
    $countBelumDijawab = $rowCount['total'];
}
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">


<!-- modal.html  21 Nov 2019 03:54:30 GMT -->

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Market IT - Admin Dashboard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/css/app.min.css">
  <link rel="stylesheet" href="../assets/bundles/prism/prism.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/css/app.min.css">
  <link rel="stylesheet" href="../assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="../assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="../assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='n../assets/img/logoMarket.png' />
  <!-- SweetAlert2 CSS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.19.1/dist/sweetalert2.all.min.js"
    integrity="sha256-pYQrGA6LI+iNqLNslfPObC8AbGjVAQIZzGbRBgzHApc=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
  <div class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li>
        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
          <i data-feather="align-justify"></i>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link nav-link-lg fullscreen-btn">
          <i data-feather="maximize"></i>
        </a>
      </li>
      <li>
        <form class="form-inline mr-auto">
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
            <button class="btn" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
      </li>
    </ul>
  </div>
  <ul class="navbar-nav navbar-right align-items-center">
    <li class="nav-item mr-2">
      <a href="pesan.php" class="btn btn-primary btn-sm py-1 px-2 position-relative">
        <i class="fas fa-envelope"></i>
        Pesan Masuk
        <?php if ($countBelumDijawab > 0): ?>
          <span class="badge bg-danger text-light position-absolute top-0 start-100 translate-middle rounded-pill">
            <?= $countBelumDijawab ?>
          </span>
        <?php endif; ?>
      </a>
    </li>
    <li class="dropdown">
      <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image"
          src="../assets/img/users/<?php echo htmlspecialchars($user['foto_profile']); ?>"
          class="user-img-radious-style">
        <span class="d-sm-none d-lg-inline-block"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right pullDown">
        <div class="dropdown-title">Hello, <?php echo htmlspecialchars($user['nama']); ?></div>
        <a href="profile.php" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" id="logoutBtn" class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="../assets/img/logoMarket.png" class="header-logo"
                style="height:40px;width:auto;box-shadow:0 5px 10px 0 rgba(0, 12, 181, 0.74);border-radius:8px;background:#fff;margin-right:10px;" />
              <span class="logo-name">Market-IT</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown <?= $current_page == 'dashboard.php' ? 'active' : '' ?>">
              <a href="dashboard.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown <?= $current_page == 'slider.php' ? 'active' : '' ?>">
              <a href="slider.php" class="nav-link"><i data-feather="image"></i><span>Slider Header</span></a>
            </li>
            <li class="dropdown <?= $current_page == 'barang.php' ? 'active' : '' ?>">
              <a href="barang.php" class="nav-link"><i data-feather="box"></i><span>Data Barang</span></a>
            </li>
            <li class="dropdown <?= $current_page == 'kontak_saya.php' ? 'active' : '' ?>">
              <a href="kontak_saya.php" class="nav-link"><i data-feather="phone"></i><span>Kontak Saya</span></a>
            </li>
            <li class="dropdown <?= $current_page == 'pesan.php' ? 'active' : '' ?>">
              <a href="pesan.php" class="nav-link">
                <i data-feather="mail"></i>
                <span>Pesan Masuk</span>
                <?php if ($countBelumDijawab > 0): ?>
                <?php echo $countBelumDijawab; ?>
                </span>
                <?php endif; ?>
              </a>
            </li>
          </ul>
        </aside>
      </div>
      <div class="settingSidebar">
        <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
        </a>
        <div class="settingSidebar-body ps-container ps-theme-default">
          <div class=" fade show active">
            <div class="setting-panel-header">Setting Panel
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Select Layout</h6>
              <div class="selectgroup layout-color w-50">
                <label class="selectgroup-item">
                  <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                  <span class="selectgroup-button">Light</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                  <span class="selectgroup-button">Dark</span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Sidebar Color</h6>
              <div class="selectgroup selectgroup-pills sidebar-color">
                <label class="selectgroup-item">
                  <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                  <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                    data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                  <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                    data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Color Theme</h6>
              <div class="theme-setting-options">
                <ul class="choose-theme list-unstyled mb-0">
                  <li title="white" class="active">
                    <div class="white"></div>
                  </li>
                  <li title="cyan">
                    <div class="cyan"></div>
                  </li>
                  <li title="black">
                    <div class="black"></div>
                  </li>
                  <li title="purple">
                    <div class="purple"></div>
                  </li>
                  <li title="orange">
                    <div class="orange"></div>
                  </li>
                  <li title="green">
                    <div class="green"></div>
                  </li>
                  <li title="red">
                    <div class="red"></div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <div class="theme-setting-options">
                <label class="m-b-0">
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                    id="mini_sidebar_setting">
                  <span class="custom-switch-indicator"></span>
                  <span class="control-label p-l-10">Mini Sidebar</span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <div class="theme-setting-options">
                <label class="m-b-0">
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                    id="sticky_header_setting">
                  <span class="custom-switch-indicator"></span>
                  <span class="control-label p-l-10">Sticky Header</span>
                </label>
              </div>
            </div>
            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
              <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                <i class="fas fa-undo"></i> Restore Default
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <script>
              document.addEventListener('DOMContentLoaded', function () {
                const logoutBtn = document.getElementById('logoutBtn');
                if (logoutBtn) {
                  logoutBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                      title: 'Yakin ingin logout?',
                      text: "Anda akan keluar dari sesi admin.",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ya, logout!',
                      cancelButtonText: 'Batal'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = '../logout_proces.php';
                      }
                    });
                  });
                }
              });
            </script>