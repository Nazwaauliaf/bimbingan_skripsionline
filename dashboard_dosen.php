<?php
session_start();
include ("function.php");

if (!isset($_SESSION['login_dosen'])) {
    header("Location: login_dosen.php");
    exit;
}

// Ambil data dosen yang sedang login untuk ditampilkan di header
$id_dosen = $_SESSION['id'];
$dosen = query("SELECT * FROM users WHERE id = $id_dosen")[0];

// Ambil data bimbingan
$bimbinganSkripsi = query("SELECT * FROM bimbingan");
?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Bimbingan Skripsi Online</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />

    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />

    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="dist/css/adminlte.css" as="style" />

    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      media="print" onload="this.media='all'" />

    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" />

    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />

    <link rel="stylesheet" href="dist/css/adminlte.min.css" />

    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" />

    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" />
  </head>
  <!--end::Head-->

  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
      <!-- HEADER -->
      <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
          </ul>

          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>

            <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                  <img src="img/<?= $dosen['foto']; ?>" class="user-image img-circle elevation-2 shadow" alt="User Image" />
                  <span class="d-none d-md-inline"><?= $_SESSION['username']; ?></span>
                </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow">
              <li class="user-header bg-primary text-white">
                <img src="dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image" />
                <span class="d-none d-md-inline"><?= $dosen['username']; ?></span>
                  <p>
                    <?= $dosen['username']; ?>
                    <small><?= $dosen['email']; ?></small>
                  </p>
              </li>
            <li class="user-footer d-flex justify-content-between p-3">
              <a href="profil_dosen.php" class="btn btn-default btn-flat border">
                <i class="bi bi-person"></i> Profil
              </a>
              <a href="logout.php" class="btn btn-default btn-flat border text-danger">
                <i class="bi bi-box-arrow-right"></i> Keluar
              </a>
            </li>
            </ul>
          </li>
        </ul>
        </li>
        </ul>
      </div>
      </nav>
      <!-- END HEADER -->

      <!-- SIDEBAR -->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
          <a href="index.php" class="brand-link">
            <img src="dist/assets/img/AdminLTELogo.png"
              class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">Bimbingan Skripsi</span>
          </a>
        </div>

        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview">
              <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Data Master<i class="nav-arrow bi bi-chevron-right"></i></p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="dashboard_dosen.php" class="nav-link active">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Bimbingan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="dashboard_mahasiswa.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Mahasiswa</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </aside>
      <!-- END SIDEBAR -->

      <!-- MAIN -->
      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-3">Data Bimbingan</h3>
                <a href="tambah_bimbingan_dosen.php">
                  <button class="btn-sm btn btn-primary">Tambah Data</button>
                </a>
              </div>

              <div class="col-sm-6 d-flex flex-column align-items-end">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data Bimbingan Skripsi</li>
                </ol>

                <form class="mt-2">
                  <div class="input-group">
                    <input type="text" class="form-control" name="keyword"
                      placeholder="Cari mahasiswa..." />
                    <button class="btn btn-primary" type="submit">
                      <i class="bi bi-search"></i> Cari
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    <!-- Riwayat Bimbingan -->
    <div class="card text-white bg-secondary mb-3">
        <div class="card-body">
            <h5 class="card-title">Riwayat Bimbingan</h5>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Mahasiswa</th>
                        <th>Nama Mahasiswa</th>
                        <th>Topik</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th>Catatan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach($bimbinganSkripsi as $bsk): ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $bsk['id_mahasiswa']; ?></td>
                        <td><?= $bsk['nama']; ?></td>
                        <td><?= $bsk['nim']; ?></td>
                        <td><?= $bsk['jurusan']; ?></td>
                        <td><?= $bsk['angkatan']; ?></td>
                        <td><?= $bsk['topik']; ?></td>
                        <td><?= $bsk['catatan']; ?></td>
                        <td><?= $bsk['tanggal']; ?></td>
                        <td><?= statusBimbingan($bsk['status']); ?></td>
                        <td>
                            <a href="ubah_data.php?id=<?= $bsk['id_bimbingan'] ?>" class="btn-sm btn-success btn">Edit</a>
                            <a href="hapus_data.php?id=<?= $bsk['id_bimbingan'] ?>" 
                                onclick="return confirm('Yakin ingin menghapus data ini?');"
                                class="btn-sm btn-danger btn">Hapus</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <!-- Footer --->
    <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">Bimbingan Skripsi Online</div>
        <strong>Copyright &copy; 2026</strong>
      </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>